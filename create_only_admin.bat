@echo off
echo Creating only admin user...
echo.

C:\xamppp\php\php.exe artisan db:seed --class=OnlyAdminSeeder

echo.
echo Done! Try logging in now.
pause