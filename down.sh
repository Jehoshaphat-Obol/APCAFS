#!/bin/bash

set -e

echo "Stopping and removing containers..."

# Stop containers if running
sudo docker stop apcafs-backend apcafs-cv_analysis apcafs-personality apcafs-twitter 2>/dev/null || true

# Containers run with --rm, so they are already removed after stop

echo "Removing network 'appnet'..."
sudo docker network rm appnet 2>/dev/null || echo "Network already removed or not found."

# Optional: Prompt before deleting volumes
read -p "Do you also want to remove volumes (mysql_data)? [y/N] " -r
if [[ "$REPLY" =~ ^[Yy]$ ]]; then
  echo "Removing volume 'mysql_data'..."
  sudo docker volume rm mysql_data 2>/dev/null || echo "Volume not found or already removed."
else
  echo "Skipped volume removal."
fi

echo "Done."
