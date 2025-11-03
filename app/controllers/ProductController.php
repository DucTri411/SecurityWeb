<?php
require_once 'app/models/ProductModel.php';
require_once 'app/models/CategoryModel.php';
require_once 'app/models/ProductImageModel.php';
require_once 'app/utils/constants.php';
require_once 'app/utils/flashMessage.php';
class ProductController
{
    private $productModel;
    private $categoryModel;

    private $productImageModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->productImageModel = new ProductImageModel();
    }
    public function productAdmin()
    {
        $products = $this->productModel->getAllProducts();
        $page = 'products';
        $view = 'app/views/admin/products/products.php';
        require_once 'app/views/admin/adminLayout.php';
    }

    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $categories = $this->categoryModel->getAllCategories();
            $view = 'app/views/admin/products/addProduct.php';
            $action = 'add';
            require_once 'app/views/admin/adminLayout.php';
        }
        //POST
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productName = $_POST['productName'];
            $productDesc = $_POST['productDesc'];
            $price = $_POST['price'];
            $categoryId = $_POST['categoryId'];
            $stock = $_POST['stock'];

            $uploadedImages = [];
            if (!empty($_FILES['images']['name'][0])) {
                $uploadDir = 'uploads/products/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                foreach ($_FILES['images']['name'] as $key => $imageName) {
                    $tmpName = $_FILES['images']['tmp_name'][$key];
                    $uniqueName = uniqid() . '-' . basename($imageName); // Generate a unique name
                    $destination = $uploadDir . $uniqueName;

                    if (move_uploaded_file($tmpName, $destination)) {
                        $uploadedImages[] = $destination;
                    }
                }
            }

            $result = $this->productModel->addProduct($productName, $productDesc, $price, $categoryId, $stock, $uploadedImages);

            if ($result) {
                setSuccessMessage('Thêm sản phẩm thành công');
                header('Location: products');
            } else {
                setErrorMessage('Thêm sản phẩm thất bại');
                header('Location: add-product');
            }

        } else {
            header('Location: notfound');
        }
    }
    public function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['productId']) && ctype_digit($_GET['productId'])) {
            $categories = $this->categoryModel->getAllCategories();
            $product = $this->productModel->getProductById($_GET['productId']);
            $view = 'app/views/admin/products/addProduct.php';
            $action = 'update';
            require_once 'app/views/admin/adminLayout.php';

        }
        //POST
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['productId']) && ctype_digit($_GET['productId'])) {
            $productId = $_GET['productId'];
            $productName = $_POST['productName'];
            $productDesc = $_POST['productDesc'];
            $price = $_POST['price'];
            $categoryId = $_POST['categoryId'];
            $stock = $_POST['stock'];

            //handle deleted images
            $deletedImages = isset($_POST['deletedImages']) ? explode(',', $_POST['deletedImages']) : [];

            //browse each image to delete
            foreach ($deletedImages as $deletedImageId) {
                $image = $this->productImageModel->getProductImageById($deletedImageId);
                $imagePath = $image['link'];
                //delete on storage
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                //delete link on db
                $this->productImageModel->deleteProductImageById($deletedImageId);
            }

            //handle new images updated
            $uploadedImages = [];
            if (!empty($_FILES['images']['name'][0])) {
                $uploadDir = 'uploads/products/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                foreach ($_FILES['images']['name'] as $key => $imageName) {
                    $tmpName = $_FILES['images']['tmp_name'][$key];
                    $uniqueName = uniqid() . '-' . basename($imageName); // Generate a unique name
                    $destination = $uploadDir . $uniqueName;

                    if (move_uploaded_file($tmpName, $destination)) {
                        $uploadedImages[] = $destination;
                    }
                }
            }

            $result = $this->productModel->updateProduct($productId, $productName, $productDesc, $price, $categoryId, $stock, $uploadedImages);

            if ($result) {
                setSuccessMessage('Cập nhật sản phẩm thành công');
                header('Location: products');
            } else {
                setErrorMessage('Cập nhật không thành công');
                header('Location: update-user');
            }
        } else {
            header('Location: notfound');
        }
    }

    public function deleteProduct()
    {
        if (isset($_GET["productId"])) {
            $productId = $_GET["productId"];
            $result = $this->productModel->deleteProduct($productId);

            if ($result > 0) {
                setSuccessMessage('Xóa sản phẩm thành công');
            } else {
                setErrorMessage('Xóa sản phẩm thất bại');
            }
            header("Location: products");
        } else {
            header('Location: notfound');
        }
    }

    public function shop()
    {
        $categories = $this->categoryModel->getAllCategories();
        $page = 'shop';
        $view = 'app/views/user/products/shop.php';
        require_once 'app/views/layout.php';
    }

    public function shopApi()
    {
        header('Content-Type: application/json');
        try {
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 9;
            $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
            $order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'createdAt';
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $categoryId = isset($_GET['categoryId']) && $_GET['categoryId'] ? (int) $_GET['categoryId'] : null;
            $price_start = isset($_GET['price_start']) ? (int) $_GET['price_start'] : null;
            $price_end = isset($_GET['price_end']) && $_GET['price_end'] ? (int) $_GET['price_end'] : null;


            $productModel = new ProductModel();
            $products = $productModel->getAllProducts([
                'page' => $page,
                'limit' => $limit,
                'order' => $order,
                'order_by' => $order_by,
                'search' => $search,
                'categoryId' => $categoryId,
                'price_start' => $price_start,
                'price_end' => $price_end,
            ]);

            echo json_encode([
                'success' => true,
                'data' => $products,
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function detail()
    {
        if (isset($_GET['productId']) && ctype_digit($_GET['productId'])) {
            $productId = $_GET['productId'];
            $referrer = $_SERVER['HTTP_REFERER'] ?? null;

            if ($referrer && strpos($referrer, 'detail') !== false) {
                $product = $this->productModel->getProductById($productId);
            } else {
                $product = $this->productModel->getProductDetailById($productId);
            }

            //get relative products
            $relativeProducts = $this->productModel->getRelativeProducts($productId, $product['categoryId']);

            $view = 'app/views/user/products/detail.php';
            require_once 'app/views/layout.php';
        } else {
            header('location: notfound');
        }
    }
}

?>