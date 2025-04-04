from django.urls import path
from .views import RankView

app_name = "api"
urlpatterns = [
    path("rank/", RankView.as_view(), name="rank"),
]
