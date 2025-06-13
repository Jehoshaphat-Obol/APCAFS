from flask import Flask, request, jsonify, make_response
from werkzeug.exceptions import HTTPException
from selenium import webdriver
from selenium.webdriver.firefox.service import Service
from settings import *
from utils import *
import pickle
import time

# service = Service(executable_path=GECKO_DRIVER_PATH)

print("Loading Firefox Profile")
# Step 1: Create and Save Profile (This step runs once to create the profile)
profile_dir = get_firefox_profile()

print("Loading firefox browser")
# Step 2: Reuse the saved profile in the future
driver = use_existing_profile(profile_dir)

time.sleep(random.uniform(2,5))
app = Flask(__name__)

@app.route("/verify/",methods=['POST'])
def verify_account():
    data = request.get_json()
    
    if not data or (data.get("link") is None) or "x.com/" not in data.get("link"):
        return jsonify(
            {
                "status": "error",
                "message": "invalid json data"
            }
        )
        
    link = data.get("link")
    valid = check_account_existence(driver, link)
    
    return jsonify(
        {
            "status": "success" if valid else "error",
            "message": "",
            "data": {
                "is_valid": valid
            }
        }
    )
    
@app.route("/get-articles/", methods=["POST"])
def get_article():
    data = request.get_json()

    if not data or (data.get("link") is None) or "x.com/" not in data.get("link"):
        return jsonify(
            {
                "status": "error",
                "message": "invalid json data"
            }
        )
    
    link = data.get("link")
    articles = get_articles(driver, link)

    print(articles)
    
    return jsonify(
        {
            "status": "success",
            "message": "empty" if len(articles) == 0 else f"{len(articles)} were extracted",
            "data": {
                "articles": " ".join(articles)
            }
        }
    )
    
app.run(host="0.0.0.0", port=5000)
