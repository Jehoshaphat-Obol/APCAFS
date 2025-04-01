FROM debian:12.10-slim

# update
RUN apt update

# install firefox
RUN apt install firefox-esr -y

# install python
RUN apt install python3.11 -y

# install python venv module
RUN apt install python3.11-venv -y

# install pip
RUN apt install python3-pip -y

# create app directory
RUN mkdir -p /home/app

# change the working directory to app
WORKDIR /home/app

# create a virtual environmen for python
RUN python3.11 -m venv env


# migrage source codes
COPY . .

# activate the python virtual environment and install dependencies
RUN . ./env/bin/activate && pip install -r requirements.txt

# make the firefox_profile persistent
VOLUME ["/home/app/firefox_profile"]

# run the app
CMD ["sh", "-c", ". ./env/bin/activate && python3 ./api.py"]

# expose the port number
EXPOSE 5000