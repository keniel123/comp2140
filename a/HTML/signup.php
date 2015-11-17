<?php 
ob_start();
include 'config.php';
include   'header.php';
include 'functions.php';
?>
<?php
//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location:landingpage.php'); }

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
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		//create the activasion code
		$activasion = md5(uniqid(rand(),true));
		$username = $_POST['username'];

		try {

			//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO members (username,password,email,active,usertype) VALUES (:username, :password, :email, :active,:usertype)');
			$stmt->execute(array(
				':username' => $_POST['username'],
				':password' => $hashedpassword,
				':email' => $_POST['email'],
				':active' => $activasion,
				':usertype' => 'R'
			));
			

			//redirect to index page
			header('Location: index.php?action=joined');
			

			//send email
			$to = $_POST['email'];
			$subject = "Registration Confirmation";
			$body = strip_tags("<p>Thank you for registering </p>" ."\n").
			strip_tags("<p>To activate your account, please click on this link:</p>") . "<a href='".DIR."activate.php?x=$username&y=$activasion'></a>".strip_tags("
			<p>Regards Site Admin</p>");

			$head='From: localhost@example.com' . "\r\n" .
    'Reply-To: localhost@example.com' . "\r\n";


			mail($to, $subject,$body,$head);

			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
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
		<?php include 'footer.php';?>
