from django.db import models
from django.contrib.postgres.fields import ArrayField
from pgvector.django import VectorField

class ProcessingRequest(models.Model):
    created_at = models.DateTimeField(auto_now_add=True)


class JobPost(models.Model):
    processing = models.ForeignKey(ProcessingRequest, on_delete=models.CASCADE, related_name="job_posts")
    full_text = models.TextField()

class Application(models.Model):
    processing = models.ForeignKey(ProcessingRequest, on_delete=models.CASCADE, related_name="applications")
    user_id = models.CharField(max_length=100)
    full_text = models.TextField()

class JobPostChunk(models.Model):
    processing = models.ForeignKey(ProcessingRequest, on_delete=models.CASCADE)
    text = models.TextField()
    embedding = VectorField(dimensions=384)

class ApplicationChunk(models.Model):
    processing = models.ForeignKey(ProcessingRequest, on_delete=models.CASCADE)
    user_id = models.CharField(max_length=100)
    text = models.TextField()
    embedding = VectorField(dimensions=384)