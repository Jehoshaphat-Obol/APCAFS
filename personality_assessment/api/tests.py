import json
from django.test import TestCase
from django.urls import reverse

# Create your tests here.
class XTestCase(TestCase):
    def test_x_invalid_username(self):
        url = reverse("api:validate_username")
        response = self.client.post(url, {"username": "https://x.com/JeHoShaphat-Obol"}, content_type="application/json")
        self.assertEqual(200, response.status_code)
        
        data = json.loads(response.content)
        try:
            self.assertIn("status", data)
            self.assertIn("message", data)
            self.assertEqual("error", data["status"], "Invalid status code returned for invalid username")
        except Exception as e:
            print(f"Error: {e}")
            self.fail("Response has in valid Json structure")
            
        response = self.client.post(url, {"username": "https://x.com/JeHoShaphat_Obol"}, content_type="application/json")
        self.assertEqual(200, response.status_code)
        
        data = json.loads(response.content)
        try:
            self.assertIn("status", data)
            self.assertIn("message", data)
            self.assertEqual("error", data["status"], "Invalid status code returned for invalid username")
        except Exception as e:
            print(f"Error: {e}")
            self.fail("Response has in valid Json structure")
    
    
    def test_x_valid_username(self):
        url = reverse("api:validate_username")
        response = self.client.post(url, {"username": "https://x.com/JehoshaphatObol"}, content_type="application/json")
        self.assertEqual(200, response.status_code)
        
        data = json.loads(response.content)
        try:
            self.assertIn("status", data)
            self.assertIn("message", data)
            self.assertEqual("success", data["status"], "Invalid status code returned for invalid username")
        except Exception as e:
            print(f"Error: {e}")
            self.fail("Response has in valid Json structure")
            
class PersonalityAssessmentTestCase(TestCase):
    @classmethod
    def setUpTestData(cls):
        cls.invalid_data = {
            "personality_assessment": [
                {
                    "any_invalid_key": "asldk",
                }
            ]
        }
        
        cls.valid_data = {
            "personality_assessment": [
                {
                    "profile_id": 1,
                    "social_media_username": "https://x.com/elonmusk",
                },
                {
                    "profile_id": 2,
                    "social_media_username": "https://x.com/Cobratate",
                },
                {
                    "profile_id": 3,
                    "social_media_username": "https://x.com/JehoshaphatObol",
                },
            ]
        }
        
    def test_response_to_invalid_request(self):
        url = reverse('api:assess_profiles')
        
        response = self.client.post(url, self.invalid_data, content_type="application/json")
        self.assertEqual(400, response.status_code)
    
    def test_response_to_valid_request(self):
        url = reverse('api:assess_profiles')
        response = self.client.post(url, self.valid_data, content_type="application/json")
        
        # validate response has results
        data = json.loads(response.content)
        self.assertIn("results", data)
        
        # validate every profile has results
        results = data['results']
        self.assertEqual(len(results), len(self.valid_data['personality_assessment']))
        
        profile_ids = [profile['profile_id'] for profile in self.valid_data['personality_assessment']]
        for result in results:
            self.assertIn(result['profile_id'], [str(profile_id) for profile_id in profile_ids])
            self.assertIn("IE_score", result)
            self.assertIn("NS_score", result)
            self.assertIn("TF_score", result)
            self.assertIn("JP_score", result)
        
    

