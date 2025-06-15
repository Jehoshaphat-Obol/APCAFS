#!/bin/bash

set -e  # Exit on any error

# Create custom network and volumes if not exist
sudo docker network inspect appnet >/dev/null 2>&1 || sudo docker network create appnet
sudo docker volume inspect mysql_data >/dev/null 2>&1 || sudo docker volume create mysql_data

# Ctrl+C handler to stop all containers
trap cleanup INT

cleanup() {
  echo "Stopping all containers..."
  sudo docker stop apcafs-backend apcafs-cv_analysis apcafs-personality apcafs-twitter >/dev/null 2>&1 || true
  exit 0
}

echo "Building all containers..."
sudo docker build -t apcafs-backend ./backend
sudo docker build -t apcafs-cv_analysis ./cv_analysis
sudo docker build -t apcafs-personality ./personality_assessment
sudo docker build -t apcafs-twitter ./twitter

echo "Starting services..."

# Start twitter service
sudo docker run --rm -i \
  --name apcafs-twitter \
  --network appnet \
  -p 5000:5000 \
  --shm-size=1g \
  -v ./twitter:/app \
  -v /dev/shm:/dev/shm \
  --privileged \
  apcafs-twitter &
pid_twitter=$!

# Start personality_assessment service
sudo docker run --rm -i \
  --name apcafs-personality \
  -p 8000:8000\
  --network appnet \
  -v ./personality_assessment:/app \
  apcafs-personality &
pid_personality=$!

# Start cv_analysis service
sudo docker run --rm -i \
  --name apcafs-cv_analysis \
  -p 3000:3000 \
  --network appnet \
  -v ./cv_analysis/model/:/app/model/ \
  apcafs-cv_analysis &
pid_cv=$!

# Start backend service last (depends on others)
sudo docker run --rm -i \
  --name apcafs-backend \
  --network appnet \
  -p 80:8080 \
  -p 3306:3306 \
  -v ./backend:/app \
  -v mysql_data:/var/lib/mysql \
  -e MYSQL_ROOT_PASSWORD="" \
  apcafs-backend &
pid_backend=$!

echo "All services running. Press Ctrl+C to stop."

# Wait on all background PIDs
wait $pid_twitter $pid_personality $pid_cv $pid_backend
