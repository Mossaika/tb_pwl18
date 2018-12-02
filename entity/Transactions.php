<?php

/**
 * Description of Transactions
 *
 * @author Velz
 */
class Transactions {

    private $id;
    private $distance_fee;
    private $order_date;
    private $pickup_date;
    private $finish_date;
    private $user_id;

    public function getId() {
        return $this->id;
    }

    public function getDistance_fee() {
        return $this->distance_fee;
    }

    public function getOrder_date() {
        return $this->order_date;
    }

    public function getPickup_date() {
        return $this->pickup_date;
    }

    public function getFinish_date() {
        return $this->finish_date;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDistance_fee($distance_fee) {
        $this->distance_fee = $distance_fee;
    }

    public function setOrder_date($order_date) {
        $this->order_date = $order_date;
    }

    public function setPickup_date($pickup_date) {
        $this->pickup_date = $pickup_date;
    }

    public function setFinish_date($finish_date) {
        $this->finish_date = $finish_date;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

}
