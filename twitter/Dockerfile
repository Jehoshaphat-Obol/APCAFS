FROM python:3.11-slim

# Install system dependencies
RUN apt update && apt install -y \
    firefox-esr \
    libgtk-3-0 \
    libx11-xcb1 \
    libdbus-glib-1-2 \
    libxt6 \
    libxcomposite1 \
    libxrandr2 \
    libasound2 \
    libxdamage1 \
    libpango-1.0-0 \
    libcups2 \
    wget \
    firefox-esr \
    ca-certificates \
    && apt clean \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /home/app

# Copy requirements and install Python packages
COPY requirements.txt .
RUN python -m venv env && \
    ./env/bin/pip install --upgrade pip && \
    ./env/bin/pip install -r requirements.txt

# Copy the rest of your source code
COPY . .

# Make the Firefox profile persistent
VOLUME ["/home/app/firefox_profile"]

RUN apt install -y libgtk-3-0 libx11-xcb1 libdbus-glib-1-2 libxt6 libxcomposite1 libxrandr2 libasound2 libxdamage1 libpango-1.0-0 libcups2


# Expose the port your app runs on
EXPOSE 5000

# Start the app using the venv Python interpreter
CMD ["./env/bin/python", "api.py"]
