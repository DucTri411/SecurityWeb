<?php
require_once 'app/config/DatabaseConnection.php';

class UserModel
{
    private $conn;

    public function __construct()
    {
        $db = new DatabaseConnection();
        $this->conn = $db->getConnection();
    }

    // ✅ Tăng số lần nhập sai và cập nhật thời gian gần nhất
    public function incrementFailedAttempts($userId)
    {
        $query = "UPDATE users 
                  SET failed_attempts = failed_attempts + 1, last_failed_at = NOW()
                  WHERE userId = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':userId', (int)$userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    // ✅ Reset số lần nhập sai (khi đăng nhập đúng hoặc hết thời gian khóa)
    public function resetFailedAttempts($userId)
    {
        $query = "UPDATE users 
                  SET failed_attempts = 0, last_failed_at = NULL
                  WHERE userId = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':userId', (int)$userId, PDO::PARAM_INT);
        $stmt->execute();z
    }

    // ✅ Kiểm tra xem tài khoản có đang bị khóa không
    public function isLocked($user)
    {
        $maxAttempts = 5;
        $lockMinutes = 15;  

        if (!isset($user['failed_attempts'])) return false;

        if ($user['failed_attempts'] >= $maxAttempts) {
            if (!empty($user['last_failed_at'])) {
                $last = strtotime($user['last_failed_at']);
                if (time() - $last < $lockMinutes * 60) {
                    return true; // vẫn bị khóa
                } else {
                    // hết thời gian khóa → reset lại
                    $this->resetFailedAttempts($user['userId']);
                    return false;
                }
            }
        }
        return false;
    }


    public function getUserByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->bindValue(':email', strtolower(trim($email)), PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE userId = :userId");
        $stmt->bindValue(':userId', (int)$userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserDetailByUserId($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT u.*, COUNT(o.orderId) AS totalOrders,
                   IFNULL(SUM(o.orderTotal + o.shippingCost),0) AS totalSpent
            FROM users u
            LEFT JOIN orders o ON u.userId = o.userId
            WHERE u.userId = :userId
            GROUP BY u.userId
        ");
        $stmt->bindValue(':userId', (int)$userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registerUser($email, $password)
    {
        $email = strtolower(trim($email));
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->conn->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function addUser($email, $password, $userName)
    {
        $email = strtolower(trim($email));
        $userName = htmlspecialchars($userName, ENT_QUOTES, 'UTF-8');
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->conn->prepare("INSERT INTO users (userName, email, password) VALUES (:userName, :email, :password)");
        $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function getAllUsers()
    {
        $stmt = $this->conn->prepare("
            SELECT u.*, COUNT(o.orderId) AS totalOrders,
                   IFNULL(SUM(o.orderTotal + o.shippingCost),0) AS totalSpent
            FROM users u
            LEFT JOIN orders o ON u.userId = o.userId
            WHERE isAdmin = 0
            GROUP BY u.userId
            ORDER BY u.userId DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUserContact($userId, $userName, $phone, $city, $district, $ward, $street)
    {
        $userName = htmlspecialchars($userName, ENT_QUOTES, 'UTF-8');

        $stmt = $this->conn->prepare("
            UPDATE users SET userName = :userName, phone = :phone, city = :city,
                    district = :district, ward = :ward, street = :street
            WHERE userId = :userId
        ");
        $stmt->bindValue(':userId', (int)$userId, PDO::PARAM_INT);
        $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':district', $district, PDO::PARAM_STR);
        $stmt->bindValue(':ward', $ward, PDO::PARAM_STR);
        $stmt->bindValue(':street', $street, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->rowCount();
    }

    public function updatePassword($userId, $password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);

        try {
            $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE userId = :userId");
            $stmt->bindValue(':userId', (int)$userId, PDO::PARAM_INT);
            $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function deleteUser($userId)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE userId = :userId");
        $stmt->bindValue(':userId', (int)$userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
?>
