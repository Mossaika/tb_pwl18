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

    function showHistory() {
        $command = filter_input(INPUT_GET, 'c');
        if ($command = 'detail') {
            $id = filter_input(INPUT_GET, 'id');
            $td = new TransactionDetail();
            $td->setTransaction_id($id);
            $details = $this->transactionDetailDao->getDetailOfTransactionId($td);
        }

        $t = new Transactions();
        $t->setUser_id($_SESSION['id']);
        $transactions = $this->transactionDao->showAllTransactionByUser($t);
        require_once 'history_transaction.php';
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
                    $td->setQuantity($_POST['items'][$i]);
                    $td->setTransaction_id($t_id);
                    $this->transactionDetailDao->addTransactionDetail($td);
                }
            }
        }

        $items = $this->itemDao->showAllItem();
        require_once 'menu.php';
    }

}
