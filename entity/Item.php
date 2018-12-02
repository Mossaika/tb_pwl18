<?php

/**
 * Description of Item
 *
 * @author Velz
 */
class Item {

    private $id;
    private $name;
    private $price;
    private $seller_id;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getSeller_id() {
        return $this->seller_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setSeller_id($seller_id) {
        $this->seller_id = $seller_id;
    }

}
