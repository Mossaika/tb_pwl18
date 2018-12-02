<?php

/**
 * Description of DriverDaoImpl
 *
 * @author Velz
 */
class DriverDaoImpl {

    public function addDriver() {
        $msg = 'gagal';
        $link = PDOUtil::createPDOConnection();
// 3. insert to DB
        try {
            $link->beginTransaction();
            $query = "INSERT INTO driver (approved) VALUES(0)";
            $stmt = $link->prepare($query);
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

    public function updateDriver(Driver $driver) {
        $link = PDOUtil::createPDOConnection();
        try {
            $link->beginTransaction();
            $query = "UPDATE driver SET approved=? WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $driver->getApproved(), PDO::PARAM_BOOL);
            $stmt->bindValue(2, $driver->getId(), PDO::PARAM_INT);
            $stmt->execute();
            $link->commit();
        } catch (PDOException $ex) {
            $link->rollBack();
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
    }

    function showAllDriver() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM driver";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'driver');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return;
    }

    public function getOneDriver(Driver $driver) {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM driver WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $driver->getId(), PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'driver');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

}
