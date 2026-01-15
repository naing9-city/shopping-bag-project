@echo off
echo Starting PHP Server at http://localhost:9000
echo Press Ctrl+C to stop the server
cd /d "%~dp0"
php -S localhost:9000
pause
