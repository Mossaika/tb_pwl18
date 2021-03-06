<?php

/**
 * Description of Users
 *
 * @author Velz
 */
class Users {

    private $id;
    private $username;
    private $password;
    private $email;
    private $name;
    private $roles_id;
    private $banned;
    private $driver_id;
    private $seller_id;

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getName() {
        return $this->name;
    }

    public function getRoles_id() {
        return $this->roles_id;
    }

    public function getBanned() {
        return $this->banned;
    }

    public function getDriver_id() {
        return $this->driver_id;
    }

    public function getSeller_id() {
        return $this->seller_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setRoles_id($roles_id) {
        $this->roles_id = $roles_id;
    }

    public function setBanned($banned) {
        $this->banned = $banned;
    }

    public function setDriver_id($driver_id) {
        $this->driver_id = $driver_id;
    }

    public function setSeller_id($seller_id) {
        $this->seller_id = $seller_id;
    }

    public function __set($name, $value) {
        if (!isset($this->roles_id) || !isset($this->driver_id) || !isset($this->seller_id)) {
            $this->roles_id = new Role();
            $this->driver_id = new Driver();
            $this->seller_id = new Seller();
        }
        if (isset($value)) {
            switch ($name) {
                case 'rid':
                    $this->roles_id->setId($value);
                case 'rname':
                    $this->roles_id->setName($value);
                case 'did':
                    $this->driver_id->setId($value);
                case 'dapproved':
                    $this->driver_id->setApproved($value);
                case 'sid':
                    $this->seller_id->setId($value);
                case 'sapproved':
                    $this->seller_id->setApproved($value);
                default:
                    break;
            }
        }
    }

}
