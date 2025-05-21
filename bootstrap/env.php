<?php

$envPath = __DIR__ . '/../.env.local';
if (!file_exists($envPath)) {
    die('.env.local not loaded');
}

$lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (str_starts_with(trim($line), '#')) continue;
    list($key, $value) = explode('=', $line, 2);
    $key = trim($key);
    $value = trim($value);
    putenv("$key=$value");
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}