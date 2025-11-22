<?php
// app/config/config.php

$envPath = dirname(__DIR__, 2) . '/.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) continue;

        // Tách KEY=VALUE
        [$name, $value] = array_map('trim', explode('=', $line, 2));

        // Gỡ dấu nháy nếu có
        $value = trim($value, "\"'");

        // Gán biến môi trường và constant
        putenv("$name=$value");
        $_ENV[$name] = $value;
    }
}

// Định nghĩa các hằng số cấu hình DB
define('HOST', $_ENV['DB_HOST'] ?? getenv('DB_HOST'));
define('DB_NAME', $_ENV['DB_NAME'] ?? getenv('DB_NAME'));
define('USERNAME', $_ENV['DB_USER'] ?? getenv('DB_USER'));
define('PASSWORD', $_ENV['DB_PASS'] ?? getenv('DB_PASS'));

// Đường dẫn gốc
define('BASE_PATH', 'http://localhost/SecurityWeb');

// Chế độ debug
define('DEBUG', true);

?>
