<?php 
ob_start();
include 'config.php';
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
                        <li class="active"><a href="/index.php">Home</a></li>
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

<?php
//if logged in redirect to members page
if( $customer->is_logged_in() ){ header('Location:landingpage.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){

	//very basic validation
	if(strlen($_POST['username']) < 3){
		$error[] = 'Username is too short.';
	} else {
		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = 'Username provided is already in use.';
		}

	}

	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}

	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}

	}


	//if no errors have been created carry on
	if(!isset($error)){

		//hash the password
		$hashedpassword = $customer->password_hash($_POST['password'], PASSWORD_BCRYPT);

		//create the activasion code
		$activasion = md5(uniqid(rand(),true));
		try{
			$customer->Register($_POST['username'],$hashedpassword,$_POST['email'],$activasion,$db);
			$id = $db->lastInsertId('memberID');
			header('Location: index.php?action=joined');
			$customer->process($_POST['email'],$activasion,$id);
			exit;
		}
		catch(PDOException $e) {
		    $error[] = $e->getMessage();

		}
		
		

	}

}


 ob_flush(); 

?>
		<!-- === BEGIN CONTENT === -->
		<div id="content" class="container">
			<div class="row margin-vert-30">
				<!-- Register Box -->
				<div class="col-md-6 col-md-offset-3 col-sm-offset-3">
					<form class="signup-page" role="form" method="post" action="" autocomplete="off">
						<div class="signup-header">
							<h2>Register a new account</h2>
							<p>Already a member? Click <a href="login.php">HERE</a> to login to your account.</p>
						</div>
						<?php
							//check for any errors
							if(isset($error)){
								foreach($error as $error){
									echo '<p class="bg-danger">'.$error.'</p>';
								}
							}

							//if action is joined show sucess
							if(isset($_GET['action']) && $_GET['action'] == 'joined'){
								echo "<h2 class='bg-success'>Registration successful, please check your email to activate your account.</h2>";
							}
						?>
						
						<label>Username<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="username" id="username" value="<?php if(isset($error)){ echo $_POST['username']; } ?>">
						
						<label>Email Address <span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="email" id="email" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" >
						<div class="row">
							<div class="col-sm-6">
								<label>Password <span class="color-red">*</span></label>
								<input class="form-control margin-bottom-20" type="password" name="password" id="password">
							</div>
							<div class="col-sm-6">
								<label>Confirm Password <span class="color-red">*</span></label>
								<input class="form-control margin-bottom-20" type="password" name="passwordConfirm" id="passwordConfirm" >
							</div>
						</div>
						<hr>

						<div class="row">
							<div class="col-lg-8">
								<label class="checkbox">
									<input type="checkbox">
									I read the <a href="#">Terms and Conditions</a>
								</label>
							</div>
							<div class="col-lg-4 text-right">
								<button class="btn btn-primary" type="submit" name="submit" value="Register">Register</button>
							</div>
						</div>
					</form>
					
				</div>
				<!-- End Register Box -->
			</div>
		</div>
		<!-- === END CONTENT === -->
		<?php include 'views/footer.php';?>