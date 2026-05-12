@echo off
echo Starting Laravel Development Server
echo ===================================
echo.

set PHP_PATH="C:\xamppp\php\php.exe"

if not exist %PHP_PATH% (
    echo ERROR: PHP not found at %PHP_PATH%
    pause
    exit /b 1
)

echo Using PHP at: %PHP_PATH%
echo.
echo Starting server at http://localhost:8000
echo Press Ctrl+C to stop the server
echo ===================================
echo.

%PHP_PATH% artisan serve