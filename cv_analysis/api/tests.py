from django.test import TestCase

# Create your tests here.
from rest_framework.test import APITestCase
from rest_framework import status
from django.urls import reverse

class RankEndpointTest(APITestCase):
    def setUp(self):
        self.url = reverse("api:rank")
        self.valid_payload = {
            "job_post": (
                "We are seeking a Senior Python Developer with expertise in Django to join our fast-growing team. "
                "The ideal candidate should have at least 5 years of experience in backend development, with a deep "
                "understanding of Django, PostgreSQL, RESTful API design, and cloud platforms like AWS or Azure. "
                "Experience with Docker, Kubernetes, and CI/CD pipelines is highly desirable. Candidates should also "
                "be comfortable working with JavaScript frameworks like React or Vue.js for frontend integration. "
                "Additional experience in machine learning, data engineering, or fintech applications will be a plus. "
                "Responsibilities include designing and maintaining scalable web applications, optimizing database queries, "
                "ensuring application security, and collaborating with frontend developers and DevOps engineers in an Agile environment."
            ),
            "applications": [
                # Highly Relevant
                {"user_id": "101", "application": "I have 6 years of Python and Django experience, built REST APIs, optimized PostgreSQL, and deployed on AWS."},
                {"user_id": "102", "application": "Django expert with 5+ years of experience. Strong background in PostgreSQL, CI/CD, and cloud deployments."},
                {"user_id": "103", "application": "Backend developer specializing in Django and Flask, experienced with Docker, Kubernetes, and AWS."},
                {"user_id": "104", "application": "Python engineer with extensive experience in Django, RESTful APIs, and Vue.js integration."},

                # Slightly Relevant
                {"user_id": "105", "application": "Full-stack developer with Node.js and React experience. Some experience working with Django."},
                {"user_id": "106", "application": "Backend engineer with Flask expertise, PostgreSQL experience, and some knowledge of Django."},
                {"user_id": "107", "application": "Worked with cloud services like AWS and Azure. Limited Django experience but strong Python skills."},

                # Irrelevant
                {"user_id": "108", "application": "Graphic designer with UI/UX expertise, no backend development experience."},
                {"user_id": "109", "application": "Marketing specialist with SEO and digital advertising experience, no programming knowledge."},
                {"user_id": "110", "application": "Customer service representative with experience in software inquiries but no coding background."}
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
