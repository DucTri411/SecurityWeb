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
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getProductImageById($imageId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM productImages WHERE imageId = :imageId");
        $stmt->bindParam(':imageId', $imageId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function addProductImage($productId, $link)
    {
        $stmt = $this->conn->prepare("INSERT INTO productImages (productId, link) VALUES (:productId, :link)");

        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':link', $link, PDO::PARAM_STR);
        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function deleteProductImageById($imageId)
    {
        $stmt = $this->conn->prepare("DELETE FROM productImages WHERE imageId = :imageId");
        $stmt->bindParam(':imageId', $imageId, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>