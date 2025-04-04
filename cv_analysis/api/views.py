from django.shortcuts import render
from rest_framework import status
from rest_framework.views import APIView
from rest_framework.response import Response
from sentence_transformers import CrossEncoder
import numpy as np
from collections import defaultdict
from .serializers import RankRequestSerializer, RankResponseSerializer, ApplicationSerializer
import pprint
from translator.main import translate_text_chunks
import asyncio


# Load the reranking model
model = CrossEncoder("tomaarsen/reranker-ModernBERT-base-gooaq-bce")

# Chunking function with overlapping
def chunk_text(text, max_tokens=500, overlap=20):
    """
    Chunk the text to ensure no chunk exceeds max_tokens, and each chunk overlaps by overlap tokens.
    Returns a list of chunks, each with an id (for later tracking).
    """
    words = text.split()
    chunks = []
    current_chunk = []
    current_length = 0
    chunk_id = 0

    for word in words:
        current_chunk.append(word)
        current_length += len(word) + 1  # account for space
        
        if current_length > max_tokens:
            # Add the chunk with its ID and reset for the next chunk
            text = " ".join(current_chunk)
            # text = asyncio.run(translate_text_chunks(text))      
            chunks.append({"chunk_id": chunk_id, "text": text})
            chunk_id += 1
            current_chunk = current_chunk[int(len(current_chunk) * (1 - overlap / current_length)):]
            current_length = sum(len(word) + 1 for word in current_chunk)
    
    # Append the last chunk if it has any remaining content
    if current_chunk:
        text = " ".join(current_chunk)
        # text = asyncio.run(translate_text_chunks(text))
        chunks.append({"chunk_id": chunk_id, "text": text})
    
    return chunks


# Create your views here.
class RankView(APIView):
    def post(self, request):
        serializer = RankRequestSerializer(data=request.data)
        if serializer.is_valid():
            job_post = serializer.validated_data["job_post"]
            applications = serializer.validated_data["applications"]
            
            # Chunk the job post and applications (job descriptions)
            job_post_chunks = chunk_text(job_post)
            application_chunks = []
            user_mapping = {}

            for application in applications:
                user_id = application["user_id"]
                chunks = chunk_text(application["application"])
                for chunk in chunks:
                    application_chunks.append((user_id, chunk["text"]))
                    user_mapping[chunk["text"]] = user_id
            
            # Perform ranking on all application chunks as a set
            all_chunks_texts = [chunk_texts for _, chunk_texts in application_chunks]
            rankings = []
            for job_chunk in job_post_chunks:
                rankings.extend(model.rank(job_chunk["text"], all_chunks_texts))
            
            # Associate scores to user_ids
            user_scores = defaultdict(list)
            for rank in rankings:
                corpus_index = rank["corpus_id"]
                chunk_texts = application_chunks[corpus_index][1]
                user_id = user_mapping[chunk_texts]
                user_scores[user_id].append(rank["score"])

            
            # Compute the average score for each user
            results = [{"user_id": user_id, "score": float(np.mean(scores))} for user_id, scores in user_scores.items()]
            pprint.pprint(results)
            
            return Response({"results": results}, status=status.HTTP_200_OK)

        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)
