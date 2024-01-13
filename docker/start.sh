#!/usr/bin/env bash

set -e

role=$1

./artisan config:cache

if [[ $role = "web" ]]; then
    ./artisan route:cache
    >&2 echo "Starting Laravel Webserver"
    ./artisan serve --port 8000 --host 0.0.0.0
elif [[ $role = "cron" ]]; then
    >&2 echo "Starting Laravel Cron"
    ./artisan schedule:work
else
    >&2 echo "Unknown container role \"$role\""
    exit 1
fi
