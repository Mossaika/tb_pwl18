<?php

/**
 * Description of SellerDaoImpl
 *
 * @author Velz
 */
class SellerDaoImpl {

    public function addSeller(Seller $seller) {
        $msg = 'gagal';
        $link = PDOUtil::createPDOConnection();
// 3. insert to DB
        try {
            $link->beginTransaction();
            $query = "INSERT INTO seller (name, address, approved) VALUES(?, ?, 0)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $seller->getName(), PDO::PARAM_STR);
            $stmt->bindValue(2, $seller->getAddress(), PDO::PARAM_STR);
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

    public function updateSeller(Seller $seller) {
        $link = PDOUtil::createPDOConnection();
        try {
            $link->beginTransaction();
            $query = "UPDATE seller SET name=?, address=?, approved=? WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $seller->getName(), PDO::PARAM_STR);
            $stmt->bindValue(2, $seller->getAddress(), PDO::PARAM_STR);
            $stmt->bindValue(3, $seller->getApproved(), PDO::PARAM_BOOL);
            $stmt->execute();
            $link->commit();
        } catch (PDOException $ex) {
            $link->rollBack();
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
    }

    function showAllSeller() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM seller";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'seller');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    public function getOneSeller(Seller $seller) {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM seller WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $seller->getId(), PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'seller');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

}
