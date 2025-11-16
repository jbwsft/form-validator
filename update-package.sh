#!/bin/bash

PACKAGIST_USERNAME="jbwsft"
PACKAGIST_API_TOKEN="af63f1d9c8399bc28f1c"
GITHUB_REPOSITORY_URL="https://github.com/jbwsft/form-validator"

if [[ -z "$PACKAGIST_USERNAME" || -z "$PACKAGIST_API_TOKEN" || -z "$GITHUB_REPOSITORY_URL" ]]; then
  echo "Missing required variables."
  exit 1
fi

payload="{\"repository\":{\"url\":\"$GITHUB_REPOSITORY_URL\"}}"

response=$(curl -s -w "\nHTTP_CODE:%{http_code}" \
  -X POST "https://packagist.org/api/update-package?username=$PACKAGIST_USERNAME&apiToken=$PACKAGIST_API_TOKEN" \
  -H "Content-Type: application/json" \
  -d "$payload")

echo "$response"
