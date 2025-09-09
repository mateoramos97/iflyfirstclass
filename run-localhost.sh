#!/bin/bash

echo "Starting IFlyFirstClass Development Servers..."

# Start frontend server in background
echo "Starting Frontend on http://localhost:8080"
php yii serve --docroot=frontend/web --port=8080 &
FRONTEND_PID=$!

# Start backend server in background  
echo "Starting Backend on http://localhost:8081"
php yii serve --docroot=backend/web --port=8081 &
BACKEND_PID=$!

echo "Servers started!"
echo "Frontend: http://localhost:8080"
echo "Backend: http://localhost:8081"
echo ""
echo "Press Ctrl+C to stop servers"

# Wait for interrupt signal
trap "echo 'Stopping servers...'; kill $FRONTEND_PID $BACKEND_PID; exit" INT
wait