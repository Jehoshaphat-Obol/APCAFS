from django.urls import path
from .views import ValidateUsernameView, AssessUserView

app_name = "api"

urlpatterns = [
    path("v1/validate/", ValidateUsernameView.as_view(), name="validate_username"),
    path("v1/assess/", AssessUserView.as_view(), name="assess_profiles"),
]