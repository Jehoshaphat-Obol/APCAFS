from ntscraper import Nitter

scraper = Nitter(log_level=1, skip_instance_check=False)

bezos_tweets = scraper.get_tweets("JeffBezos", mode='user')
print(bezos_tweets)

bezos_information = scraper.get_profile_info("JeffBezos")
print(bezos_information)

bezos_information = scraper.get_profile_info("jeffBezos")
print(bezos_information)

bezos_information = scraper.get_profile_info("jeffBezosdszxwy")
print(bezos_information)