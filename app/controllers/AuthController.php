<?php
require_once 'app/models/UserModel.php';
require_once 'app/utils/constants.php';
require_once 'app/utils/flashMessage.php';

class AuthController
{
    /* ==============================
        USER LOGIN
    ============================== */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $view = 'app/views/user/login.php';
            require_once 'app/views/layout.php';
            return;
        }

        // POST
        $email = $_POST['email'];
        $password = $_POST['password'];

        $userModel = new UserModel();
        $existUser = $userModel->getUserByEmail($email);

        if (!$existUser) {
            setErrorMessage('Tài khoản chưa tồn tại');
            header('location: login');
            exit;
        }

        /* ✅ CHECK LOCKOUT */
        if ($existUser['locked_until'] && strtotime($existUser['locked_until']) > time()) {
            setErrorMessage('Tài khoản đang bị khóa tạm thời. Vui lòng thử lại sau.');
            header('location: login');
            exit;
        }

        /* ✅ CHECK PASSWORD */
        if (password_verify($password, $existUser['password'])) {

            // ✅ Reset failed attempts
            $userModel->resetFailedAttempts($existUser['userId']);

            // ✅ CREATE SESSION
            session_regenerate_id(true);
            $_SESSION['auth'] = true;
            $_SESSION['userId'] = $existUser['userId'];

            setSuccessMessage('Đăng nhập thành công');
            header('Location: ' . BASE_PATH . '/');
            exit;

        } else {

            // ✅ WRONG PASSWORD → INCREASE FAILED ATTEMPTS
            $userModel->increaseFailedAttempts($existUser['userId']);

            setErrorMessage('Mật khẩu không đúng');
            header('location: login');
            exit;
        }
    }

    /* ==============================
        USER LOGOUT
    ============================== */
    public function logout()
    {
        // ✅ Destroy only relevant session keys
        unset($_SESSION['auth']);
        unset($_SESSION['userId']);

        // ✅ Clear session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // ✅ Destroy session
        session_destroy();

        header("Location: login");
        exit;
    }

    /* ==============================
        USER SIGNUP
    ============================== */
    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $view = 'app/views/user/signup.php';
            require_once 'app/views/layout.php';
            return;
        }

        // POST
        $email = $_POST['email'];
        $password = $_POST['password'];

        $userModel = new UserModel();
        $existUser = $userModel->getUserByEmail($email);

        if ($existUser) {
            setErrorMessage('Email đã tồn tại');
            header('Location: signup');
            exit;
        }

        // ✅ HASH PASSWORD
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userModel->registerUser($email, $hashedPassword);

        setSuccessMessage('Đăng ký thành công');
        header('Location: login');
        exit;
    }

    /* ==============================
        ADMIN LOGIN
    ============================== */
    public function loginAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $disabledSidebar = true;
            $view = 'app/views/admin/login.php';
            require_once 'app/views/admin/adminLayout.php';
            return;
        }

        // POST
        $email = $_POST['email'];
        $password = $_POST['password'];

        $userModel = new UserModel();
        $existUser = $userModel->getUserByEmail($email);

        if (!$existUser || !$existUser['isAdmin']) {
            setErrorMessage('Tài khoản không hợp lệ');
            header('location: login');
            exit;
        }

        // ✅ CHECK LOCKOUT
        if ($existUser['locked_until'] && strtotime($existUser['locked_until']) > time()) {
            setErrorMessage('Tài khoản admin đang bị khóa.');
            header('location: login');
            exit;
        }

        if (password_verify($password, $existUser['password'])) {

            // ✅ Reset fail count
            $userModel->resetFailedAttempts($existUser['userId']);

            session_regenerate_id(true);
            $_SESSION['authAdmin'] = true;

            setSuccessMessage('Đăng nhập thành công');
            header('Location: ' . BASE_PATH . '/admin');
            exit;

        } else {

            $userModel->increaseFailedAttempts($existUser['userId']);

            setErrorMessage('Sai mật khẩu');
            header('location: login');
            exit;
        }
    }

    /* ==============================
        ADMIN LOGOUT
    ============================== */
    public function logoutAdmin()
    {
        unset($_SESSION['authAdmin']);

        session_destroy();

        header("Location: login");
        exit;
    }
}
?>
