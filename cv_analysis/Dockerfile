FROM python:3.11-slim

ENV DEBIAN_FRONTEND=noninteractive

# System deps
RUN apt-get update && apt-get install -y \
    build-essential \
    python3-venv \
    python3-dev \
    libpq-dev \
    postgresql \
    postgresql-contrib \
    postgresql-server-dev-all \
    git \
    curl && \
    rm -rf /var/lib/apt/lists/*

# Install pgvector
RUN git clone https://github.com/pgvector/pgvector.git && \
    cd pgvector && \
    make && make install && \
    cd .. && rm -rf pgvector

# Create db user & data folder
RUN service postgresql start && \
    su - postgres -c "psql -c \"CREATE USER jehoshaphat WITH PASSWORD 'strongpassword';\"" && \
    su - postgres -c "psql -c \"CREATE DATABASE resume_db OWNER jehoshaphat;\"" && \
    su - postgres -c "psql -d resume_db -c 'CREATE EXTENSION vector;'"

# App setup
WORKDIR /app
COPY . /app
RUN python -m venv env
RUN ./env/bin/pip install --upgrade pip
RUN ./env/bin/pip install --no-index --find-links=./wheels -r requirements.txt
RUN ./env/bin/python -m nltk.downloader punkt punkt_tab -d /app/api/nltk_data
RUN ./env/bin/pip install pgvector

EXPOSE 3000

CMD bash -c "service postgresql start && \
    ./env/bin/python manage.py makemigrations && \
    ./env/bin/python manage.py migrate && \
    ./env/bin/python manage.py runserver 0.0.0.0:3000"


