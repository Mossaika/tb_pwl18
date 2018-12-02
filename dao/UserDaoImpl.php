<?php

/**
 * Description of UserDaoImpl
 *
 * @author Velz
 */
class UserDaoImpl {

    public function addUser(Users $user) {
        $msg = 'gagal';
        $link = PDOUtil::createPDOConnection();
// 3. insert to DB
        try {
            $link->beginTransaction();
            $query = "INSERT INTO users (username, password, email, name, roles_id, banned, driver_id, seller_id) VALUES(?,?,?,?,?,?,?,?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $user->getUsername(), PDO::PARAM_STR);
            $stmt->bindValue(2, $user->getPassword(), PDO::PARAM_STR);
            $stmt->bindValue(3, $user->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(4, $user->getName(), PDO::PARAM_STR);
            $stmt->bindValue(5, $user->getRoles_id(), PDO::PARAM_INT);
            $stmt->bindValue(6, $user->getBanned(), PDO::PARAM_BOOL);
            $stmt->bindValue(7, $user->getDriver_id(), PDO::PARAM_INT);
            $stmt->bindValue(8, $user->getSeller_id(), PDO::PARAM_INT);
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
            $query = "SELECT * FROM users";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Users');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return;
    }

    public function getOneUser(Users $user) {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM users WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $user->id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Users');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    public function login(Users $user) {
        $link = PDOUtil::createPDOConnection();
// 3. insert to DB
        $query = "SELECT * FROM users WHERE username=? AND password=?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(2, $user->getPassword(), PDO::PARAM_STR);
        $stmt->execute();
        $arrResult = $stmt->fetch();
        $data = array('id' => $arrResult['id'], 'name' => $arrResult['name'], 'username' => $arrResult['username'], 'role' => $arrResult['roles_id'], 'banned' => $arrResult['banned']);
        if (!empty($data) && $data['username'] != NULL) {
            $_SESSION['id'] = $data['id'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];
            $_SESSION['banned'] = $data['banned'];
            $_SESSION['approved_user'] = TRUE;
        } else {
            $_SESSION['name'] = 'Invalid username/password';
        }
        PDOUtil::closePDOConnection($link);
    }

}
