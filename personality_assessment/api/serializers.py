from rest_framework import serializers

class UsernameSerializer(serializers.Serializer):
    username = serializers.CharField(max_length=40)

class PersonalityAssessmentSerializer(serializers.Serializer):
    profile_id= serializers.CharField(max_length=15)
    social_media_username = serializers.CharField(max_length=40)
    
class PersonalityAssessmentArraySerializer(serializers.Serializer):
    personality_assessment = PersonalityAssessmentSerializer(many=True)