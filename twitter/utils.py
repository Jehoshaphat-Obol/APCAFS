import os
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.firefox.options import Options
import shutil
import pickle
from settings import *
import time, random, json
from urlextract import URLExtract

import re

def login(driver, username, password, cookies_file="./cookies.pkl"):
    """
    Logs in to a website using Selenium, saves cookies, and handles potential login failures.

    Args:
        driver: Selenium webdriver instance.
        username: The username for login.
        password: The password for login.
        cookies_file: Name of the file to save cookies to.
    """

    try:
        driver.get(LOGIN_URL)

        # Enter username and click "next"
        print("simulating random wait before entering username")
        time.sleep(random.uniform(1,5))
        username_input = WebDriverWait(driver, 10).until(
            EC.presence_of_element_located((By.CSS_SELECTOR, USERNAME_INPUT_FIELD_CSS_SELECTOR))
        )
        username_input.send_keys(username)
        
        print("simulating random wait before clicking next")
        time.sleep(random.uniform(1,5))
        next_button = WebDriverWait(driver, 10).until(
            EC.element_to_be_clickable((By.CSS_SELECTOR, SIGN_IN_NEXT_BUTTON_CSS_SELECTOR))
        )
        next_button.click()

        
        print("simulating random wait before entering password")
        time.sleep(random.uniform(1,5))
        # Enter password and click "login"
        password_input = WebDriverWait(driver, 10).until(
            EC.presence_of_element_located((By.CSS_SELECTOR, PASSWORD_INPUT_FIELD_CSS_SELECTOR))
        )
        password_input.send_keys(password)

        
        print("simulating random wait before cliking login")
        time.sleep(random.uniform(1,5))
        
        login_button = WebDriverWait(driver, 10).until(
            EC.element_to_be_clickable((By.CSS_SELECTOR, LOGIN_BUTTON_CSS_SELECTOR))
        )
        login_button.click()


    except Exception as e:
        print(f"Login failed: {e}")
        exit(1)
        


def clean(text):
    def remove_url(text):
        extractor = URLExtract()
        urls = extractor.find_urls(text)
        
        for url in urls:
            text = text.replace(url, '')
    
        return text
    def clean_header_footer(text):
      """Removes header/footer text and extraneous lines."""
      patterns = [
          r"see new posts\s*",
          r"who to follow\s*",
          r"terms of service\s*",
          r"privacy policy\s*",
          r"cookie policy\s*",
          r"accessibility\s*",
          r"ads info\s*",
          r"more\s*",
          r"© 2025 x corp.\s*"
      ]
      for pattern in patterns:
        text = re.sub(pattern, " ", text, flags=re.IGNORECASE)

      return text
  
    def clean_article_content(text):
        """Cleans article content by removing prefixes, handles, timestamps, and reaction counts."""

        # Remove Article #, Profile, and Quote prefixes
        text = re.sub(r"Quote\s*", " ", text)
        text = remove_url(text)
        
        # Remove @usernames
        text = re.sub(r"@\w+\s*", " ", text)

        # Remove time stamps (hours, minutes, seconds, days, weeks, months)
        text = re.sub(r"\s*·\s*(\d+[smhdwy]|Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s*\d*\s*", " ", text, flags=re.IGNORECASE)


        # Remove Show and From semafor.com lines
        text = re.sub(r"Show\s*", " ", text)

        # Remove reaction counts
        text = re.sub(r"\s*\d+\.?\d*[KM]?\s*", " ", text)

        # Remove ellipses
        text = re.sub(r"\.\.\.\s*", " ", text)

        #Remove special character
        text = re.sub(r"𝕏\s*", " ", text)

        return text


    text = clean_header_footer(text)
    text = clean_article_content(text)
    return text


def check_account_existence(driver, profile_url):
    """
    Checks if a specific text exists within the body of the page using Selenium.

    Args:
        driver: Selenium WebDriver instance.
        profile_url: link to the profile.

    Returns:
        True if the profile exists, False if the profile doesn't exist.
    """
    driver.get(profile_url)
    target_text = "this account doesn’t exist"
    
    def validate_x_username(profile_url):
        """
        Validates and extracts a username from an X (formerly Twitter) URL or a plain username.

        Args:
            profile_url (str): The URL or username to validate.

        Returns:
            bool: True if the username is valid, False otherwise.
        """

        # Extract username from URL if it's a URL
        if "x.com" in profile_url:
            match = re.search(r"x\.com/(/?)([\w_]{2,15})/?$", profile_url, re.IGNORECASE)
            if match:
              username = match.group(2)
            else:
              return False
        else:
            username = profile_url

        # Validate username
        if re.match(r"^[\w_]{2,15}$", username):
            return True
        else:
            return False

    valid_username = validate_x_username(profile_url)
    
    try:
        # Wait for the body to be loaded
        WebDriverWait(driver, 10).until(
            EC.presence_of_element_located((By.TAG_NAME, 'body'))
        )
        
        # Get the entire body text of the page
        
        # Use JavaScript to get the entire body text of the page
        time.sleep(2)
        body_text = driver.execute_script("return document.body.innerText").lower()
        print(f"body text: {body_text}")

        # Check if the target text exists in the body text
        if target_text.lower() in body_text:
            # print(f"profile not found: {profile_url}")
            return False
        else:
            # print(f"profile found: {profile_url}")
            return True and valid_username

    except Exception as e:
        print(f"Error: {e}")
        return False
        
def get_articles(driver, profile_url, target_count=10+random.uniform(1,5)):
    if not check_account_existence(driver, profile_url):
        print(f"Profile {profile_url}: Not found")
        return []

    articles = set()  # Store article texts instead of elements
    scroll_attempts = 0
    max_scroll_attempts = 5

    try:
        driver.get(profile_url)
        time.sleep(3)
    except Exception as e:
        print(f"Error loading profile: {e}")
        return []

    while len(articles) < target_count and scroll_attempts < max_scroll_attempts:
        try:
            time.sleep(random.uniform(1, 3))
            
            # Find elements and extract text immediately
            new_articles = driver.find_elements(By.CSS_SELECTOR, ARTICLE_CSS_SELECTOR)
            prev_count = len(articles)

            for article in new_articles:
                text = clean(article.text.strip())
                if text:  # Ensure non-empty texts
                    articles.add(text)

            if len(articles) == prev_count:
                scroll_attempts += 1
            else:
                scroll_attempts = 0

            driver.execute_script("window.scrollBy(0, window.innerHeight);")
            time.sleep(2)

        except Exception as e:
            print(f"Error during scrolling: {e}")
            break

    print(articles)
    return list(articles)  # Convert to list before returning


def get_firefox_profile():
    # Specify the path where the new profile will be stored
    profile_dir = os.path.join(os.getcwd(), "firefox_profile")

    # Create the Firefox profile directory if it doesn't exist
    os.makedirs(profile_dir, exist_ok=True)

    return profile_dir

def use_existing_profile(profile_dir):
    # Now use the saved profile in future sessions
    options = Options()
    print(profile_dir)
    options.add_argument("-profile")
    options.add_argument(profile_dir)
    options.add_argument("--headless")
    options.add_argument("--no-sandbox") # Recommended for Docker
    options.add_argument("--disable-dev-shm-usage")
    # Start Firefox with the custom profile
    driver = webdriver.Firefox(options=options)

    # login
    driver.get(BASE_URL)

    # Check if redirected to login page
    if driver.current_url == LOGIN_URL:
        login(driver, USERNAME, PASSWORD)

    # Continue working with the logged-in session
    return driver
