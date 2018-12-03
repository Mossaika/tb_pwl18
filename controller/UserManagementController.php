<?php

/**
 * Description of BanUserController
 *
 * @author Velz
 */
class UserManagementController {

    private $userDao;

    public function __construct() {
        $this->userDao = new UserDaoImpl();
    }

    function manage() {
        $command = filter_input(INPUT_GET, 'c');
        if ($command != NULL) {
            $id = filter_input(INPUT_GET, 'id');
            $u = new Users();
            $u->setId($id);
            $user = $this->userDao->getOneUser($u);
            if (isset($user) && !empty($user->name)) {
                $u->setUsername($user->username);
                $u->setPassword($user->password);
                $u->setEmail($user->email);
                $u->setName($user->name);
                $u->setRoles_id($user->roles_id);
                $u->setDriver_id($user->driver_id);
                $u->setSeller_id($user->seller_id);
                if ($command == 'ban') {
                    $u->setBanned(1);
                } else if ($command == 'unban') {
                    $u->setBanned(0);
                }
                echo $this->userDao->updateUser($u);
            } else {
                echo $user;
                exit();
            }
        }

        $users = $this->userDao->showAllUser();
        require_once 'admin_manage.php';
    }

}
