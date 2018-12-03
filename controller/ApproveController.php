<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApproveController
 *
 * @author master
 */
class ApproveController {

    private $userDao;
    private $driverDao;
    private $sellerDao;

    public function __construct() {
        $this->userDao = new UserDaoImpl();
        $this->driverDao = new DriverDaoImpl();
        $this->sellerDao = new SellerDaoImpl();
    }

    function approve() {
        $users = $this->userDao->showAllUser();
        $drivers = $this->userDao->showAllDriver();
        $sellers = $this->userDao->showAllSeller();
        require_once 'admin_approve.php';
    }

}
