<?php
$dir = __DIR__;
$patterns = [
    'mysqli_query',
    'mysql_query',
    '->query(',
    'password\s*=',
    'password_hash',
    'password_verify',
    '\$_POST',
    '\$_GET',
    '\$_REQUEST',
    'eval\(',
    'exec\(',
    'system\(',
    'shell_exec\('
];

$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
$phpFiles = [];
foreach ($files as $file) {
    if ($file->isFile() && preg_match('/\.php$/i', $file->getFilename())) {
        $content = file_get_contents($file->getPathname());
        foreach ($patterns as $p) {
            if (preg_match("/$p/i", $content)) {
                $phpFiles[$file->getPathname()] = true;
                break;
            }
        }
    }
}

echo "Found " . count($phpFiles) . " php files that may need review:\n\n";
foreach (array_keys($phpFiles) as $f) {
    echo $f . PHP_EOL;
}
