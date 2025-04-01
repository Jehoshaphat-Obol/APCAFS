from dotenv import load_dotenv
import os

load_dotenv()

GECKO_DRIVER_PATH = "./geckodriver"
BASE_URL = os.getenv("BASE_URL")
LOGIN_URL = os.getenv("LOGIN_URL")
USERNAME = os.getenv("USERNAME")
PASSWORD = os.getenv("PASSWORD")
EMAIL = os.getenv("EMAIL")

if not LOGIN_URL or not USERNAME or not PASSWORD or not EMAIL:
    print("Missing environment variables")
    print("LOGIN_URL:", LOGIN_URL)
    print("USERNAME:", USERNAME)
    print("EMAIL:", EMAIL)
    print("PASSWORD:", PASSWORD is not None)
    exit(0)

# selectors
USERNAME_INPUT_FIELD_CSS_SELECTOR = 'input[autocomplete="username"]'
SIGN_IN_NEXT_BUTTON_CSS_SELECTOR = 'button.css-175oi2r.r-sdzlij.r-1phboty.r-rs99b7.r-lrvibr.r-ywje51.r-184id4b.r-13qz1uu.r-2yi16.r-1qi8awa.r-3pj75a.r-1loqt21.r-o7ynqc.r-6416eg.r-1ny4l3l'
PASSWORD_INPUT_FIELD_CSS_SELECTOR = 'input[name="password"]'
LOGIN_BUTTON_CSS_SELECTOR = 'button.css-175oi2r.r-sdzlij.r-1phboty.r-rs99b7.r-lrvibr.r-19yznuf.r-64el8z.r-1fkl15p.r-1loqt21.r-o7ynqc.r-6416eg.r-1ny4l3l'
ARTICLE_CONTAINER_CSS_SELECTOR = 'section.css-175oi2r:nth-child(3) > div:nth-child(2) > div:nth-child(1)'
ARTICLE_CSS_SELECTOR = 'section.css-175oi2r:nth-child(3) > div:nth-child(2) > div:nth-child(1) article'
PROFILE_CONTAINER_CSS_SELECTOR = '.r-1xk7izq'