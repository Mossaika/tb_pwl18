<?php

/**
 * Description of MenuController
 *
 * @author Velz
 */
class MenuController {

    private $itemDao;
    private $transactionDetailDao;
    private $transactionDao;

    public function __construct() {
        $this->itemDao = new ItemDaoImpl();
        $this->transactionDetailDao = new TransactionDetailDaoImpl();
        $this->transactionDao = new TransactionDaoImpl();
    }

    function showMenu() {
        $btnCheckout = filter_input(INPUT_POST, 'btnCheckout');
        if (isset($btnCheckout)) {
            $t = new Transactions();
            $t->setUser_id($_SESSION['id']);
            $t_id = $this->transactionDao->addTransaction($t);
            for ($i = 0; $i < count($_POST['id']); $i++) {
                if ($_POST['items'][$i] != 0) {
                    $td = new TransactionDetail();
                    $td->setItem_id($_POST['id'][$i]);
                    echo $td->getItem_id();
                    exit();
                }
                echo '<br>';
            }
        }

        $items = $this->itemDao->showAllItem();
        require_once 'menu.php';
    }

}
