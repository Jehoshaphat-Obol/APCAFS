FROM debian:12.10-slim

# Environment variables to make Firefox work in headless mode
ENV LANG=C.UTF-8
ENV LC_ALL=C.UTF-8

# Install system dependencies
RUN apt update

RUN apt install -y libgtk-3-0
RUN apt install -y xz-utils
RUN apt install -y libx11-xcb1
RUN apt install -y libdbus-glib-1-2
RUN apt install -y libxt6
RUN apt install -y libxcomposite1
RUN apt install -y libxrandr2
RUN apt install -y libasound2
RUN apt install -y libxdamage1
RUN apt install -y libpango-1.0-0
RUN apt install -y libcups2
RUN apt install -y wget
RUN apt install -y python3.11
RUN apt install -y python3.11-venv
RUN apt install -y python3-pip
RUN apt install -y gcc
RUN apt install -y ca-certificates

RUN apt clean
RUN rm -rf /var/lib/apt/lists/*


# Set working directory
WORKDIR /home/app
RUN ln -s /usr/bin/python3.11 /usr/bin/python

COPY requirements.txt .
RUN python -m venv env
RUN ./env/bin/pip install --upgrade pip
RUN ./env/bin/pip install -r requirements.txt

# Copy the rest of your code
COPY . .

# ✅ Download and install Firefox 139.0.1 (.tar.xz)
RUN mv ./firefox-139.0.1.tar.xz /tmp/firefox.tar.xz  \
    && tar -xJf /tmp/firefox.tar.xz -C /opt/ \
    && ln -s /opt/firefox/firefox /usr/bin/firefox \
    && rm /tmp/firefox.tar.xz
    
# Add geckodriver
RUN tar -xzf geckodriver-v0.36.0-linux64.tar.gz \
    && mv geckodriver /usr/local/bin/ \
    && chmod +x /usr/local/bin/geckodriver \
    && rm geckodriver-v0.36.0-linux64.tar.gz


# Make Firefox profile persistent
VOLUME ["/home/app/firefox_profile"]

# Expose app port
EXPOSE 5000

# Run your app
CMD ["./env/bin/python", "api.py"]
