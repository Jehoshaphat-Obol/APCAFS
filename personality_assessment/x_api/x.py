import requests
from configparser import ConfigParser



#* login credentials
config = ConfigParser()
config.read('config.ini')
bearer_token = config['X']['token']

def get_user_info(username):
    """
    Retrieves user information from the X (formerly Twitter) API.

    Args:
        username (str): The username of the X user.

    Returns:
        dict or None: A dictionary containing user information, or None if an error occurs.
    """
    url = f"https://api.x.com/2/users/by/username/{username}"
    headers = {
        "Authorization": f"Bearer {bearer_token}"
    }

    try:
        response = requests.get(url, headers=headers)
        response.raise_for_status()  # Raise HTTPError for bad responses (4xx or 5xx)
        return response.json()
    except requests.exceptions.RequestException as e:
        print(f"Error fetching user information: {e}")
        if response is not None:
            print(f"Response status code: {response.status_code}")
            try:
                print(f"Response body: {response.json()}")
            except:
                print(f"Response body: {response.text}")

        return None
    
print(get_user_info('musk'))