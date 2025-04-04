from django.shortcuts import render
from rest_framework import status
from rest_framework.views import APIView
from rest_framework.response import Response
from sentence_transformers import CrossEncoder
import numpy as np
import asyncio
from translator.main import translate_text_chunks

from .serializers import RankRequestSerializer, RankResponseSerializer, ApplicationSerializer


# Load the reranking model
model = CrossEncoder("tomaarsen/reranker-ModernBERT-base-gooaq-bce")

# Chunking function with overlapping
def chunk_text(text, max_tokens=6000, overlap=20):
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
            text = asyncio.run(translate_text_chunks(text))
            chunks.append({"chunk_id": chunk_id, "text": text})
            
            chunk_id += 1
            current_chunk = current_chunk[int(len(current_chunk) * (1 - overlap / current_length)):]
            current_length = sum(len(word) + 1 for word in current_chunk)
    
    # Append the last chunk if it has any remaining content
    if current_chunk:
        chunks.append({"chunk_id": chunk_id, "text": " ".join(current_chunk)})
    
    return chunks


# Create your views here.
class RankView(APIView):
    def post(self, request):
        serializer = RankRequestSerializer(data=request.data)
        if serializer.is_valid():
            job_post = serializer.validated_data["job_post"]
            applications = serializer.validated_data["applications"]
            print(job_post)
            print(applications)
            # Chunk the job post and applications (job descriptions)
            job_post_chunks = chunk_text(job_post)
            application_chunks = {}

            for application in applications:
                user_id = application["user_id"]
                application_chunks[user_id] = chunk_text(application["application"])
            
            # Perform ranking for each application and chunk
            results = []
            for user_id, app_chunks in application_chunks.items():
                chunk_scores = []

                # Rank each chunk
                for chunk in app_chunks:
                    ranks = model.rank(job_post, [chunk["text"]])
                    chunk_scores.append(ranks[0]['score'])
                
                # Calculate average score for the user
                avg_score = np.mean(chunk_scores)
                results.append({"user_id": user_id, "score": float(avg_score)})
            
            print(results)               
            return Response({"results": results}, status=status.HTTP_200_OK)

        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)