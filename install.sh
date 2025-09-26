#!/bin/bash


echo "▗▄▄▖ ▗▄▖ ▗▄▄▖▗▄▄▄▖▗▖ ▗▖▗▄▄▖ ▗▄▄▄▖    ▗▄▄▄▖▗▖ ▗▖▗▄▄▄▖    ▗▄▄▄▖▗▖    ▗▄▖  ▗▄▄▖ "
echo "▐▌   ▐▌ ▐▌▐▌ ▐▌ █  ▐▌ ▐▌▐▌ ▐▌▐▌         █  ▐▌ ▐▌▐▌       ▐▌   ▐▌   ▐▌ ▐▌▐▌   "
echo "▐▌   ▐▛▀▜▌▐▛▀▘  █  ▐▌ ▐▌▐▛▀▚▖▐▛▀▀▘      █  ▐▛▀▜▌▐▛▀▀▘    ▐▛▀▀▘▐▌   ▐▛▀▜▌▐▌▝▜▌"
echo "▝▚▄▄▖▐▌ ▐▌▐▌    █  ▝▚▄▞▘▐▌ ▐▌▐▙▄▄▖      █  ▐▌ ▐▌▐▙▄▄▖    ▐▌   ▐▙▄▄▖▐▌ ▐▌▝▚▄▞▘"

echo "Installing Capture-the-Flag contest!"


composer install
php artisan migrate --silent --force
php artisan db:seed -q --force
yarn install --non-interactive


echo "Install done."
echo "To start type:"
echo "php artisan serve"
echo "npm run dev"
echo ""
echo "Happy hunting"
