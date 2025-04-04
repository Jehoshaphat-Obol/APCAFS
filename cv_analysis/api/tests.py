from django.test import TestCase

# Create your tests here.
from rest_framework.test import APITestCase
from rest_framework import status
from django.urls import reverse

class RankEndpointTest(APITestCase):
    def setUp(self):
        self.url = reverse("api:rank")
        self.valid_payload = {
            "job_post": "We are looking for a Python developer with Django experience.",
            "applications": [
                {"user_id": "123", "application": "I have 3 years of Django experience."},
                {"user_id": "456", "application": "I am a JavaScript developer."}
            ]
        }

    def test_rank_endpoint_valid_request(self):
        response = self.client.post(self.url, self.valid_payload, format='json')
        
        self.assertEqual(response.status_code, status.HTTP_200_OK)
        self.assertIn("results", response.data)
        self.assertIsInstance(response.data["results"], list)
        
        for item in response.data["results"]:
            self.assertIn("user_id", item)
            self.assertIn("score", item)
            self.assertIsInstance(item["user_id"], str)
            self.assertIsInstance(item["score"], (int, float))

    def test_rank_endpoint_missing_fields(self):
        invalid_payload = {"job_post": "Python developer needed."}  # Missing applications
        response = self.client.post(self.url, invalid_payload, format='json')
        self.assertEqual(response.status_code, status.HTTP_400_BAD_REQUEST)

    def test_rank_endpoint_invalid_format(self):
        invalid_payload = {"job_post": 123, "applications": "not a list"}  # Wrong data types
        response = self.client.post(self.url, invalid_payload, format='json')
        self.assertEqual(response.status_code, status.HTTP_400_BAD_REQUEST)
