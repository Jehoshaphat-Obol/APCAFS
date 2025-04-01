from apify_client import ApifyClient
from configparser import ConfigParser

#* login credentials
config = ConfigParser()
config.read('config.ini')

token = config['APIFY']['token']

# Initialize the ApifyClient with your API token
client = ApifyClient(token)

# Prepare the Actor input
run_input={
  "maxItems": 10,
  "sort": "Latest",
  "startUrls": [
    "https://x.com/Cobratate"
  ]
}

# Run the Actor and wait for it to finish
run = client.actor("nfp1fpt5gUlBwPcor").call(run_input=run_input)

# Fetch and print Actor results from the run's dataset (if there are any)
for item in client.dataset(run["defaultDatasetId"]).iterate_items():
    print(item)