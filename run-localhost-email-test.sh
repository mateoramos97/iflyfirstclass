#!/bin/bash

echo "========================================="
echo "IFlyFirstClass - Email Testing Setup"
echo "========================================="
echo ""
echo "Starting PHP development server..."
echo "Server will run at: http://localhost:8080"
echo ""
echo "Available test pages:"
echo "- http://localhost:8080/test-email.php (Email Test)"
echo "- http://localhost:8080/view-emails.php (View Saved Emails)"
echo "- http://localhost:8080/ (Main Site)"
echo ""
echo "Press Ctrl+C to stop the server"
echo "========================================="
echo ""

# Start PHP built-in server
php -S localhost:8080 -t frontend/web/
