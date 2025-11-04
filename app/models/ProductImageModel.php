<?php
require_once 'app/config/DatabaseConnection.php';

class ProductImageModel
{
    private $conn;

    public function __construct()
    {
        $db = new DatabaseConnection();
        $this->conn = $db->getConnection();
    }

    public function getAllProductImageByProductId($productId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM productImages WHERE productId = :productId");
        $stmt->bindValue(':productId', (int)$productId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductImageById($imageId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM productImages WHERE imageId = :imageId");
        $stmt->bindValue(':imageId', (int)$imageId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProductImage($productId, $link)
    {
        // sanitize link - stored XSS protection
        $safeLink = htmlspecialchars($link, ENT_QUOTES, 'UTF-8');

        $stmt = $this->conn->prepare("INSERT INTO productImages (productId, link) VALUES (:productId, :link)");
        $stmt->bindValue(':productId', (int)$productId, PDO::PARAM_INT);
        $stmt->bindValue(':link', $safeLink, PDO::PARAM_STR);
        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function deleteProductImageById($imageId)
    {
        $stmt = $this->conn->prepare("DELETE FROM productImages WHERE imageId = :imageId");
        $stmt->bindValue(':imageId', (int)$imageId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }
}
