<?php
require_once 'app/models/CategoryModel.php';
class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }
    public function categoryAdmin()
    {
        $categories = $this->categoryModel->getAllCategoriesForAdmin();
        $page = 'categories';
        $view = 'app/views/admin/categories/categories.php';
        require_once 'app/views/admin/adminLayout.php';
    }

    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $view = 'app/views/admin/categories/addCategory.php';
            $action = 'add';
            require_once 'app/views/admin/adminLayout.php';
        }
        //POST
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryName = $_POST['categoryName'];

            $result = $this->categoryModel->addCategory($categoryName);
            if ($result) {
                header('Location: categories');
                $_SESSION['success_message'] = 'Thêm sản phẩm thành công';
            } else {
                $_SESSION['error_message'] = 'Thêm sản phẩm thất bại';
                header('Location: add-category');
            }

        }
    }
    public function updateCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['categoryId']) && ctype_digit($_GET['categoryId'])) {
                $category = $this->categoryModel->getCategoryById($_GET['categoryId']);
                $view = 'app/views/admin/categories/addCategory.php';
                $action = 'update';
                require_once 'app/views/admin/adminLayout.php';
            } else {
                header('Location: notfound');
            }
        }
        //POST
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['categoryId'])) {
            $categoryId = $_GET['categoryId'];
            $categoryName = $_POST['categoryName'];

            $result = $this->categoryModel->updateCategory($categoryId, $categoryName);

            if (is_int($result)) {
                $_SESSION['success_message'] = 'Cập nhật sản phẩm thành công';
                header('Location: categories');
            } else {
                $_SESSION['error_message'] = 'Cập nhật không thành công';
            }
        } else {
            header('Location: notfound');
        }
    }

    public function deleteCategory()
    {
        if (isset($_GET["categoryId"])) {
            $categoryId = $_GET["categoryId"];
            $result = $this->categoryModel->deleteCategory($categoryId);

            if ($result > 0) {
                $_SESSION['success_message'] = 'Xóa sản phẩm thành công';
            } else {
                $_SESSION['error_message'] = 'Xóa sản phẩm thất bại';
            }
            header("Location: categories");
        } else {
            header('Location: notfound');
        }
    }
}

?>