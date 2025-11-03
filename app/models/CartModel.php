<?php
require_once 'app/config/DatabaseConnection.php';
require_once 'app/models/ProductImageModel.php';
class CartModel
{
    private $conn;
    public function __construct()
    {
        $db = new DatabaseConnection();
        $this->conn = $db->getConnection();
    }

    public function getCartQuantity($userId)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(productId) AS cartCount FROM carts WHERE userId = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['cartCount'];
    }

    public function getCartByUserAndProduct($userId, $productId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM carts WHERE userId = :userId AND productId = :productId");
        $stmt->bindParam("userId", $userId, PDO::PARAM_INT);
        $stmt->bindParam("productId", $productId, PDO::PARAM_INT);
        $stmt->execute();
        $carts = $stmt->fetch(PDO::FETCH_ASSOC);

        return $carts;
    }

    public function getCartById($cartId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM carts WHERE cartId = :cartId");
        $stmt->bindParam("cartId", $cartId, PDO::PARAM_INT);
        $stmt->execute();
        $carts = $stmt->fetch(PDO::FETCH_ASSOC);

        return $carts;
    }

    public function getUserCarts($userId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM carts 
                                    INNER JOIN products on carts.productId = products.productId
                                    INNER JOIN categories on categories.categoryId = products.categoryId
                                    WHERE userId = :userId ORDER BY cartId DESC ");
        $stmt->bindParam("userId", $userId, PDO::PARAM_INT);
        $stmt->execute();
        $carts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $productImageModel = new ProductImageModel();
        foreach ($carts as $key => $cart) {
            $carts[$key]['images'] = $productImageModel->getAllProductImageByProductId($cart['productId']);
        }

        return $carts;
    }

    public function getAllCartsByUserId($userId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM carts WHERE userId = :userId ORDER BY cartId DESC ");
        $stmt->bindParam("userId", $userId, PDO::PARAM_INT);
        $stmt->execute();
        $carts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $carts;
    }

    public function addToCart($userId, $productId, $quantity, $totalPrice)
    {
        $stmt = $this->conn->prepare("INSERT INTO carts (userId, productId, quantity, totalPrice) VALUES (:userId, :productId, :quantity, :totalPrice)");

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':totalPrice', $totalPrice, PDO::PARAM_STR);

        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function increaseCart($cartId)
    {
        $stmt = $this->conn->prepare("UPDATE carts SET totalPrice = totalPrice / quantity * (quantity + 1), quantity = quantity + 1 WHERE cartId = :cartId");
        $stmt->bindParam(':cartId', $cartId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function decreaseCart($cartId)
    {
        $stmt = $this->conn->prepare("UPDATE carts SET totalPrice = totalPrice / quantity * (quantity - 1), quantity = quantity - 1 WHERE cartId = :cartId");
        $stmt->bindParam(':cartId', $cartId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function removeFromCart($cartId)
    {
        $stmt = $this->conn->prepare("DELETE FROM carts WHERE cartId = :cartId");
        $stmt->bindParam(':cartId', $cartId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function clearCartByUserId($userId)
    {
        $stmt = $this->conn->prepare("DELETE FROM carts WHERE userId = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }
}
?>