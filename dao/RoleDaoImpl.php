<?php

/**
 * Description of RoleDaoImpl
 *
 * @author Velz
 */
class RoleDaoImpl {

    function showAllRole() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM role";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Role');
            $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

}
