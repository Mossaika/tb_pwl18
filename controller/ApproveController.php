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

    function setAsApprovedDriver() {
        $id = filter_input(INPUT_GET, 'id');
        $d = new Driver();
        $d->setId($id);
        $d->setApproved(1);
        $this->driverDao->updateDriver($d);
        header('location:admin_approve.php');
    }

    function setAsApprovedSeller() {
        $id = filter_input(INPUT_GET, 'id');
        $vendor = filter_input(INPUT_GET, 'name');
        $address = filter_input(INPUT_GET, 'addr');
        $s = new Seller();
        $s->setId($id);
        $s->setName($vendor);
        $s->setAddress($address);
        $s->setApproved(1);
        $this->sellerDao->updateSeller($s);
        header('location:admin_approve.php');
    }

    function approve() {
        $command = filter_input(INPUT_GET, 'c');
        $id = filter_input(INPUT_GET, 'id');
        if ($command == 'dupdate') {
            $d = new Driver();
            $d->setId($id);
            $d->setApproved(1);
            $this->driverDao->updateDriver($d);
        } else if ($command == 'supdate') {
            $s = new Seller();
            $s->setId($id);
            $this->sellerDao->approveSeller($s);
        }

        $users = $this->userDao->showAllUser();
        $drivers = $this->userDao->showAllDriver();
        $sellers = $this->userDao->showAllSeller();
        require_once 'admin_approve.php';
    }

}
