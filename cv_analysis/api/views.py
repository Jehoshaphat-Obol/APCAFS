from django.db import connection
from rest_framework import status
from rest_framework.views import APIView
from rest_framework.response import Response
from .serializers import RankRequestSerializer
from .models import ProcessingRequest, JobPostChunk, ApplicationChunk
from .utils import chunk_text, embed_chunks
from collections import defaultdict
import numpy as np
import uuid


class RankView(APIView):
    def post(self, request):
        serializer = RankRequestSerializer(data=request.data)
        if not serializer.is_valid():
            return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

        job_post = serializer.validated_data["job_post"]
        applications = serializer.validated_data["applications"]

        # 1. Create a processing request instance
        processing_request = ProcessingRequest.objects.create()
        processing_id = processing_request.id

        # 2. Chunk and embed the job post
        job_chunks = chunk_text(job_post)
        job_embeddings = embed_chunks(job_chunks)

        for text, embedding in zip(job_chunks, job_embeddings):
            JobPostChunk.objects.create(
                processing=processing_request,
                text=text,
                embedding=embedding
            )

        # 3. Chunk and embed each application
        for application in applications:
            user_id = application["user_id"]
            chunks = chunk_text(application["application"])
            embeddings = embed_chunks(chunks)

            for text, embedding in zip(chunks, embeddings):
                ApplicationChunk.objects.create(
                    processing=processing_request,
                    user_id=user_id,
                    text=text,
                    embedding=embedding
                )

        # 4. Ranking logic using pgvector approximate nearest neighbor with union strategy
        raw_scores = []

        for job_embedding in job_embeddings:
            with connection.cursor() as cursor:
                cursor.execute("""
                    SELECT user_id, embedding <#> %s::vector AS distance
                    FROM api_applicationchunk
                    WHERE processing_id = %s
                """, [job_embedding, processing_id])

                rows = cursor.fetchall()
                # Save all results for union logic
                raw_scores.extend([
                    {"user_id": row[0], "distance": row[1]}
                    for row in rows
                ])

        # 5. Group scores by user_id and average them
        user_score_map = defaultdict(list)

        for entry in raw_scores:
            user_id = entry["user_id"]
            distance = entry["distance"]
            score = 1.0 - distance  # Invert distance for similarity
            user_score_map[user_id].append(score)

        # Final averaged result per user
        results = [
            {"user_id": user_id, "score": round(float(np.mean(scores)), 4)}
            for user_id, scores in user_score_map.items()
        ]

        # Sort by descending score
        results.sort(key=lambda x: x["score"], reverse=True)
        
        # 6. Cleanup
        JobPostChunk.objects.filter(processing=processing_request).delete()
        ApplicationChunk.objects.filter(processing=processing_request).delete()

        return Response({"results": results}, status=status.HTTP_200_OK)
