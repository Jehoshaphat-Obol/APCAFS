import requests
from configparser import ConfigParser


#* login credentials
config = ConfigParser()
config.read('config.ini')
bearer_token = config['X']['twitterapi']


def get_user_info(username):
    url = "https://api.twitterapi.io/twitter/user/info"
    querystring = {"userName":username}
    headers = {"X-API-Key": bearer_token}

    response = requests.request("GET", url, headers=headers, params=querystring)
    print(response.text)
    
def get_users_last_tweets(username):
    url = "https://api.twitterapi.io/twitter/user/last_tweets"

    querystring = {"userName":username}

    headers = {"X-API-Key": bearer_token}
    response = requests.request("GET", url, headers=headers, params=querystring)

    print(response.text)
    
    
get_users_last_tweets("jehoshaphatobol")
