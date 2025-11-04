<?php
require_once 'app/models/UserModel.php';
require_once 'app/utils/constants.php';
require_once 'app/utils/flashMessage.php';

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $view = 'app/views/user/login.php';
            require_once 'app/views/layout.php';
            return;
        }

        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $password = $_POST['password'] ?? '';

        $userModel = new UserModel();
        $existUser = $userModel->getUserByEmail($email);

<<<<<<< HEAD
=======
        // 🧱 Kiểm tra tài khoản có tồn tại không
>>>>>>> 0adec7a (first commit)
        if (!$existUser) {
            setErrorMessage('Tài khoản chưa tồn tại.');
            header('location: login');
            exit;
        }

<<<<<<< HEAD
=======
        // 🔐 Kiểm tra tài khoản có bị khóa không
>>>>>>> 0adec7a (first commit)
        if ($userModel->isLocked($existUser)) {
            setErrorMessage('Tài khoản của bạn đang bị khóa tạm thời do đăng nhập sai nhiều lần. Vui lòng thử lại sau 15 phút.');
            header('location: login');
            exit;
        }

<<<<<<< HEAD
=======
        // 🧩 Xác minh mật khẩu
>>>>>>> 0adec7a (first commit)
        if (password_verify($password, $existUser['password'])) {
            // Thành công → reset số lần sai
            $userModel->resetFailedAttempts($existUser['userId']);

            $_SESSION['auth'] = true;
            $_SESSION['userId'] = $existUser['userId'];

            setSuccessMessage('Đăng nhập thành công.');
            header('Location: ' . BASE_PATH . '/');
            exit;
        } else {
            // Sai mật khẩu → tăng biến failed_attempts
            $userModel->incrementFailedAttempts($existUser['userId']);

            setErrorMessage('Mật khẩu không đúng.');
            header('location: login');
            exit;
        }
    }

    public function logout()
    {
        unset($_SESSION['auth'], $_SESSION['userId']);
        header('Location: login');
    }

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $view = 'app/views/user/signup.php';
            require_once 'app/views/layout.php';
            return;
        }

        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $password = $_POST['password'] ?? '';

        $userModel = new UserModel();
        $existUser = $userModel->getUserByEmail($email);

        if ($existUser) {
            setErrorMessage('Tài khoản đã tồn tại.');
            header('location: signup');
            exit;
        }

        $result = $userModel->registerUser($email, $password);
        if ($result) {
            setSuccessMessage('Đăng ký thành công.');
            header('Location: login');
            exit;
        } else {
            setErrorMessage('Đăng ký thất bại.');
            header('Location: signup');
            exit;
        }
    }

    public function loginAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $disabledSidebar = true;
            $view = 'app/views/admin/login.php';
            require_once 'app/views/admin/adminLayout.php';
            return;
        }

        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $password = $_POST['password'] ?? '';

        $userModel = new UserModel();
        $existUser = $userModel->getUserByEmail($email);

<<<<<<< HEAD
=======
        // 🧱 Kiểm tra tài khoản admin có tồn tại
>>>>>>> 0adec7a (first commit)
        if (!$existUser || !$existUser['isAdmin']) {
            setErrorMessage('Tài khoản không tồn tại hoặc không có quyền admin.');
            header('location: login');
            exit;
        }

<<<<<<< HEAD
=======
        // 🔐 Kiểm tra tài khoản có bị khóa không
>>>>>>> 0adec7a (first commit)
        if ($userModel->isLocked($existUser)) {
            setErrorMessage('Tài khoản admin bị khóa tạm thời do đăng nhập sai nhiều lần. Vui lòng thử lại sau 15 phút.');
            header('location: login');
            exit;
        }

<<<<<<< HEAD
=======
        // 🧩 Xác minh mật khẩu
>>>>>>> 0adec7a (first commit)
        if (password_verify($password, $existUser['password'])) {
            $userModel->resetFailedAttempts($existUser['userId']);

            $_SESSION['authAdmin'] = true;
            $_SESSION['userId'] = $existUser['userId'];
            setSuccessMessage('Đăng nhập admin thành công.');
            header('Location: ' . BASE_PATH . '/admin');
            exit;
        } else {
            $userModel->incrementFailedAttempts($existUser['userId']);
            setErrorMessage('Mật khẩu không đúng.');
            header('location: login');
            exit;
        }
    }

    public function logoutAdmin()
    {
        unset($_SESSION['authAdmin']);
        header('Location: login');
    }
}
?>
