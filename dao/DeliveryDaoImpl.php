<?php

/**
 * Description of DeliveryDaoImpl
 *
 * @author Velz
 */
class DeliveryDaoImpl {

    public function addDelivery(Deliveries $delivery) {
        $msg = 'gagal';
        $link = PDOUtil::createPDOConnection();
// 3. insert to DB
        try {
            $link->beginTransaction();
            $query = "INSERT INTO deliveries (driver_id, transaction_id) VALUES(?, ?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $delivery->getDriver_id(), PDO::PARAM_INT);
            $stmt->bindValue(2, $delivery->getTransaction_id(), PDO::PARAM_INT);
            $stmt->execute();
            $link->commit();
            $msg = 'sukses';
        } catch (PDOException $er) {
            $link->rollBack();
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $msg;
    }

    function showAllDeliveries() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM deliveries";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'deliveries');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    public function getDeliveryByDriverId(Deliveries $delivery) {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM deliveries WHERE driver_id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $delivery->getDriver_id(), PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'deliveries');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

}
