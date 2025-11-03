<?php
require_once "app/config/config.php";
require_once "app/utils/constants.php";
require_once "app/utils/format.php";

require_once "app/controllers/AuthController.php";
require_once "app/controllers/GeneralController.php";
require_once "app/controllers/UserController.php";
require_once "app/controllers/ProductController.php";
require_once "app/controllers/CategoryController.php";
require_once "app/controllers/OrderController.php";
require_once "app/controllers/CartController.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace(BASE_PATH, '', $uri);

session_start();

function isAuthenticationAdmin() //check if user is login or not
{
    return $_SESSION['authAdmin'] === true;
}

function isAuthentication()
{
    return $_SESSION['auth'] === true;
}

if (in_array($uri, PROTECTED_ROUTES)) { //if uri in protectedRoutes => check login
    //route admin and not authentication for admin
    if (strpos($uri, '/admin') === 0 && !isAuthenticationAdmin()) {
        header("Location: " . BASE_PATH . "/admin/login");
        exit();
    } else if (strpos($uri, '/admin') !== 0 && !isAuthentication()) {
        header("Location: " . BASE_PATH . "/login");
        exit();
    }
} elseif (in_array($uri, API_PROTECTED_ROUTES)) {
    if (strpos($uri, '/admin') === 0 && !isAuthenticationAdmin()) {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'require login',
        ]);
        exit();
    } else if (!isAuthentication()) {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'require login',
        ]);
        exit();
    }
}

switch ($uri) {
    //admin page
    case '/admin':
        (new GeneralController())->dashboard();
        break;

    //admin login
    case '/admin/login':
        (new AuthController())->loginAdmin();
        break;
    case '/admin/logout':
        (new AuthController())->logoutAdmin();
        break;
    case '/admin/update-password':
        echo $uri;
        break;


    //admin manage product
    case '/admin/products':
        (new ProductController())->productAdmin();
        break;
    case '/admin/add-product':
        (new ProductController())->addProduct();
        break;
    case '/admin/update-product':
        (new ProductController())->updateProduct();
        break;
    case '/admin/delete-product':
        (new ProductController())->deleteProduct();
        break;

    //admin manage categories
    case '/admin/categories':
        (new CategoryController())->categoryAdmin();
        break;
    case '/admin/add-category':
        (new CategoryController())->addCategory();
        break;
    case '/admin/update-category':
        (new CategoryController())->updateCategory();
        break;
    case '/admin/delete-category':
        (new CategoryController())->deleteCategory();
        break;

    //admin manage orders
    case '/admin/orders':
        (new OrderController())->orderAdmin();
        break;
    case '/admin/detail-order':
        (new OrderController())->detailOrder();
        break;
    case '/admin/update-order-status':
        (new OrderController())->updateOrderStatus();
        break;

    //admin manage users
    case '/admin/users':
        (new UserController())->userAdmin();
        break;
    case '/admin/detail-user':
        (new UserController())->detailUser();
        break;
    case '/admin/add-user':
        (new UserController())->addUser();
        break;
    case '/admin/update-user':
        (new UserController())->updateUser();
        break;
    case '/admin/delete-user':
        (new UserController())->deleteUser();
        break;

    //user page
    case '/signup':
        (new AuthController())->signup();
        break;
    case '/login':
        (new AuthController())->login();
        break;
    case '/logout':
        (new AuthController())->logout();
        break;


    case '/shop':
        (new ProductController())->shop();
        break;
    case '/api/shop':
        (new ProductController())->shopApi();
        break;
    case '/detail':
        (new ProductController())->detail();
        break;

    case '/me':
        (new UserController())->profile();
        break;
    case '/update-profile':
        (new UserController())->updateProfile();
        break;
    case '/update-password':
        (new UserController())->updatePassword();
        break;
    case '/update-image':
        (new UserController())->profile();
        break;
    case '/api/users/update-contact':
        (new UserController())->updateContactApi();
        break;

    case '/order-detail':
        (new OrderController())->orderDetail();
        break;
    case '/checkout':
        (new OrderController())->checkout();
        break;
    case '/checkout-delivery':
        (new OrderController())->checkoutDelivery();
        break;
    case '/checkout-payment':
        (new OrderController())->checkoutPayment();
        break;
    case '/make-order':
        (new OrderController())->makeOrder();
        break;

    case '/carts':
        (new CartController())->userCart();
        break;
    case '/increase-cart':
        (new CartController())->increaseCart();
        break;
    case '/decrease-cart':
        (new CartController())->decreaseCart();
        break;
    case '/delete-cart':
        (new CartController())->deleteFromCart();
        break;
    case '/api/carts/count':
        (new CartController())->getCartQuantityApi();
        break;
    case '/api/carts/add':
        (new CartController())->addToCartApi();
        break;


    case '/about':
        (new GeneralController())->about();
        break;
    case '/blogs':
        (new GeneralController())->blogs();
        break;
    case '/blog-detail':
        (new GeneralController())->blogDetail();
        break;
    case '/contact':
        (new GeneralController())->contact();
        break;
    case '/policy':
        (new GeneralController())->policy();
        break;
    case '/':
        (new GeneralController())->home();
        break;

    default:
        echo '404 Page not found';
}
?>