#!/bin/bash

# Check if a domain is provided
if [ -z "$1" ]; then
    echo "Usage: $0 domain-to-remove.com"
    exit 1
fi

REMOVE_DOMAIN=$1
CONFIG_FILE="/etc/nginx/sites-enabled/salembookshop.ae.conf"

# Check if the configuration file exists
if [ ! -f "$CONFIG_FILE" ]; then
    echo "Error: $CONFIG_FILE not found!"
    exit 1
fi

# Remove the domain from the server_name directive on line 27
sed -i "/server_name/s/$REMOVE_DOMAIN//g" "$CONFIG_FILE"

# Test Nginx configuration
echo "Testing Nginx configuration..."
sudo nginx -t

# Check if the Nginx configuration is valid
if [ $? -ne 0 ]; then
    echo "Nginx configuration test failed. Aborting."
    exit 1
fi

# Revoke SSL certificate for the domain using Certbot
sudo certbot revoke --cert-name $REMOVE_DOMAIN --non-interactive

# Remove the SSL certificate files (optional)
sudo rm -rf /etc/letsencrypt/live/$REMOVE_DOMAIN
sudo rm -rf /etc/letsencrypt/archive/$REMOVE_DOMAIN
sudo rm -rf /etc/letsencrypt/renewal/$REMOVE_DOMAIN.conf

# Reload Nginx to apply changes
echo "Reloading Nginx..."
sudo systemctl reload nginx

echo "Domain $REMOVE_DOMAIN has been successfully removed from $CONFIG_FILE and its SSL certificate has been revoked."