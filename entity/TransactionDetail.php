<?php

/**
 * Description of TransactionDetail
 *
 * @author Velz
 */
class TransactionDetail {

    private $transaction_id;
    private $item_id;
    private $quantity;

    public function getTransaction_id() {
        return $this->transaction_id;
    }

    public function getItem_id() {
        return $this->item_id;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setTransaction_id($transaction_id) {
        $this->transaction_id = $transaction_id;
    }

    public function setItem_id($item_id) {
        $this->item_id = $item_id;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function __set($name, $value) {
        if (!isset($this->item_id)) {
            $this->item_id = new Item();
        }
        if (isset($value)) {
            switch ($name) {
                case 'name':
                    $this->item_id->setName($value);
                default:
                    break;
            }
        }
    }

}
