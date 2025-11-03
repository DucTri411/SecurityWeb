<?php
require_once 'app/models/UserModel.php';
require_once 'app/models/CartModel.php';
require_once 'app/models/OrderModel.php';
require_once 'app/models/ProductModel.php';
require_once 'app/utils/flashMessage.php';
class OrderController
{
    private $userModel;
    private $cartModel;
    private $orderModel;
    private $productModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->orderModel = new OrderModel();
        $this->productModel = new ProductModel();
    }

    public function orderAdmin()
    {
        $orders = $this->orderModel->getAllOrders();
        $page = 'orders';
        $view = 'app/views/admin/orders/orders.php';
        require_once 'app/views/admin/adminLayout.php';
    }

    public function detailOrder()
    {
        if (isset($_GET['orderId'])) {
            $orderId = $_GET['orderId'];
            $order = $this->orderModel->getOrderById(
                $orderId
            );
            $view = 'app/views/admin/orders/detailOrder.php';
            require_once 'app/views/admin/adminLayout.php';
        } else {
            header('Location: notfound');
        }
    }

    public function updateOrderStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['orderId'];
            $status = $_POST['status'];
            $referrer = $_SERVER['HTTP_REFERER'] ?? 'orders';
            $result = $this->orderModel->updateOrderStatus($orderId, $status);

            if ($result) {
                setSuccessMessage('Cập nhật trạng thái thành công');
            } else {
                setErrorMessage('Cập nhật trạng thái thất bại ' . $status);
            }
            header("Location: $referrer");
        } else {
            header('Location: notfound');
        }
    }

    public function checkout()
    {
        $userId = $_SESSION['userId'];
        $user = $this->userModel->getUserById($userId);
        $carts = $this->cartModel->getUserCarts($userId);

        $orderTotal = 0;
        foreach ($carts as $cart) {
            $orderTotal += $cart['totalPrice'];
        }

        $view = 'app/views/user/orders/checkout.php';
        require_once 'app/views/layout.php';
    }

    public function checkoutDelivery()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['userId'];
            $userName = $_POST['userName'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];
            $district = $_POST['district'];
            $ward = $_POST['ward'];
            $street = $_POST['street'];
            $note = $_POST['note'];

            $orderUser = [
                'userName' => $userName,
                'phone' => $phone,
                'city' => $city,
                'district' => $district,
                'ward' => $ward,
                'street' => $street,
                'note' => $note,
            ];

            $_SESSION["orderUser_$userId"] = $orderUser;

            $carts = $this->cartModel->getUserCarts($userId);

            $orderTotal = 0;
            foreach ($carts as $cart) {
                $orderTotal += $cart['totalPrice'];
            }

            $shippingCost = 30000;
            $_SESSION["shippingCost_$userId"] = $shippingCost;

            $view = 'app/views/user/orders/deliveryCheckout.php';
            require_once 'app/views/layout.php';
        } else {
            header('Location: notfound');
        }
    }

    public function checkoutPayment()
    {
        $userId = $_SESSION['userId'];
        $carts = $this->cartModel->getUserCarts($userId);

        $orderTotal = 0;
        foreach ($carts as $cart) {
            $orderTotal += $cart['totalPrice'];
        }

        $shippingCost = $_SESSION["shippingCost_$userId"];


        $view = 'app/views/user/orders/paymentCheckout.php';
        require_once 'app/views/layout.php';
    }

    public function makeOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['userId'];
            $shippingCost = $_SESSION["shippingCost_$userId"];
            $orderUser = $_SESSION["orderUser_$userId"];
            $userName = $orderUser['userName'];
            $phone = $orderUser['phone'];
            $city = $orderUser['city'];
            $district = $orderUser['district'];
            $ward = $orderUser['ward'];
            $street = $orderUser['street'];
            $note = $orderUser['note'];
            $paymentMethod = $_POST['paymentMethod'];

            $status = 'ordered';
            $orderTotal = 0;
            $carts = $this->cartModel->getAllCartsByUserId($userId);
            foreach ($carts as $cart) {
                $orderTotal += $cart['totalPrice'];
            }

            $result = $this->orderModel->createOrder($userId, $userName, $status, $orderTotal, $shippingCost, $city, $district, $ward, $street, $phone, $note, $paymentMethod, $carts);

            foreach ($carts as $cart) {
                $this->productModel->updateProductStock($cart['productId'], $cart['quantity']);
            }
            $this->cartModel->clearCartByUserId($userId);

            if ($result) {
                setSuccessMessage('Đơn hàng đặt thành công');
                header('Location: me');
                exit();
            } else {
                setErrorMessage('Đơn đặt hàng thất bại');
                header('Location: checkout');
                exit();
            }
        } else {
            header('Location: notfound');
        }


    }

    public function orderDetail()
    {
        if (isset($_GET['orderId'])) {
            $orderId = $_GET['orderId'];
            $order = $this->orderModel->getOrderById($orderId);
            $user = $this->userModel->getUserById($_SESSION['userId']);

            $view = 'app/views/user/orders/orderDetail.php';
            require_once 'app/views/layout.php';

        } else {
            header('Location: notfound');
        }
    }

}

?>