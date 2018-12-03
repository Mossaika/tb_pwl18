<?php

/**
 * Description of TransactionDetailDaoImpl
 *
 * @author Velz
 */
class TransactionDetailDaoImpl {

    public function addTransactionDetail(TransactionDetail $detail) {
        $link = PDOUtil::createPDOConnection();
// 3. insert to DB
        try {
            $link->beginTransaction();
            $query = "INSERT INTO transaction_detail (transaction_id, item_id, quantity) VALUES(?, ?, ?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $detail->getTransaction_id(), PDO::PARAM_INT);
            $stmt->bindValue(2, $detail->getItem_id(), PDO::PARAM_INT);
            $stmt->bindValue(3, $detail->getQuantity(), PDO::PARAM_INT);
            $stmt->execute();
            $link->commit();
        } catch (PDOException $er) {
            $link->rollBack();
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    function showAllTransactionDetail() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM transaction_detail";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'transaction_detail');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    public function getDetailOfTransactionId(TransactionDetail $detail) {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT td.*, i.name FROM transaction_detail td JOIN item i ON td.item_id = i.id WHERE transaction_id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $detail->getTransaction_id(), PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'transaction_detail');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

}
