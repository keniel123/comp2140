<?php
//include config
include('header.php');

//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: landingpage.php'); } 

//process login form if submitted
if(isset($_POST['submit'])){

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($user->login($username,$password)){ 
		$_SESSION['username'] = $username;
		if ($_SESSION['username']=="Admin") {
			header('Location:admin/index.html');
			# code...
		}
		else{
		header('Location: index.php');
		exit;}
	
	} else {
		$error[] = 'Wrong username or password or your account has not been activated.';
	}

}//end if submit 
?>
		<!-- === BEGIN CONTENT === -->
		<div id="content" class="container">
			<div class="container">
				<div class="row margin-vert-30">
					<!-- Login Box -->
					<div class="col-md-6 col-md-offset-3 col-sm-offset-3">
						<form class="login-page" role="form" method="post" action=""  autocomplete="off">
							<div class="login-header margin-bottom-30">
								<h2>Login to your account</h2>
												<?php
								//check for any errors
								if(isset($error)){
									foreach($error as $error){
										echo '<p class="bg-danger">'.$error.'</p>';
									}
								}

								if(isset($_GET['action'])){

									//check the action
									switch ($_GET['action']) {
										case 'active':
											echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
											break;
										case 'reset':
											echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
											break;
										case 'resetAccount':
											echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
											break;
									}

								}

								
								?>
							</div>
							<div class="input-group margin-bottom-20">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input placeholder="Username" class="form-control" type="text" name="username" id="username" >
							</div>
							<div class="input-group margin-bottom-20">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input placeholder="Password" class="form-control" type="password" name="password" id="password">
							</div>
							<div class="row">
								<div class="col-md-6">
									<label class="checkbox"><input type="checkbox"> Stay signed in</label>
								</div>
								<div class="col-md-6">
									<button class="btn btn-primary pull-right" type="submit" name="submit" value="Login">Login</button>
								</div>
							</div>
							<hr>
							<h4>Forget your Password ?</h4>
							<p><a href="reset.php" name="forget">Click here</a> to reset your password.</p>
							
						</form>
						<p><a href="signup.php"> Create an Account </a></p>
					</div>
					<!-- End Login Box -->
				</div>
			</div>
		</div>
		<!-- === END CONTENT === -->
		<?php include 'footer.php';?>