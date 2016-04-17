	<!-- === BEGIN CONTENT === -->
		<div id="content" class="container">
			<div class="container">
				<div class="row margin-vert-30">
					<!-- Login Box -->
					<div class="col-md-6 col-md-offset-3 col-sm-offset-3">
						<form class="login-page" role="form" method="post" id="loginform" action="?controller=control&action=login"  autocomplete="off">
							<div class="login-header margin-bottom-30">
								<h2>Login to your account</h2>
												<!--?php
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

								
								?-->
                                <form id="login-form-wrap" class="login collapse" method="post">
                                    <p>
                                    If you have shopped with us before, please enter your details in the boxes below. 
                                        If you are a new customer you can <a href="?controller=pages&action=signup"> Create an Account </a>
                                    </p>

                                    <p class="form-row form-row-first">
                                        <label for="username">Username <span class="required">*</span>
                                        </label>
                                        <input type="text" id="username"  placeholder="Username"  name="username" class="input-text">
                                    </p>
                                    <p class="form-row form-row-last">
                                        <label for="password">Password <span class="required">*</span>
                                        </label>
                                        <input type="password" id="password" name="password" class="input-text" placeholder="Password">
                                    </p>
                                    <div class="clear"></div>


                                    <p class="form-row">
                                        <input type="submit" value="Login" name="submit" class="button">
                                    </p>
                                    <p>
                                        <label class="inline" for="rememberme"><input type="checkbox" value="forever" id="rememberme" name="rememberme"> Remember me </label>
                                    </p>
                                    <p class="lost_password">
                                        <a href="?controller=pages&action=reset">Lost your password?</a>
                                    </p>

                                    <div class="clear"></div>
                                </form>
                            </div>
                        </form>
						<p><a href="?controller=pages&action=signup"> Create an Account </a></p>
					</div>
					<!-- End Login Box -->
				</div>
			</div>
		</div>
		<!-- === END CONTENT === -->