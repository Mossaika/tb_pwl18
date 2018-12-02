<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include_once './util/PDOUtil.php';

        session_start();
        if (!isset($_SESSION['approved_user'])) {
            $_SESSION['approved_user'] = FALSE;
        }

        $navigation = filter_input(INPUT_GET, 'n');
        switch ($navigation) {
            case 'menu':
                $bodyId = 'page2';
                ?>
                <title>Menu</title>
                <meta charset="utf-8">
                <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen"> 
                <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
                <script src="js/cufon-yui.js" type="text/javascript"></script>
                <script src="js/cufon-replace.js" type="text/javascript"></script> 
                <script src="js/Dynalight_400.font.js" type="text/javascript"></script>
                <script src="js/FF-cash.js" type="text/javascript"></script>  
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
                <meta charset="utf-8">
                <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen"> 
                <link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen">
                <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
                <script src="js/cufon-yui.js" type="text/javascript"></script>
                <script src="js/cufon-replace.js" type="text/javascript"></script> 
                <script src="js/Dynalight_400.font.js" type="text/javascript"></script>
                <script src="js/FF-cash.js" type="text/javascript"></script>  
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
                <meta charset="utf-8">
                <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen"> 
                <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
                <script src="js/cufon-yui.js" type="text/javascript"></script>
                <script src="js/cufon-replace.js" type="text/javascript"></script> 
                <script src="js/Dynalight_400.font.js" type="text/javascript"></script>
                <script src="js/FF-cash.js" type="text/javascript"></script>  
                <?php
                break;
            case 'howto':
                $bodyId = 'page5';
                ?>
                <title>How To</title>
                <meta charset="utf-8">
                <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">  
                <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
                <script src="js/cufon-yui.js" type="text/javascript"></script>
                <script src="js/cufon-replace.js" type="text/javascript"></script> 
                <script src="js/Dynalight_400.font.js" type="text/javascript"></script>
                <script src="js/FF-cash.js" type="text/javascript"></script> 
                <?php
                break;
            case 'contact':
                $bodyId = 'page6';
                ?>
                <title>Contact</title>
                <meta charset="utf-8">
                <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen"> 
                <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
                <script src="js/cufon-yui.js" type="text/javascript"></script>
                <script src="js/cufon-replace.js" type="text/javascript"></script> 
                <script src="js/Dynalight_400.font.js" type="text/javascript"></script>
                <script src="js/FF-cash.js" type="text/javascript"></script>  
                <?php
                break;
            default:
                $bodyId = 'page1';
                ?>
                <title>OK-FOOD</title>
                <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
                <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen"> 
                <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
                <script src="js/cufon-yui.js" type="text/javascript"></script>
                <script src="js/cufon-replace.js" type="text/javascript"></script> 
                <script src="js/Dynalight_400.font.js" type="text/javascript"></script>
                <script src="js/FF-cash.js" type="text/javascript"></script>
                <script src="js/tms-0.3.js" type="text/javascript"></script>
                <script src="js/tms_presets.js" type="text/javascript"></script>
                <script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
                <script src="js/jquery.equalheights.js" type="text/javascript"></script>
                <?php
                break;
        }
        ?>
        <meta charset="utf-8">
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
                                <li><a class="active" href="index.php?n=home">Home</a></li>
                                <li><a href="index.php?n=menu">Menu</a></li>
                                <li><a href="index.php?n=catalogue">Catalogue</a></li>
                                <li><a href="index.php?n=delivery">Delivery</a></li>
                                <li><a href="index.php?n=howto">How To</a></li>
                                <li><a href="index.php?n=contact">Contact</a></li>
                                <?php
                                if ($_SESSION['approved_user']) {
                                    ?>
                                    <li><a href="index.php?n=logout">Logout</a></li>
                                    <?php
                                } else {
                                    ?>
                                    <li><a href="index.php?n=login">Login</a></li>
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
                case 'login':
                    include_once 'login.php';
                    break;
                case 'logout':
                    session_unset();
                    session_destroy();
                    header('location:index.php');
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
        <?php
        switch ($navigation) {
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
