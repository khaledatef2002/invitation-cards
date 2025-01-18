#!/bin/bash

# Check if a domain is provided
if [ -z "$1" ]; then
    echo "Usage: $0 new-domain.com"
    exit 1
fi

NEW_DOMAIN=$1
CONFIG_FILE="/etc/nginx/sites-enabled/salembookshop.ae.conf"

# Check if the configuration file exists
if [ ! -f "$CONFIG_FILE" ]; then
    echo "Error: $CONFIG_FILE not found!"
    exit 1
fi

# Add new domain to the server_name directive on line 27
sed -i "/server_name salembookshop.ae www1.salembookshop.ae/ s/;/ $NEW_DOMAIN;/" "$CONFIG_FILE"

# Test Nginx configuration
echo "Testing Nginx configuration..."
sudo nginx -t

# Check if the Nginx configuration is valid
if [ $? -ne 0 ]; then
    echo "Nginx configuration test failed. Aborting."
    exit 1
fi

sudo certbot --nginx -d $NEW_DOMAIN

# Reload Nginx to apply changes
echo "Reloading Nginx..."
sudo systemctl reload nginx

echo "New domain $NEW_DOMAIN added successfully to $CONFIG_FILE!"