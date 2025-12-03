<?php

// Absolute path to /web folder
$web = __DIR__ . '/web';

// Set request path
$request = $_SERVER['REQUEST_URI'];

// Prevent query strings from breaking static checks
$requestPath = parse_url($request, PHP_URL_PATH);

// Full file path
$file = $web . $requestPath;

// If the file exists IN /web, serve it directly with proper MIME type
if (is_file($file)) {
    // Set proper content type for common file types
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    $mimeTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'eot' => 'application/vnd.ms-fontobject',
    ];
    
    if (isset($mimeTypes[$extension])) {
        header('Content-Type: ' . $mimeTypes[$extension]);
    }
    
    return false;
}

// For everything else → run Yii via index.php
require $web . '/index.php';
