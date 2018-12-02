<?php

/**
 * Description of LoginController
 *
 * @author Velz
 */
class LoginController {

    private $userDao;
    private $roleDao;
    private $sellerDao;
    private $driverDao;

    public function __construct() {
        $this->userDao = new UserDaoImpl();
        $this->roleDao = new RoleDaoImpl();
        $this->sellerDao = new SellerDaoImpl();
        $this->driverDao = new DriverDaoImpl();
    }

    public function login() {
        $btnRegister = filter_input(INPUT_POST, 'btnRegister');
        if (isset($btnRegister)) {
            $username = filter_input(INPUT_POST, 'txtUsername');
            $password = md5(filter_input(INPUT_POST, 'txtPassword'));
            $email = filter_input(INPUT_POST, 'txtEmail');
            $name = filter_input(INPUT_POST, 'txtName');
            $role = filter_input(INPUT_POST, 'role');

            $user = new Users();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setEmail($email);
            $user->setName($name);
            $user->setRoles_id($role);

            if ($role == 2) {
                $seller = new Seller();
                $seller->setName($name);
                $seller_id = $this->sellerDao->addSeller($seller);
                $user->setSeller_id($seller_id);
            } else if ($role == 3) {
                $driver_id = $this->driverDao->addDriver();
                $user->setDriver_id($driver_id);
            }
            if ($register = $this->userDao->addUser($user) == 0) {
                echo "<p style='color:red; text-align:center;'>Username already exist</p>";
            } else {
                $_SESSION['id'] = $register;
                $_SESSION['name'] = $name;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                $_SESSION['banned'] = FALSE;
                $_SESSION['approved_user'] = TRUE;
                header('location:index.php');
            }
        }

        $btnLogin = filter_input(INPUT_POST, 'btnLogin');
        if (isset($btnLogin)) {
            $username = filter_input(INPUT_POST, 'txtUsername');
            $password = md5(filter_input(INPUT_POST, 'txtPassword'));

            $user = new Users();
            $user->setUsername($username);
            $user->setPassword($password);

            $login = $this->userDao->login($user);
            if (isset($login) && !empty($login->name)) {
                $_SESSION['id'] = $login->id;
                $_SESSION['name'] = $login->name;
                $_SESSION['username'] = $login->username;
                $_SESSION['role'] = $login->role_id;
                $_SESSION['banned'] = $login->banned;
                $_SESSION['approved_user'] = TRUE;
                header('location:index.php');
            } else {
                $errMsg = 'Invalid';
            }
        }

        if (isset($errMsg)) {
            echo "<p style='color:red; text-align:center;'>" . $errMsg . "</p>";
        }

        $roles = $this->roleDao->showAllRole();
        require_once 'login.php';
    }

}
