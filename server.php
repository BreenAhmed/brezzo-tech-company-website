<?php
// Custom router for PHP's built-in server to serve static assets correctly.
if (php_sapi_name() === 'cli-server') {
    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $filePath = __DIR__ . $urlPath;

    if ($urlPath !== '/' && file_exists($filePath) && is_file($filePath)) {
        return false;
    }
}

require __DIR__ . '/index.php';

