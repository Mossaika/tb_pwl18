<?php

/**
 * Description of TransactionDaoImpl
 *
 * @author Velz
 */
class TransactionDaoImpl {

    public function addTransaction(Transactions $transaction) {
        $msg = 'gagal';
        $link = PDOUtil::createPDOConnection();
// 3. insert to DB
        try {
            $link->beginTransaction();
            $query = "INSERT INTO transactions (distance_fee, order_date, user_id) VALUES(?, ?, ?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $transaction->getDistance_fee(), PDO::PARAM_INT);
            $stmt->bindValue(2, $transaction->getOrder_date(), PDO::PARAM_STR);
            $stmt->bindValue(5, $transaction->getUser_id(), PDO::PARAM_INT);
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

    public function updateTransaction(Transactions $transaction) {
        $link = PDOUtil::createPDOConnection();
        try {
            $link->beginTransaction();
            $query = "UPDATE transactions SET pickup_date=?, finish_date WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $transaction->getPickup_date(), PDO::PARAM_STR);
            $stmt->bindValue(2, $transaction->getFinish_date(), PDO::PARAM_STR);
            $stmt->bindValue(3, $transaction->getId(), PDO::PARAM_INT);
            $stmt->execute();
            $link->commit();
        } catch (PDOException $ex) {
            $link->rollBack();
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
    }

    function showAllTransaction() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM transactions";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'transactions');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    public function getOneTransaction(Transactions $transaction) {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM transactions WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $transaction->getId(), PDO::PARAM_INT);
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
