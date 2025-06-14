FROM debian:12.10-slim

# update
RUN apt update

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
RUN . ./env/bin/activate && pip install --default-timeout=100 --retries=10 -r requirements.txt
RUN . ./env/bin/activate && pip install --default-timeout=100 --retries=10 -r requirement2.txt

# run the app
CMD ["sh", "-c", ". ./env/bin/activate && python3 manage.py runserver 0.0.0.0:8000"]

# expose the port number
EXPOSE 8000