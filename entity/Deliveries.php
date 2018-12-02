<?php

/**
 * Description of Deliveries
 *
 * @author Velz
 */
class Deliveries {

    private $driver_id;
    private $transaction_id;

    public function getDriver_id() {
        return $this->driver_id;
    }

    public function getTransaction_id() {
        return $this->transaction_id;
    }

    public function setDriver_id($driver_id) {
        $this->driver_id = $driver_id;
    }

    public function setTransaction_id($transaction_id) {
        $this->transaction_id = $transaction_id;
    }

}
