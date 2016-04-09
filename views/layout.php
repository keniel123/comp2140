<!-- === BEGIN HEADER === -->
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>Bowla's Motoring World</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
      <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="source-files/css/owl.carousel.css">
    <link rel="stylesheet" href="source-files/css/style1.css">
    <link rel="stylesheet" href="source-files/css/responsive.css">
    
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
                                 if(isset($_SESSION['username']))
                                 {
                                     echo "<li><a href='?controller=pages&action=account'>
                                     <i class='fa fa-user'></i>" . $_SESSION['username'] . "</a></li>";
                                     echo "<li><a href='?controller=control&action=logout'>
                                     Logout</a></li>";
                                 } else {
                                     echo '<li class="nav"><a href=\'?controller=pages&action=login\'>
                                     <i class=\'fa fa-user\'></i>Login</a></li>';
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
                        <?php if (isset($_SESSION['username'])){echo '<a href="?controller=pages&action=cart">';}
                                else {echo '<a href="?controller=pages&action=login">';}?>Cart - <span class="cart-amunt"><?php if(isset($total)){echo '$'. $total;}?></span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?php if(isset($number)){echo $number;}?></span></a>
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
                        <li><?php if (isset($_SESSION['username'])){echo '<a href="?controller=pages&action=cart">';}
                                else {echo '<a href="?controller=pages&action=login">';}?>Cart</a></li>
                        <li><?php if (isset($_SESSION['username'])){echo '<a href="?controller=pages&action=checkout">';}
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
                            <li><?php if (isset($_SESSION['username'])){echo '<a href="?controller=pages&action=account">';}
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
                        <p><a href="terms.php">Terms and Conditions</a></p>
                        <a href="privacy.php">Privacy Policy</a>
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
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
               
    <!-- jQuery easing -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="js/main.js"></script>
  </body>
</html>