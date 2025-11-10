<?php
require_once "app/config/DatabaseConnection.php";

echo "<pre>";
echo "HOST = " . HOST . "\n";
echo "DB_NAME = " . DB_NAME . "\n";
echo "USERNAME = " . USERNAME . "\n";
echo "PASSWORD = " . PASSWORD . "\n";

$db = new DatabaseConnection();
$conn = $db->getConnection();

if ($conn) {
    echo "\n✅ Database connected successfully.";
} else {
    echo "\n❌ Database connection failed.";
}
