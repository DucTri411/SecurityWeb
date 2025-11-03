<?php
require_once 'app/config/DatabaseConnection.php';
require_once 'app/models/OrderItemModel.php';
class OrderModel
{
    private $conn;
    private $orderItemModel;
    public function __construct()
    {
        $db = new DatabaseConnection();
        $this->conn = $db->getConnection();

        $this->orderItemModel = new OrderItemModel();
    }
    public function getOrderById($orderId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE orderId = :orderId ORDER BY createdAt DESC");
        $stmt->bindParam(":orderId", $orderId, PDO::PARAM_INT);
        $stmt->execute();

        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        $order['items'] = $this->orderItemModel->getOrderItemsByOrderId($order['orderId']);

        return $order;
    }
    public function getAllOrdersByUserId($userId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE userId = :userId ORDER BY updatedAt DESC, orderId DESC");
        $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
        $stmt->execute();

        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($orders as $key => $order) {
            $orders[$key]['items'] = $this->orderItemModel->getOrderItemsByOrderId($order['orderId']);
        }

        return $orders;
    }
    public function getAllOrders()
    {
        $stmt = $this->conn->prepare("SELECT * FROM orders ORDER BY updatedAt DESC, orderId DESC");
        $stmt->execute();

        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($orders as $key => $order) {
            $orders[$key]['items'] = $this->orderItemModel->getOrderItemsByOrderId($order['orderId']);
        }

        return $orders;
    }
    public function createOrder($userId, $userName, $status, $orderTotal, $shippingCost, $city, $district, $ward, $street, $phone, $note, $paymentMethod, $products)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare('INSERT INTO orders (userId, userName, status, orderTotal, shippingCost, city, district, ward, street, phone, note, paymentMethod) VALUES (:userId, :userName, :status, :orderTotal, :shippingCost, :city, :district, :ward, :street, :phone, :note, :paymentMethod)');
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':orderTotal', $orderTotal, PDO::PARAM_STR);
            $stmt->bindParam(':shippingCost', $shippingCost, PDO::PARAM_STR);
            $stmt->bindParam(':city', $city, PDO::PARAM_STR);
            $stmt->bindParam(':district', $district, PDO::PARAM_STR);
            $stmt->bindParam(':ward', $ward, PDO::PARAM_STR);
            $stmt->bindParam(':street', $street, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':note', $note, PDO::PARAM_STR);
            $stmt->bindParam(':paymentMethod', $paymentMethod, PDO::PARAM_STR);
            $stmt->execute();
            $orderId = $this->conn->lastInsertId();

            foreach ($products as $product) {
                $this->orderItemModel->addOrderItem($orderId, $product['productId'], $product['quantity'], $product['totalPrice']);
            }
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function updateOrderStatus($orderId, $status)
    {
        $stmt = $this->conn->prepare("UPDATE orders SET status = :status WHERE orderId = :orderId");

        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount();
    }

}


?>