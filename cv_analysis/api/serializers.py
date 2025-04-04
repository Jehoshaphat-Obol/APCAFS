from rest_framework import serializers

class ApplicationSerializer(serializers.Serializer):
    user_id = serializers.CharField()
    application = serializers.CharField()

class RankRequestSerializer(serializers.Serializer):
    job_post = serializers.CharField()
    applications = ApplicationSerializer(many=True)


class ResultSerializer(serializers.Serializer):
    user_id = serializers.CharField()
    score = serializers.FloatField()
    
class RankResponseSerializer(serializers.Serializer):
    results = ResultSerializer(many=True)