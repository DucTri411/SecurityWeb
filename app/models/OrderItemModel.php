<?php
require_once 'app/config/DatabaseConnection.php';

class OrderItemModel
{
    private $conn;

    public function __construct()
    {
        $db = new DatabaseConnection();
        $this->conn = $db->getConnection();
    }

    public function getOrderItemsByOrderId($orderId)
    {
        $stmt = $this->conn->prepare("
            SELECT oi.*, p.*,
                   (SELECT link 
                    FROM productImages 
                    WHERE productImages.productId = p.productId 
                    LIMIT 1) AS link
            FROM orderItems oi
            INNER JOIN products p ON oi.productId = p.productId
            WHERE oi.orderId = :orderId
        ");

        $stmt->bindValue(':orderId', (int)$orderId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addOrderItem($orderId, $productId, $quantity, $totalPrice)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO orderItems (orderId, productId, quantity, totalPrice) 
            VALUES (:orderId, :productId, :quantity, :totalPrice)
        ");

        $stmt->bindValue(':orderId', (int)$orderId, PDO::PARAM_INT);
        $stmt->bindValue(':productId', (int)$productId, PDO::PARAM_INT);
        $stmt->bindValue(':quantity', (int)$quantity, PDO::PARAM_INT);
        $stmt->bindValue(':totalPrice', $totalPrice, PDO::PARAM_STR);

        $stmt->execute();

        return $this->conn->lastInsertId();
    }
}
