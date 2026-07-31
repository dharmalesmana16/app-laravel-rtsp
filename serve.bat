@echo off
setlocal EnableExtensions
cd /d "%~dp0"

set "STREAM_APP=rtsp-stream"
set "PM2_AVAILABLE=0"

where pm2 >nul 2>nul
if not errorlevel 1 set "PM2_AVAILABLE=1"

echo [serve] menyiapkan Stream service (Node + ffmpeg)...

if "%PM2_AVAILABLE%"=="1" (
    if exist ecosystem.config.cjs (
        call pm2 describe %STREAM_APP% >nul 2>nul
        if not errorlevel 1 (
            echo [serve] PM2 '%STREAM_APP%' sedang berjalan -^> restart
            call pm2 restart %STREAM_APP% --update-env --silent
        ) else (
            echo [serve] memulai PM2 '%STREAM_APP%'...
            call pm2 start ecosystem.config.cjs --silent
        )
        echo [serve] Stream service aktif. Lihat log: pm2 logs %STREAM_APP%
    )
) else (
    echo [serve] WARN: pm2 tidak terinstall -^> pakai nodemon fallback ^(npm i -g pm2 untuk produksi^)
    start "rtsp-stream" /min cmd /k "npm run start"
)

echo [serve] menjalankan Vite dev server...
start "rtsp-vite" /min cmd /k "npm run dev"

echo [serve] menjalankan Laravel server...
start "rtsp-laravel" /min cmd /k "php artisan serve --port=8000"

echo.
echo ============================================================
echo  [serve] Server aktif:
echo   - Laravel : http://localhost:8000
echo   - Vite    : http://localhost:5173
echo   - Stream  : pm2 logs %STREAM_APP%
echo.
echo  Tekan tombol apa saja untuk menghentikan SEMUA proses...
echo  ^(Ctrl+C pada window ini TIDAK akan cleanup - tutup manual^)
echo ============================================================
pause >nul

call :cleanup
echo [serve] semua proses dihentikan. Window sisa dapat ditutup manual.
endlocal
exit /b 0

:cleanup
    echo [serve] menghentikan Stream service...
    if "%PM2_AVAILABLE%"=="1" (
        call pm2 stop %STREAM_APP% --silent >nul 2>nul
    )
    echo [serve] menghentikan Vite dan Laravel...
    powershell -NoProfile -Command "$me=$PID; Get-CimInstance Win32_Process | Where-Object { $_.ProcessId -ne $me -and ($_.CommandLine -match 'node.*vite|npm run dev|npm run start|artisan serve|stream\.js') } | ForEach-Object { Stop-Process -Id $_.ProcessId -Force -ErrorAction SilentlyContinue }"
    exit /b 0
