#!/bin/bash

# Replace with your Packagist username
PACKAGIST_USERNAME="jbwsft"

# Replace with your Packagist API token
PACKAGIST_API_TOKEN="af63f1d9c8399bc28f1c"

# Replace with your GitHub repository URL
GITHUB_REPOSITORY_URL="https://github.com/jbwsft/form-validator"

# Ensure the PACKAGIST_USERNAME, PACKAGIST_API_TOKEN, and GITHUB_REPOSITORY_URL are set
if [[ -z "$PACKAGIST_USERNAME" || -z "$PACKAGIST_API_TOKEN" || -z "$GITHUB_REPOSITORY_URL" ]]; then
  echo "Please set the PACKAGIST_USERNAME, PACKAGIST_API_TOKEN, and GITHUB_REPOSITORY_URL variables."
  exit 1
fi

# Create JSON payload
json_payload=$(jq -n --arg url "$GITHUB_REPOSITORY_URL" '{"repository": {"url": $url}}')

# Debug: Print JSON payload
echo "JSON Payload: $json_payload"

# Add the package to Packagist
response=$(curl -s -w "\nHTTP_CODE: %{http_code}\n" -X POST "https://packagist.org/api/create-package?username=$PACKAGIST_USERNAME&apiToken=$PACKAGIST_API_TOKEN" \
  -H "Content-Type: application/json" \
  -d "$json_payload")

# Debug: Print response for debugging
echo "Response: $response"

# Check the response code
http_code=$(echo "$response" | grep "HTTP_CODE" | awk '{print $2}')
if [ "$http_code" -eq 202 ]; then
  echo "Package submission successful!"
else
  echo "Package submission failed with response code: $http_code"
fi
