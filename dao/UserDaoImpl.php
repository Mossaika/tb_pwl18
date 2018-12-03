<?php

/**
 * Description of UserDaoImpl
 *
 * @author Velz
 */
class UserDaoImpl {

    public function addUser(Users $user) {
        $link = PDOUtil::createPDOConnection();
// 3. insert to DB
        try {
            $link->beginTransaction();
            $query = "INSERT INTO users (username, password, email, name, roles_id, banned, driver_id, seller_id) VALUES(?,?,?,?,?,0,?,?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $user->getUsername(), PDO::PARAM_STR);
            $stmt->bindValue(2, $user->getPassword(), PDO::PARAM_STR);
            $stmt->bindValue(3, $user->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(4, $user->getName(), PDO::PARAM_STR);
            $stmt->bindValue(5, $user->getRoles_id(), PDO::PARAM_INT);
            $stmt->bindValue(6, $user->getDriver_id(), PDO::PARAM_INT);
            $stmt->bindValue(7, $user->getSeller_id(), PDO::PARAM_INT);
            try {
                $stmt->execute();
                // do other things if successfully inserted
            } catch (PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    return 0;
                }
            }
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

    function updateUser(Users $user) {
        $link = PDOUtil::createPDOConnection();
        try {
            $link->beginTransaction();
            $query = "UPDATE users SET password=?, email=?, name=?, roles_id=?, banned=?, driver_id=?, seller_id=? WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $user->getPassword(), PDO::PARAM_STR);
            $stmt->bindValue(2, $user->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(3, $user->getName(), PDO::PARAM_STR);
            $stmt->bindValue(4, $user->getRoles_id(), PDO::PARAM_INT);
            $stmt->bindValue(5, $user->getBanned(), PDO::PARAM_BOOL);
            $stmt->bindValue(6, $user->getDriver_id(), PDO::PARAM_INT);
            $stmt->bindValue(7, $user->getSeller_id(), PDO::PARAM_INT);
            $stmt->bindValue(8, $user->getId(), PDO::PARAM_INT);
            $stmt->execute();
            $link->commit();
        } catch (PDOException $ex) {
            $link->rollBack();
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
    }

    function showAllUser() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT u.*, r.id as rid, r.name as rname FROM users u JOIN role r ON u.roles_id = r.id";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Users');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    function showAllDriver() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT u.id, u.username, u.email, u.name, d.id as did, d.approved as dapproved FROM users u JOIN driver d ON u.driver_id = d.id";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Users');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    function showAllSeller() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT u.id, u.username, u.email, u.name, s.id as sid, s.approved as sapproved FROM users u JOIN seller s ON u.seller_id = s.id";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Users');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    public function getOneUser(Users $user) {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM users WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $user->getId(), PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            $result = $stmt->fetch();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $result;
    }

    public function login(Users $user) {
        $link = PDOUtil::createPDOConnection();
// 3. insert to DB
        $query = "SELECT u.*, r.id as rid, r.name as rname FROM users u JOIN role r ON u.roles_id = r.id WHERE username=? AND password=?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(2, $user->getPassword(), PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $result = $stmt->fetch();
        PDOUtil::closePDOConnection($link);
        return $result;
    }

}
