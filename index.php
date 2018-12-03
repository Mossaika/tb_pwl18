<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
        <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen"> 
        <script src="js/jquery-3.3.1.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="css/datatables.css">
        <script type="text/javascript" src="js/datatables.js"></script>
        <script src="js/cufon-yui.js" type="text/javascript"></script>
        <script src="js/cufon-replace.js" type="text/javascript"></script> 
        <script src="js/Dynalight_400.font.js" type="text/javascript"></script>
        <script src="js/FF-cash.js" type="text/javascript"></script>
        <?php
        include_once './controller/ApproveController.php';
        include_once './controller/LoginController.php';
        include_once './dao/DeliveryDaoImpl.php';
        include_once './dao/DriverDaoImpl.php';
        include_once './dao/ItemDaoImpl.php';
        include_once './dao/RoleDaoImpl.php';
        include_once './dao/SellerDaoImpl.php';
        include_once './dao/TransactionDaoImpl.php';
        include_once './dao/TransactionDetailDaoImpl.php';
        include_once './dao/UserDaoImpl.php';
        include_once './entity/Deliveries.php';
        include_once './entity/Driver.php';
        include_once './entity/Item.php';
        include_once './entity/Role.php';
        include_once './entity/Seller.php';
        include_once './entity/TransactionDetail.php';
        include_once './entity/Transactions.php';
        include_once './entity/Users.php';
        include_once './util/PDOUtil.php';

        session_start();
        if (!isset($_SESSION['approved_user'])) {
            $_SESSION['approved_user'] = FALSE;
            $_SESSION['role'] = 0;
        }

        $navigation = filter_input(INPUT_GET, 'n');
        switch ($navigation) {
            case 'approve':
                $bodyId = '';
                break;
            case 'manage_user':
                $bodyId = '';
                break;
            case 'login':
                $bodyId = '';
                break;
            case 'logout':
                session_unset();
                session_destroy();
                header('location:index.php');
                break;
            case 'menu':
                $bodyId = 'page2';
                ?>
                <title>Menu</title>
                <script src="js/jquery.equalheights.js" type="text/javascript"></script>    
                <script src="js/jquery.bxSlider.js" type="text/javascript"></script> 
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#slider').bxSlider({
                            pager: true,
                            controls: false,
                            moveSlideQty: 1,
                            displaySlideQty: 3
                        });
                    });
                </script>
                <?php
                break;
            case 'catalogue':
                $bodyId = 'page3';
                ?>
                <title>Catalogue</title>
                <link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen">
                <script src="js/jquery.prettyPhoto.js" type="text/javascript"></script> 
                <script src="js/hover-image.js" type="text/javascript"></script>
                <script src="js/jquery.easing.1.3.js" type="text/javascript"></script>  
                <script src="js/jquery.bxSlider.js" type="text/javascript"></script> 
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#slider-2').bxSlider({
                            pager: true,
                            controls: false,
                            moveSlideQty: 1,
                            displaySlideQty: 4
                        });
                        $("a[data-gal^='prettyPhoto']").prettyPhoto({theme: 'facebook'});
                    });
                </script>
                <?php
                break;
            case 'delivery':
                $bodyId = 'page4';
                ?>
                <title>Delivery</title>
                <?php
                break;
            case 'howto':
                $bodyId = 'page5';
                ?>
                <title>How To</title>
                <?php
                break;
            case 'contact':
                $bodyId = 'page6';
                ?>
                <title>Contact</title>
                <?php
                break;
            default:
                $bodyId = 'page1';
                ?>
                <title>OK-FOOD</title>
                <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen"> 
                <script src="js/tms-0.3.js" type="text/javascript"></script>
                <script src="js/tms_presets.js" type="text/javascript"></script>
                <script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
                <script src="js/jquery.equalheights.js" type="text/javascript"></script>
                <?php
                break;
        }
        ?>
    </head>
    <body id="<?php echo $bodyId; ?>">
        <!--==============================header=================================-->
        <header>
            <div class="row-top">
                <div class="main">
                    <div class="wrapper">
                        <h1><a href="index.php">Catering<span>.com</span></a></h1>
                        <nav>
                            <ul class="menu">
                                <?php
                                if ($_SESSION['role'] == '1') {
                                    ?>
                                    <li><a href="?n=approve">Approve</a></li>
                                    <li><a href="?n=manage_user">Manage User</a></li>
                                    <?php
                                } else {
                                    ?>
                                    <li><a href="?n=home">Home</a></li>
                                    <li><a href="?n=menu">Menu</a></li>
                                    <li><a href="?n=catalogue">Catalogue</a></li>
                                    <li><a href="?n=delivery">Delivery</a></li>
                                    <li><a href="?n=howto">How To</a></li>
                                    <li><a href="?n=contact">Contact</a></li>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($_SESSION['approved_user']) {
                                    ?>
                                    <li><a href="?n=logout">Logout</a></li>
                                    <?php
                                } else {
                                    ?>
                                    <li><a href="?n=login">Login</a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row-bot">
                <div class="row-bot-bg">
                    <div class="main">
                        <h2>Impressive Selection <span>for any Occasion</span></h2>
                        <?php
                        switch ($navigation) {
                            case 'approve':
                                break;
                            case 'manage_user':
                                break;
                            case 'login':
                                break;
                            case 'menu':
                                break;
                            case 'catalogue':
                                break;
                            case 'delivery':
                                break;
                            case 'howto':
                                break;
                            case 'contact':
                                break;
                            default:
                                ?>
                                <div class="slider-wrapper">
                                    <div class="slider">
                                        <ul class="items">
                                            <li>
                                                <img src="images/slider-img1.jpg" alt="" />
                                            </li>
                                            <li>
                                                <img src="images/slider-img2.jpg" alt="" />
                                            </li>
                                            <li>
                                                <img src="images/slider-img3.jpg" alt="" />
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                                break;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </header>

        <!--==============================content================================-->
        <section id="content">
            <?php
            switch ($navigation) {
                case 'approve':
                    $approveController = new ApproveController();
                    $approveController->approve();
                    break;
                case 'manage_user':
                    break;
                case 'login':
                    $loginController = new LoginController();
                    $loginController->login();
                    break;
                case 'menu':
                    include_once 'menu.php';
                    break;
                case 'catalogue':
                    include_once 'catalogue.php';
                    break;
                case 'delivery':
                    include_once 'delivery.php';
                    break;
                case 'howto':
                    include_once 'howto.php';
                    break;
                case 'contact':
                    include_once 'contact.php';
                    break;
                default:
                    include_once 'home.php';
                    break;
            }
            ?>
        </section>

        <!--==============================footer=================================-->
        <footer>
            <div class="main">
                <div class="aligncenter">
                    <span>Catering.com &copy; 2012</span>
                    Website Template by <a class="link" href="http://www.templatemonster.com/" target="_blank" rel="nofollow">TemplateMonster.com</a>
                </div>
            </div>
        </footer>
        <script type="text/javascript"> Cufon.now();</script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.display').DataTable();
            });
        </script>
        <?php
        switch ($navigation) {
            case 'approve':
                break;
            case 'manage_user':
                break;
            case 'login':
                break;
            case 'menu':
                break;
            case 'catalogue':
                break;
            case 'delivery':
                break;
            case 'howto':
                break;
            case 'contact':
                break;
            default:
                ?>
                <script type="text/javascript">
                    $(window).load(function () {
                        $('.slider')._TMS({
                            duration: 1000,
                            easing: 'easeOutQuint',
                            preset: 'slideDown',
                            slideshow: 7000,
                            banners: false,
                            pauseOnHover: true,
                            pagination: true,
                            pagNums: false
                        });
                    });
                </script>
                <?php
                break;
        }
        ?>
    </body>
</html>
