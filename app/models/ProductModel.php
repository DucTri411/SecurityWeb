<?php
require_once 'app/config/DatabaseConnection.php';
require_once 'app/models/ProductImageModel.php';

class ProductModel
{
    private $conn;
    private $productImageModel;

    public function __construct()
    {
        $db = new DatabaseConnection();
        $this->conn = $db->getConnection();
        $this->productImageModel = new ProductImageModel();
    }


    public function getProductById($productId)
    {
        $stmt = $this->conn->prepare("
            SELECT p.*, c.*
            FROM products p
            INNER JOIN categories c ON c.categoryId = p.categoryId
            WHERE p.productId = :productId
        ");
        $stmt->bindValue(':productId', (int)$productId, PDO::PARAM_INT);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$product) return null;

        $product['images'] = $this->productImageModel->getAllProductImageByProductId($productId);

        return $product;
    }


    public function getProductDetailById($productId)
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("
                SELECT p.*, c.*, p.views + 1 AS updatedViews
                FROM products p
                INNER JOIN categories c ON c.categoryId = p.categoryId
                WHERE p.productId = :productId
                FOR UPDATE
            ");

            $stmt->bindValue(':productId', (int)$productId, PDO::PARAM_INT);
            $stmt->execute();

            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$product) {
                $this->conn->rollBack();
                return null;
            }

            $product['images'] = $this->productImageModel->getAllProductImageByProductId($productId);

            $update = $this->conn->prepare("UPDATE products SET views = views + 1 WHERE productId = :productId");
            $update->bindValue(':productId', (int)$productId, PDO::PARAM_INT);
            $update->execute();

            $this->conn->commit();
            return $product;
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log($e->getMessage());
            return null;
        }
    }


    public function getAllProducts($params = [])
    {
        $defaults = [
            'page' => 1,
            'limit' => 9,
            'order' => 'DESC',
            'order_by' => 'createdAt',
            'search' => '',
            'categoryId' => null,
            'price_start' => null,
            'price_end' => null,
        ];

        $params = array_merge($defaults, $params);

        $page = (int)$params['page'];
        $limit = (int)$params['limit'];
        $order = strtoupper($params['order']) === 'ASC' ? 'ASC' : 'DESC';
        $order_by = preg_replace('/[^a-zA-Z0-9_]/', '', $params['order_by']); 
        $search = htmlspecialchars($params['search'], ENT_QUOTES, 'UTF-8');
        $skip = ($page - 1) * $limit;

        $query = "SELECT p.*, c.* FROM products p INNER JOIN categories c ON p.categoryId = c.categoryId";
        $conditions = [];
        $bindings = [];

        if ($params['categoryId'] !== null) {
            $conditions[] = "p.categoryId = :categoryId";
            $bindings[':categoryId'] = (int)$params['categoryId'];
        }

        if ($search !== '') {
            $conditions[] = "p.productName LIKE :search";
            $bindings[':search'] = "%$search%";
        }

        if ($params['price_start'] !== null) {
            $conditions[] = "p.price >= :price_start";
            $bindings[':price_start'] = $params['price_start'];
        }

        if ($params['price_end'] !== null) {
            $conditions[] = "p.price <= :price_end";
            $bindings[':price_end'] = $params['price_end'];
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $query .= " ORDER BY p.$order_by $order, p.productId DESC LIMIT :limit OFFSET :skip";

        $stmt = $this->conn->prepare($query);

        foreach ($bindings as $k => $v) {
            $stmt->bindValue($k, $v, is_numeric($v) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':skip', $skip, PDO::PARAM_INT);

        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as &$p) {
            $p['images'] = $this->productImageModel->getAllProductImageByProductId($p['productId']);
        }

        return $products;
    }


    public function getLatestProducts($limit = 4)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY createdAt DESC LIMIT :limit");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as &$p) {
            $p['images'] = $this->productImageModel->getAllProductImageByProductId($p['productId']);
        }

        return $products;
    }


    public function getPopularProducts($limit = 4)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY views DESC LIMIT :limit");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as &$p) {
            $p['images'] = $this->productImageModel->getAllProductImageByProductId($p['productId']);
        }

        return $products;
    }


    public function getRelativeProducts($productId, $categoryId, $limit = 6)
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM products 
            WHERE productId <> :productId AND categoryId = :categoryId
            ORDER BY views DESC LIMIT :limit
        ");

        $stmt->bindValue(':productId', (int)$productId, PDO::PARAM_INT);
        $stmt->bindValue(':categoryId', (int)$categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as &$p) {
            $p['images'] = $this->productImageModel->getAllProductImageByProductId($p['productId']);
        }

        return $products;
    }


    public function getBestSellerProducts($limit = 4)
    {
        $stmt = $this->conn->prepare("
            SELECT p.*, SUM(oi.quantity) AS totalSold
            FROM products p
            INNER JOIN orderItems oi ON p.productId = oi.productId
            GROUP BY p.productId
            ORDER BY totalSold DESC
            LIMIT :limit
        ");

        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as &$p) {
            $p['images'] = $this->productImageModel->getAllProductImageByProductId($p['productId']);
        }

        return $products;
    }


    public function addProduct($productName, $productDesc, $price, $categoryId, $stock, $images)
    {
        try {
            $this->conn->beginTransaction();
            
            $productName = htmlspecialchars($productName, ENT_QUOTES, 'UTF-8');
            $productDesc = htmlspecialchars($productDesc, ENT_QUOTES, 'UTF-8');

            $stmt = $this->conn->prepare("
                INSERT INTO products (productName, productDesc, price, categoryId, stock)
                VALUES (:productName, :productDesc, :price, :categoryId, :stock)
            ");

            $stmt->bindValue(':productName', $productName, PDO::PARAM_STR);
            $stmt->bindValue(':productDesc', $productDesc, PDO::PARAM_STR);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':categoryId', (int)$categoryId, PDO::PARAM_INT);
            $stmt->bindValue(':stock', (int)$stock, PDO::PARAM_INT);
            $stmt->execute();

            $productId = $this->conn->lastInsertId();

            if ($productId && !empty($images)) {
                foreach ($images as $image) {
                    $this->productImageModel->addProductImage($productId, $image);
                }
            }

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log($e->getMessage());
            return false;
        }
    }


    public function updateProduct($productId, $productName, $productDesc, $price, $categoryId, $stock, $images)
    {
        try {
            $this->conn->beginTransaction();

            $productName = htmlspecialchars($productName, ENT_QUOTES, 'UTF-8');
            $productDesc = htmlspecialchars($productDesc, ENT_QUOTES, 'UTF-8');

            $stmt = $this->conn->prepare("
                UPDATE products SET productName = :productName, productDesc = :productDesc,
                price = :price, categoryId = :categoryId, stock = :stock
                WHERE productId = :productId
            ");

            $stmt->bindValue(':productId', (int)$productId, PDO::PARAM_INT);
            $stmt->bindValue(':productName', $productName, PDO::PARAM_STR);
            $stmt->bindValue(':productDesc', $productDesc, PDO::PARAM_STR);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':categoryId', (int)$categoryId, PDO::PARAM_INT);
            $stmt->bindValue(':stock', (int)$stock, PDO::PARAM_INT);
            $stmt->execute();

            if ($productId && !empty($images)) {
                foreach ($images as $image) {
                    $this->productImageModel->addProductImage($productId, $image);
                }
            }

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log($e->getMessage());
            return false;
        }
    }


    public function updateProductStock($productId, $quantityReduce)
    {
        $stmt = $this->conn->prepare("
            UPDATE products SET stock = stock - :quantityReduce WHERE productId = :productId
        ");

        $stmt->bindValue(':productId', (int)$productId, PDO::PARAM_INT);
        $stmt->bindValue(':quantityReduce', (int)$quantityReduce, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }


    public function deleteProduct($productId)
    {
        $stmt = $this->conn->prepare("
            DELETE FROM products WHERE productId = :productId
        ");

        $stmt->bindValue(':productId', (int)$productId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }
}

?>
