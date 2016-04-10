<!--?php 
ob_start();
include 'config.php';
include '/functions.php';
$title="Bowla's Motoring World"?-->

<!--?php
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

?-->
		<!-- === BEGIN CONTENT === -->
		<div id="content" class="container">
			<div class="row margin-vert-30">
				<!-- Register Box -->
				<div class="col-md-6 col-md-offset-3 col-sm-offset-3">
					<form class="signup-page" role="form" method="post" action="?controller=control&action=signup" autocomplete="off">
						<div class="signup-header">
							<h2>Register a new account</h2>
							<p>Already a member? Click <a href="?controller=pages&action=login">HERE</a> to login to your account.</p>
						</div>
						
                        <div class="form-group">
                        <label>First Name<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="firstname" id="firstname">
                        </div>
                        
                        <div class="form-group">
                        <label>Last Name<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="lastname" id="lastname">
                        </div>
                        
                        <div class="form-group">
                        <label>Username<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="username" id="username">
						</div>
                        
                        <div class="form-group">
						<label>Email Address <span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="email" id="email">
                        </div>
                        
                        <div class="form-group">
                        <label>Phone Number<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="number" name="phonenumber" 
                               id="phonenumber" placeholder="E.g. 8761234567">
                        </div>
                        
                        <div class="form-group">
                        <label>Street Address<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="saddress" id="saddress">
                        </div>
                        
                        <div class="form-group">
                        <label>City<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="city" id="city">
                        </div>
                        
                        <div class="form-group">
                        <label>Parish<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="parish" id="parish">
                        </div>
                        
                        <div class="form-group">
                        <label>Postal Code<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="postalcode" 
                               id="postalcode" placeholder="E.g. JMBPD15">
                        </div>
                        
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
