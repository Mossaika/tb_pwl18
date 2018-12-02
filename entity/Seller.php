<?php

/**
 * Description of Seller
 *
 * @author Velz
 */
class Seller {

    private $id;
    private $name;
    private $address;
    private $approved;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getApproved() {
        return $this->approved;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setApproved($approved) {
        $this->approved = $approved;
    }

}
