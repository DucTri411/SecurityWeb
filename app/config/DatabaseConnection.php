<?php
require_once "app/config/config.php"; // Đường dẫn file chứa các hằng số DB

class DatabaseConnection
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct()
    {
        // Nếu bạn dùng .env thì có thể đọc từ đó thay vì hằng số
        $this->host = HOST;
        $this->db_name = DB_NAME;
        $this->username = USERNAME;
        $this->password = PASSWORD;
    }

    public function getConnection()
    {
        if ($this->conn) {
            return $this->conn;
        }

        try {
            // Thêm charset utf8mb4 để tránh lỗi Unicode
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Hiển thị lỗi dưới dạng Exception
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Mặc định trả về mảng kết hợp
                PDO::ATTR_EMULATE_PREPARES   => false,                 // Tăng bảo mật (chuẩn bị thật)
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            // Không echo lỗi ra màn hình (vì có thể lộ thông tin)
            error_log("Database connection error: " . $e->getMessage(), 0);
            die("Không thể kết nối cơ sở dữ liệu, vui lòng thử lại sau.");
        }

        return $this->conn;
    }
}

// --- Cấu hình session an toàn cho toàn hệ thống ---
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_samesite', 'Strict');
    session_start();
}
?>
