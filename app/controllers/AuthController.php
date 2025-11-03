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
        }
        //POST
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $existUser = $userModel->getUserByEmail($email);
            if (!$existUser) {
                setErrorMessage('Tài khoản chưa tồn tại');
                header('location: login');
                exit;
            } else {
                $userPassword = $existUser['password'];
                if (password_verify($password, $userPassword)) {
                    $_SESSION['auth'] = true;
                    $_SESSION['userId'] = $existUser['userId'];
                    setSuccessMessage('Đăng nhập thành công');
                    header('Location: ' . BASE_PATH . '/');
                    exit;
                } else {
                    setErrorMessage('Mật khẩu không đúng');
                    header('location: login');
                    exit;
                }
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['auth']);
        unset($_SESSION['userId']);
        header('Location: login');
    }

    public function signup()
    {
        //GET
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $view = 'app/views/user/signup.php';
            require_once 'app/views/layout.php';
        }
        //POST
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $existUser = $userModel->getUserByEmail($email);
            if ($existUser) {
                setErrorMessage('Tài khoản đã tồn tại');
                header('location: signup');
                exit;
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $result = $userModel->registerUser($email, $hashedPassword);
                setSuccessMessage('Đăng ký thành công');
                header('Location: login');
                exit;
            }
        }
    }

    public function loginAdmin()
    {
        //GET
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $disabledSidebar = true;
            $view = 'app/views/admin/login.php';
            require_once 'app/views/admin/adminLayout.php';
        }
        //POST
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $existUser = $userModel->getUserByEmail($email);
            if (!$existUser || !$existUser['isAdmin']) {
                setErrorMessage('Tài khoản chưa tồn tại');
                header('location: login');
                exit;
            } else {
                $userPassword = $existUser['password'];
                if (password_verify($password, $userPassword)) {
                    $_SESSION['authAdmin'] = true;
                    setSuccessMessage('Đăng nhập thành công');
                    header('Location: ' . BASE_PATH . '/admin');
                    exit;
                } else {
                    setErrorMessage('Mật khẩu không đúng');

                    header('location: login');
                    exit;
                }
            }
        }
    }

    public function logoutAdmin()
    {
        unset($_SESSION['authAdmin']);
        header('Location: login');
    }
}

?>