<?php

/**
 * Description of Driver
 *
 * @author Velz
 */
class Driver {

    private $id;
    private $approved;

    public function getId() {
        return $this->id;
    }

    public function getApproved() {
        return $this->approved;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setApproved($approved) {
        $this->approved = $approved;
    }

}
