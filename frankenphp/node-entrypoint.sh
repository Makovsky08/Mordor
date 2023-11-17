#!/bin/bash

# Install Node.js dependencies
echo "Installing Node.js dependencies..."
# Check if the 'node_modules/' directory is empty and run 'npm install' if it is
if [ -z "$(ls -A 'node_modules/' 2>/dev/null)" ]; then
    npm install
fi

# Execute the passed command
echo "Running command: $@"
exec "$@"