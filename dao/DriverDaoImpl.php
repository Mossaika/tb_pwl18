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
            $lastId = $link->lastInsertId();
            $link->commit();
        } catch (PDOException $er) {
            $link->rollBack();
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $lastId;
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
            $query = "SELECT u.id, u.username, u.email, u.name, d.id as did, d.approved FROM users u JOIN driver d ON u.driver_id = d.id";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Driver');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
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
