<!-- === BEGIN HEADER === -->
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> 
<html lang="en"> <!--<![endif]-->
<head>
    <title>Bowla's Motoring World</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
                                        
                                        <!-- Google Fonts -->
    <!--== Titillium Web ==-->
    <link href='source-files/css/titillium_web.css' rel='stylesheet' type='text/css'>
    
    <!--== Roboto Condensed ==-->
    <link href='source-files/css/roboto_condensed.css' rel='stylesheet' type='text/css'>
    
    <!--== Raleway ==-->
    <link href='source-files/css/raleway.css' rel='stylesheet' type='text/css'>
    
    
    <!-- Bootstrap -->
    <link href="source-files/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="source-files/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="source-files/css/owl.carousel.css" rel="stylesheet">
    <link href="source-files/css/style.css" rel="stylesheet">
    <link href="source-files/css/style1.css" rel="stylesheet">
    <link href="source-files/css/responsive.css" rel="stylesheet">
    
</head>
<body>

    
            <!-- End Logo -->
            <!-- Top Menu -->
         <div class="header-area">
            <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                         <ul class="nav navbar-nav pull-left">
                             <?php 
                                 if(isset($_SESSION['account']))
                                 {
                                     $account = $_SESSION['account'];
                                     $username = $account->getUsername();
                                     echo "<li><a href='?controller=pages&action=account'>
                                     <span class=\"glyphicon glyphicon-user\"></span> Hi $username</a></li>";
                                     echo "<li><a href='?controller=control&action=logout'>
                                     Logout</a></li>";
                                 } else {
                                     echo '<li class="nav"><a href=\'?controller=pages&action=login\'>
                                     <span class="glyphicon glyphicon-user"></span> Login</a></li>';
                                 }
                             ?>
                        </ul>
                    </div>
               </div>
                

                <!-- End Top Menu -->
            </div>
        </div>
    </div>



 <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="?controller=pages&action=index"><span>Bowla's Motoring</span> world</a></h1>
                    </div>
                </div>
                   <div class="col-sm-6">
                    <div class="shopping-item">
                        <?php
                        if (isset($_SESSION['total'])) {
                            $total=$_SESSION['total'] ;
                        }
                        if (isset($_SESSION['number'])) {
                            $number=$_SESSION['number'] ;
                        }

                        ?>
                        <?php if (isset($_SESSION['account'])){echo '<a href="?controller=pages&action=cart">';}
                                else {echo '<a href="?controller=pages&action=login">';}?>Cart - <span class="cart-amunt">
                        <?php if(isset($_SESSION['account'])){echo '$'. $account->getCart()->getTotal();}?></span> 
                        <span class="glyphicon glyphicon-shopping-cart"></span> 
                        <span class="product-count"><?php if(isset($_SESSION['account'])){echo count($account->fetchItems());}?></span></a>
                    </div>
                </div>
                   </div>
        </div>
    </div> <!-- End site branding area -->



<div class="row">
   <div class="container">
        <div>
                    <ul class="nav navbar-nav" >
                        <li class="active"><a href="?controller=pages&action=index">Home</a></li>
                        <li><a href="?controller=pages&action=shop">Shop page</a></li>
                        <li><?php if (isset($_SESSION['account'])){echo '<a href="?controller=pages&action=cart">';}
                                else {echo '<a href="?controller=pages&action=login">';}?>Cart</a></li>
                        <li><?php if (isset($_SESSION['account'])){echo '<a href="?controller=pages&action=checkout">';}
                                else {echo '<a href="?controller=pages&action=login">';}?>Checkout</a></li>
                        <li><a href="?controller=pages&action=contact">Contact</a></li>
                    </ul>
                </div>
            </div>  
        </div>
   
        

        <!-- === END HEADER === -->
    
    <!-- === CONTENT === -->
<br/><br/>

    
    <?php require_once('routes.php'); ?>

    <br/><br/>
    <!-- === END CONTENT === -->
    
    <!-- === BEGIN FOOTER === -->
    
    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2><span>Bowla's Motoring</span> world</h2>
                        <p>44-46 Studio One Blvd,<br />
                        Kingston 5,<br />
                        Jamaica,<br />
                        876-906-7848<br/>
                        Email: <a href="mailto:bowlasmotoringworld@yahoo.com">bowlasmotoringworld@yahoo.com</a><br />
                        Website: <a href="index.php">www.bowlamotoringworld.com</a></p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">User Navigation </h2>
                        <ul>
                            <li><?php if (isset($_SESSION['account'])){echo '<a href="?controller=pages&action=account">';}
                                else {echo '<a href="?controller=pages&action=login">';}?>My account</a></li>
                            <li><a href="#">Order history</a></li>
                            <li><a href="?controller=pages&action=contact">Contact</a></li>
                            <li><a href="?controller=pages&action=index">Front page</a></li>
                            <li><a href="?controller=pages&action=about">About Us</a></li>

                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categories</h2>
                        <ul>
                            <li><a href="#">Tires</a></li>
                            <li><a href="#">Transmission</a></li>
                            <li><a href="#">Engines</a></li>
                            <li><a href="#">Brakes</a></li>
                            <li><a href="#">Accessories</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Newsletter</h2>
                             
                        <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                        <div class="newsletter-form">
                            <form action="" method="post">
                                <input type="email" placeholder="Type your email" name="newsEmail" id="newsEmail" >
                                <input type="submit" value="Subscribe" name="Subscribe">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer top area -->
    
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; 2015 Bowla's Motoring world. All Rights Reserved.</p>
                        <p><a href="?controller=pages&action=terms">Terms and Conditions</a></p>
                        <a href="?controller=pages&action=privacy">Privacy Policy</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>

                    </div>    
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->
   
    <!-- Latest jQuery form server -->
    <script src="source-files/js/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="source-files/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="source-files/js/owl.carousel.min.js"></script>
    <script src="source-files/js/jquery.sticky.js"></script>
               
    <!-- jQuery easing -->
    <script src="source-files/js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="source-files/js/main.js"></script>

    <!-- Custom Script -->
    <script src="source-files/js/addpayment.js"></script>
    <script src="source-files/js/login.js"></script>
  </body>
</html>