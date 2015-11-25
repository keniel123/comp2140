<?php include"/config.php";
include '/functions.php';
$title="Bowla's Motoring World"?>


<!-- === BEGIN HEADER === -->
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    
    
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
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    
</head>
<body>

    
            <!-- End Logo -->
            <!-- Top Menu -->
         <div class="header-area">
            <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul class="nav navbar-nav">
                         <ul>
                            <li><a href="account.php"><i class="fa fa-user"></i> My Account</a></li>
                        <?php if($customer->is_logged_in()){
                            include"/authenticated.php";}
                            else{include"/notlogged.php";}?>     
                        
                        
                            
                         </ul>
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
                        <h1><a href="index.php"><span>Bowla's Motoring</span> world</a></h1>
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
                        <a href="cart.php">Cart - <span class="cart-amunt"><?php if(isset($total)){echo '$'. $total;}?></span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?php if(isset($number)){echo $number;}?></span></a>
                    </div>
                </div>
                   </div>
        </div>
    </div> <!-- End site branding area -->



<div class="row">
   <div class="container">
        <div>
                    <ul class="nav navbar-nav" >
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="shop3.php">Shop page</a></li>
                        <li><a href="cart.php">Cart</a></li>
                        <li><a href="checkout.php">Checkout</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>  
        </div>
   
        

        <!-- === END HEADER === -->
        <!-- === BEGIN CONTENT === -->