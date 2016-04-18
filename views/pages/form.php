<?php 
$account = $_SESSION['account'];
?>		

<!-- === BEGIN CONTENT === -->
<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Make changes to your account</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
		<div id="content" class="container" style="margin-top: 5%;">
			<div class="row margin-vert-30">
				<!-- Register Box -->
				<div class="col-md-6 col-md-offset-3 col-sm-offset-3">
					<form class="signup-page" role="form" method="post" action="?controller=control&action=change" autocomplete="off">
                        
                            <!--div class="signup-header">
                                <h2>Make changes to your account</h2>
                            </div-->
                            
                        <div class="form-group">
                            <label>First Name<span class="color-red">*</span></label>
                            <input class="form-control margin-bottom-20" type="text" name="firstname" id="firstname"
                               value="<?php echo $account->getFirstName(); ?>">
                        </div>
                        
                        <div class="form-group">
                        <label>Last Name<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="lastname" id="lastname"
                               value="<?php echo $account->getLastName(); ?>">
                        </div>
                        
                        <div class="form-group">
                        <label>Username<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="username" id="username"
                               value="<?php echo $account->getUsername(); ?>">
						</div>
                        
                        <div class="form-group">
						<label>Email Address <span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="email" id="email"
                               value="<?php echo $account->getEmail(); ?>">
                        </div>
                        
                        <div class="form-group">
                        <label>Phone Number<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="number" name="phonenumber" 
                               id="phonenumber" value="<?php echo $account->getPhoneNumber(); ?>">
                        </div>
                        
                        <div class="form-group">
                        <label>Street Address<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="saddress" id="saddress"
                               value="<?php echo $account->getShippingAddress()->getStreetAddress(); ?>">
                        </div>
                        
                        <div class="form-group">
                        <label>City<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="city" id="city"
                               value="<?php echo $account->getShippingAddress()->getCity(); ?>">
                        </div>
                        
                        <div class="form-group">
                        <label>Parish<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="parish" id="parish"
                               value="<?php echo $account->getShippingAddress()->getParish(); ?>">
                        </div>
                        
                        <div class="form-group">
                        <label>Postal Code<span class="color-red">*</span></label>
						<input class="form-control margin-bottom-20" type="text" name="postalcode" 
                               id="postalcode" value="<?php echo $account->getShippingAddress()->getPostalCode(); ?>">
                        </div>
                        
						<div class="row">
							<!--div class="col-sm-6">
								<label>Password <span class="color-red">*</span></label>
								<input class="form-control margin-bottom-20" type="password" name="password" 
                                       id="password" placeholder="Leave empty to keep password">
							</div>
							<div class="col-sm-6">
								<label>Confirm Password <span class="color-red">*</span></label>
								<input class="form-control margin-bottom-20" type="password" name="passwordConfirm" id="passwordConfirm" >
							</div-->
                            <p>Click <a href="?controller=pages&action=reset">here</a> to change your password</p>
						</div>
						<hr>

						<div class="row">
							<div class="col-lg-8">
							</div>
							<div class="col-lg-4 text-right">
								<button class="btn btn-primary" type="submit" name="submit" value="Register">Submit</button>
							</div>
						</div>
					</form>
					
				</div>
				<!-- End Register Box -->
			</div>
		</div>
		<!-- === END CONTENT === -->
