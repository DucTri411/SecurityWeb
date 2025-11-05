<?php
require_once "app/config/config.php";

class DatabaseConnection
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct()
    {
        $this->host = HOST;
        $this->db_name = DB_NAME;
        $this->username = USERNAME;
        $this->password = PASSWORD;
    }

    public function getConnection()
    {
        $this->conn = null;

        // DSN chuẩn + charset
        $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";

        // Options bảo mật
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,   // báo lỗi chuẩn
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,         // fetch mảng associative
            PDO::ATTR_EMULATE_PREPARES   => false,                    // tắt fake prepare => ngăn SQLi tốt hơn
        ];

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            if (defined('DEBUG') && DEBUG === true) {
                echo "Connection error: " . $e->getMessage();
            } else {
                echo "Database connection failed.";
            }
        }

        return $this->conn;
    }
}
?>
