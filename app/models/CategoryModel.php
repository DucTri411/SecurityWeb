<?php
require_once 'app/config/DatabaseConnection.php';
class CategoryModel
{
    private $conn;
    public function __construct()
    {
        $db = new DatabaseConnection();
        $this->conn = $db->getConnection();
    }

    public function getCategoryById($categoryId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE categoryId = :categoryId");
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getAllCategories()
    {
        $stmt = $this->conn->prepare("SELECT * FROM categories ORDER BY categoryId DESC");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getAllCategoriesForAdmin()
    {
        $stmt = $this->conn->prepare("SELECT c.*, COUNT(p.productId) AS productCount 
                                FROM categories c
                                LEFT JOIN products p ON c.categoryId = p.categoryId
                                GROUP BY c.categoryId
                                ORDER BY c.categoryId DESC");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function addCategory($categoryName)
    {
        $stmt = $this->conn->prepare("INSERT INTO categories (categoryName) VALUES (:categoryName)");

        $stmt->bindParam(':categoryName', $categoryName, PDO::PARAM_STR);
        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function updateCategory($categoryId, $categoryName)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE categories SET categoryName = :categoryName WHERE categoryId = :categoryId");

            $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(':categoryName', $categoryName, PDO::PARAM_STR);
            $stmt->execute();

            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo '' . $e->getMessage();
            return null;
        }
    }

    public function deleteCategory($categoryId)
    {
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE categoryId = :categoryId");
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}

?>