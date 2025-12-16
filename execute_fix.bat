@echo off
echo ========================================
echo Fixing TipCuloare Database Error
echo ========================================
echo.

cd /d "c:\xampp\mysql\bin"

echo Running SQL fix...
mysql -u root -e "USE glowskin; ALTER TABLE products ADD COLUMN IF NOT EXISTS TipCuloare VARCHAR(50) DEFAULT NULL COMMENT 'Product color type';"

if %errorlevel% equ 0 (
    echo.
    echo ========================================
    echo SUCCESS! Database fixed!
    echo ========================================
    echo.
    echo The TipCuloare column has been added.
    echo You can now refresh your browser and the error should be gone.
    echo.
) else (
    echo.
    echo ========================================
    echo ERROR! Could not fix database.
    echo ========================================
    echo.
    echo Please run the fix manually in phpMyAdmin.
    echo.
)

pause
