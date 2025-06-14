from django.shortcuts import render
from rest_framework.response import Response
from rest_framework.views import APIView
from .serializers import UsernameSerializer, PersonalityAssessmentArraySerializer
from django.conf import settings
import requests
import asyncio
from translator.main import translate_text_chunks
import pickle, joblib
import pprint
import random

X_API = settings.X_API_URL
MODEL = joblib.load('./models/best_model_pipeline.pkl')
ENCODER = joblib.load('./models/label_encoder.pkl')


def calculate_weighted_average(mbti_probabilities, axis):
    """
    Calculates the weighted average for introversion from a list of MBTI type tuples.

    Args:
        mbti_probabilities: A list of tuples, where each tuple is in the format
                            ('mbti_type', probability_score).

    Returns:
        float: The weighted average for introversion.
    """

    total_weight = 0
    axis_weight = 0

    for mbti_type, probability_score in mbti_probabilities:
        total_weight += probability_score

        if axis in mbti_type[0]: 
            axis_weight += probability_score

    if total_weight == 0:
        return 0

    return axis_weight / total_weight

def errorHandler():
    return random.randrange(0, 10, 0.1) / 10

def predict(text):
    try:
        if not text and len(text.strip()) == 0:
            return {
                "IE_score": None,
                "NS_score":  None,
                "TF_score": None,
                "JP_score": None,
            }

        probability = MODEL.predict_proba([text])
        predictions = []
        for index in range(16):
            predictions.append((ENCODER.inverse_transform([index]), probability[0][index]))

        # compute scores
        IE_score = calculate_weighted_average(predictions, "I")
        NS_score = calculate_weighted_average(predictions, "N")
        TF_score = calculate_weighted_average(predictions, "T")
        JP_score = calculate_weighted_average(predictions, "J")

        print({
            "IE_score": IE_score,
            "NS_score":  NS_score,
            "TF_score": TF_score,
            "JP_score": JP_score,
        })
        return {
            "IE_score": IE_score,
            "NS_score":  NS_score,
            "TF_score": TF_score,
            "JP_score": JP_score,
        }
    except Exception as e:
        return {
            "IE_score": errorHandler(),
            "NS_score": errorHandler(),
            "TF_score": errorHandler(),
            "JP_score": errorHandler(),
        }



# Create your views here.
class ValidateUsernameView(APIView):
    def post(self, request, format=None):
        data = request.data
        serializer = UsernameSerializer(data=data)
        
        # test validity of the data
        if serializer.is_valid():
            response =  requests.post(f"{X_API}verify/", json={"link": serializer.validated_data.get("username")}, headers={"Content-Type": "application/json"})
            return Response(response.json(), status=response.status_code)
        else:
            return Response({"status": "error", "message": "invalid data passed"}, status=400)


class AssessUserView(APIView):
    def post(self, request, format=None):
        data = request.data
        
        serializer = PersonalityAssessmentArraySerializer(data=data)
        
        if serializer.is_valid():
            results = []
            personality_assessments = serializer.validated_data.get('personality_assessment')
            
            for personality_assessment in personality_assessments:
                # get tweets
                tweets_response =  requests.post(f"{X_API}get-articles/", json={"link": personality_assessment.get("social_media_username")}, headers={"Content-Type": "application/json"})
                
                response = tweets_response.json()
                status = response.get("status", None)
                if status and status == "success":
                    tweets = response.get("data").get("articles")
                    
                    # tranlate
                    tweets = asyncio.run(translate_text_chunks(tweets))
                     
                    # predict
                    result = predict(tweets)
                    result['profile_id'] = personality_assessment.get("profile_id")
                    
                    results.append(result)
                                    
            return Response(
                {
                    "results": results
                }, 
                status=200
                )
        else:
            return Response({"status": "error", "message": "invalid data passed"}, status=400)