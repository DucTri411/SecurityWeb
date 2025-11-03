<?php
require_once 'app/models/CartModel.php';
require_once 'app/models/ProductModel.php';
require_once 'app/utils/validate.php';
class CartController
{
    private $cartModel;
    private $productModel;
    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
    }
    public function getCartQuantityApi()
    {
        header('Content-Type: application/json');
        try {
            $userId = isset($_SESSION['userId']) ? (int) $_SESSION['userId'] : 0;
            if ($userId === 0) {
                echo json_encode([
                    'success' => true,
                    'data' => -1,
                ]);
                return;
            }

            $cartCount = $this->cartModel->getCartQuantity($userId);
            echo json_encode([
                'success' => true,
                'data' => $cartCount,
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function addToCartApi()
    {
        header('Content-Type: application/json');
        try {
            $userId = $_SESSION['userId'];
            if (!validateParamIds($_GET['productId'])) {
                header('Location: notfound');
                exit();
            }
            $productId = $_GET['productId'];
            $quantity = $_GET['quantity'] ?? 1;

            $product = $this->productModel->getProductById($productId);
            if (!$product) {
                throw new Exception('Sản phẩm không tồn tại');
            }
            $existProductInCart = $this->cartModel->getCartByUserAndProduct($userId, $productId);
            if ($existProductInCart) {
                $result = $this->cartModel->increaseCart($existProductInCart['cartId']);
                if (!$result)
                    throw new Exception('Lỗi increase cart');
            } else {
                $this->cartModel->addToCart($userId, $productId, $quantity, $product['price'] * $quantity);
            }
            echo json_encode([
                'success' => true,
                'message' => 'Thêm vào giỏ hàng thành công',
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function userCart()
    {
        $userId = $_SESSION['userId'];
        $carts = $this->cartModel->getUserCarts($userId);
        $totalCart = 0;
        foreach ($carts as $cart) {
            $totalCart += $cart['totalPrice'];
        }

        $page = 'carts';
        $view = 'app/views/user/cart.php';
        require_once 'app/views/layout.php';
    }

    public function increaseCart()
    {
        if (validateParamIds($_GET['cartId'])) {
            $cartId = $_GET['cartId'];
            $cart = $this->cartModel->getCartById($cartId);
            $product = $this->productModel->getProductById($cart['productId']);
            if ($cart['quantity'] + 1 > $product['stock']) {
                setErrorMessage('Không đủ sản phẩm trong kho');
            } else {
                $this->cartModel->increaseCart($cartId);
            }
            header('Location: carts');
        } else {
            header('Location: notfound');
        }
    }

    public function decreaseCart()
    {
        if (validateParamIds($_GET['cartId'])) {
            $cartId = $_GET['cartId'];
            $cart = $this->cartModel->getCartById($cartId);
            if ($cart['quantity'] - 1 === 0) {
                $this->cartModel->removeFromCart($cartId);
            } else {
                $this->cartModel->decreaseCart($cartId);
            }
            header('Location: carts');
        } else {
            header('Location: notfound');
        }
    }

    public function deleteFromCart()
    {
        if (validateParamIds($_GET['cartId'])) {
            $cartId = $_GET['cartId'];
            $this->cartModel->removeFromCart($cartId);
            header('Location: carts');
        } else {
            header('Location: notfound');
        }
    }
}

?>