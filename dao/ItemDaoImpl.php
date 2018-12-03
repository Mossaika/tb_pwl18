<?php

/**
 * Description of ItemDaoImpl
 *
 * @author Velz
 */
class ItemDaoImpl {

    public function addItem(Item $item) {
        $link = PDOUtil::createPDOConnection();
// 3. insert to DB
        try {
            $link->beginTransaction();
            $query = "INSERT INTO item (name, price, seller_id) VALUES(?, ?, ?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $item->getName(), PDO::PARAM_STR);
            $stmt->bindValue(2, $item->getPrice(), PDO::PARAM_INT);
            $stmt->bindValue(3, $item->getSeller_id(), PDO::PARAM_INT);
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

    public function updateItem(Item $item) {
        $link = PDOUtil::createPDOConnection();
        try {
            $link->beginTransaction();
            $query = "UPDATE item SET name=?, price=?, seller_id=? WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $item->getName(), PDO::PARAM_STR);
            $stmt->bindValue(2, $item->getPrice(), PDO::PARAM_INT);
            $stmt->bindValue(3, $item->getSeller_id(), PDO::PARAM_INT);
            $stmt->execute();
            $link->commit();
        } catch (PDOException $ex) {
            $link->rollBack();
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
    }

    public function deleteItem(Item $item) {
        $link = PDOUtil::createPDOConnection();
        try {
            $link->beginTransaction();
            $query = "DELETE FROM item WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $item->getId(), PDO::PARAM_STR);
            $result = $stmt->execute();
            if ($result != FALSE) {
                $link->commit();
            }
        } catch (PDOException $ex) {
            $link->rollBack();
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $result;
    }

    function showAllItem() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM item ORDER BY name ASC";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'item');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    public function getOneItem(Item $item) {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM item WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $item->getId(), PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'item');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

}
