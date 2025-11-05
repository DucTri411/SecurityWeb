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

    /* =============================
        GET USER FUNCTIONS
    ============================= */

    public function getUserByEmail($email)
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM users 
            WHERE email = :email
            LIMIT 1
        ");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM users 
            WHERE userId = :userId
        ");
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserDetailByUserId($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT users.*, 
                COUNT(orders.orderId) AS totalOrders,
                IFNULL(SUM(orders.orderTotal + orders.shippingCost), 0) AS totalSpent
            FROM users
            LEFT JOIN orders ON users.userId = orders.userId
            WHERE users.userId = :userId
            GROUP BY users.userId
        ");
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =============================
        REGISTER / ADD
    ============================= */

    public function registerUser($email, $password)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO users (email, password)
            VALUES (:email, :password)
        ");
        $stmt->execute([
            ':email' => $email,
            ':password' => $password
        ]);

        return $this->conn->lastInsertId();
    }

    public function addUser($email, $password, $userName)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO users (userName, email, password)
            VALUES (:userName, :email, :password)
        ");
        $stmt->execute([
            ':userName' => $userName,
            ':email'    => $email,
            ':password' => $password
        ]);

        return $this->conn->lastInsertId();
    }

    /* =============================
        UPDATE
    ============================= */

    public function updateUserContact($userId, $userName, $phone, $city, $district, $ward, $street)
    {
        $stmt = $this->conn->prepare("
            UPDATE users SET
                userName = :userName,
                phone = :phone,
                city = :city,
                district = :district,
                ward = :ward,
                street = :street
            WHERE userId = :userId
        ");

        $stmt->execute([
            ':userId'   => $userId,
            ':userName' => $userName,
            ':phone'    => $phone,
            ':city'     => $city,
            ':district' => $district,
            ':ward'     => $ward,
            ':street'   => $street
        ]);

        return $stmt->rowCount();
    }

    public function updateUser($userId, $userName, $phone, $city, $district, $ward, $street, $image)
    {
        $stmt = $this->conn->prepare("
            UPDATE users SET
                userName = :userName,
                phone = :phone,
                city = :city,
                district = :district,
                ward = :ward,
                street = :street,
                image = :image
            WHERE userId = :userId
        ");

        $stmt->execute([
            ':userId'   => $userId,
            ':userName' => $userName,
            ':phone'    => $phone,
            ':city'     => $city,
            ':district' => $district,
            ':ward'     => $ward,
            ':street'   => $street,
            ':image'    => $image
        ]);

        return $stmt->rowCount();
    }

    public function updatePassword($userId, $password)
    {
        $stmt = $this->conn->prepare("
            UPDATE users SET password = :password 
            WHERE userId = :userId
        ");
        $stmt->execute([
            ':userId'   => $userId,
            ':password' => $password
        ]);

        return $stmt->rowCount() > 0;
    }

    /* =============================
        DELETE USER
    ============================= */

    public function deleteUser($userId)
    {
        $stmt = $this->conn->prepare("
            DELETE FROM users 
            WHERE userId = :userId
        ");
        $stmt->execute([':userId' => $userId]);

        return $stmt->rowCount();
    }

    /* =============================
        LOCKOUT FEATURES
    ============================= */

    public function increaseFailedAttempts($userId)
    {
        $stmt = $this->conn->prepare("
            UPDATE users SET
                failed_attempts = failed_attempts + 1,
                last_failed_at = NOW(),
                locked_until = CASE 
                    WHEN failed_attempts + 1 >= 5
                        THEN DATE_ADD(NOW(), INTERVAL 5 MINUTE)
                    ELSE locked_until
                END
            WHERE userId = :userId
        ");
        return $stmt->execute([':userId' => $userId]);
    }

    public function resetFailedAttempts($userId)
    {
        $stmt = $this->conn->prepare("
            UPDATE users SET
                failed_attempts = 0,
                locked_until = NULL
            WHERE userId = :userId
        ");
        return $stmt->execute([':userId' => $userId]);
    }

    /* =============================
        ADMIN GET ALL USERS
    ============================= */

    public function getAllUsers()
    {
        $stmt = $this->conn->prepare("
            SELECT users.*, 
                COUNT(orders.orderId) AS totalOrders,
                IFNULL(SUM(orders.orderTotal + orders.shippingCost), 0) AS totalSpent
            FROM users
            LEFT JOIN orders ON users.userId = orders.userId
            WHERE isAdmin = 0
            GROUP BY users.userId
            ORDER BY users.userId DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
