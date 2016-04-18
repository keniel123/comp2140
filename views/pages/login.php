	<!-- === BEGIN CONTENT === -->
		<div id="content" class="container">
			<div class="container">
				<div class="row margin-vert-30">
					<!-- Login Box -->
					<div class="col-md-6 col-md-offset-3 col-sm-offset-3">
						<form class="login-page" role="form" method="post" id="loginform" action="?controller=control&action=login"  
                              autocomplete="off">
							<div class="login-header margin-bottom-30">
								<h2>Login to your account</h2>
                                <form id="login-form-wrap" class="login collapse" method="post">
                                    <p>
                                    If you have shopped with us before, please enter your details in the boxes below. 
                                        If you are a new customer you can <a href="?controller=pages&action=signup"> Create an Account </a>
                                    </p>

                                    <p class="form-row form-row-first">
                                        <label for="username">Username <span class="required">*</span>
                                        </label>
                                        <input type="text" id="username" required  placeholder="Username"  name="username" class="input-text">
                                    </p>
                                    <p class="form-row form-row-last">
                                        <label for="password">Password <span class="required">*</span>
                                        </label>
                                        <input type="password" id="password" required name="password" class="input-text" placeholder="Password">
                                    </p>
                                    <div class="clear"></div>


                                    <p class="form-row">
                                        <input type="submit" value="Login" name="submit" class="button">
                                    </p>
                                    <p>
                                        <label class="inline" for="rememberme"><input type="checkbox" value="forever" id="rememberme" 
                                                                                      name="rememberme"> Remember me </label>
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