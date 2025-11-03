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

    public function getUserByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserById($userId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE userId = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getUserDetailByUserId($userId)
    {
        $stmt = $this->conn->prepare("SELECT users.*, COUNT(orders.orderId) AS totalOrders, 
                                            IFNULL(SUM(orders.orderTotal + orders.shippingCost), 0) AS totalSpent
                                            FROM users
                                            LEFT JOIN orders ON users.userId = orders.userId
                                            WHERE users.userId = :userId
                                            GROUP BY users.userId
                                            ORDER BY users.userId DESC");
        $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function registerUser($email, $password)
    {
        $stmt = $this->conn->prepare("INSERT INTO users  (email, password) VALUES (:email, :password)");

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(
            ':password',
            $password
            ,
            PDO::PARAM_STR
        );

        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function getAllUsers()
    {
        $stmt = $this->conn->prepare("SELECT users.*, COUNT(orders.orderId) AS totalOrders, 
                                            IFNULL(SUM(orders.orderTotal + orders.shippingCost), 0) AS totalSpent
                                            FROM users
                                            LEFT JOIN orders ON users.userId = orders.userId
                                            WHERE isAdmin = 0
                                            GROUP BY users.userId
                                            ORDER BY users.userId DESC");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function addUser($email, $password, $userName)
    {
        $stmt = $this->conn->prepare("INSERT INTO users (userName, email, password) VALUES (:userName, :email, :password)");

        $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function updateUserContact($userId, $userName, $phone, $city, $district, $ward, $street)
    {
        $stmt = $this->conn->prepare("UPDATE users SET userName = :userName, phone = :phone, city = :city, district = :district, ward = :ward, street = :street WHERE userId = :userId");

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':district', $district, PDO::PARAM_STR);
        $stmt->bindParam(':ward', $ward, PDO::PARAM_STR);
        $stmt->bindParam(':street', $street, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function updateUser($userId, $userName, $phone, $city, $district, $ward, $street, $image)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE users SET userName = :userName, phone = :phone, city = :city, district = :district, ward = :ward, street = :street, image = :image WHERE userId = :userId");

            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':city', $city, PDO::PARAM_STR);
            $stmt->bindParam(':district', $district, PDO::PARAM_STR);
            $stmt->bindParam(':ward', $ward, PDO::PARAM_STR);
            $stmt->bindParam(':street', $street, PDO::PARAM_STR);
            $stmt->bindParam(':image', $image, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo '' . $e->getMessage();
            return null;
        }
    }

    public function updatePassword($userId, $password)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE userId = :userId");

            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            echo '' . $e->getMessage();
            return false;
        }
    }

    public function deleteUser($userId)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE userId = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
?>