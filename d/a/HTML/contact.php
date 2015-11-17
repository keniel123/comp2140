
<?php

	include 'header.php';
		

		if ($_SERVER['REQUEST_METHOD']== 'POST') {
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				$error[] = 'Please enter a valid email address';
					
			}
			if ($_POST['message']==""){
				$error[] = 'Please enter a message';
			}
			if ($_POST['name']=="") {
				$error[] = 'Please enter a name';
			}
			if ($_POST['subject']==""){
				$error[]= 'Please enter a subject';
			}
		if (!isset($error)) {
				mail('keniel_peart123@hotmail.com',htmlspecialchars($_POST['name'])."  ".htmlspecialchars($_POST['subject']),htmlspecialchars($_POST['message']));
			 	$status= "Thank You for your message";
			 	contactMessageAdd($db); 	
		}
		}
		?>
		
		
		<div id="content" class="container">
			<!-- === BEGIN CONTENT === -->	<div class="row margin-vert-30">
			<!-- Main Column -->
			<div class="col-md-9">
				<!-- Main Content -->
				<div class="headline"><h2>Contact Form</h2></div>
				<p>Contact us about anything related to the company or services<p>We'll do our best to get back to you as soon as possible</p></p><br>
				<!-- Contact Form -->
				<form action="" method="post">
					<?php
							//check for any errors
							if(isset($error)){
								foreach($error as $error){
									echo '<p class="bg-danger">'.$error.'</p>';
								}
							}
		?>
					<label>Name</label>
					<div class="row margin-bottom-20">
						<div class="col-md-6 col-md-offset-0">
							<input class="form-control" type="text" name="name" id="name">
						</div>
					</div>

					<label>Subject</label>
					<div class="row margin-bottom-20">
						<div class="col-md-6 col-md-offset-0">
							<input class="form-control" type="text" name="subject" id="subject">
						</div>
					</div>
					
					<label>Email <span class="color-red">*</span></label>
					<div class="row margin-bottom-20">
						<div class="col-md-6 col-md-offset-0">
							<input class="form-control" type="text" name="email" id="email" value="<?php if(isset($error)){ echo $_POST['email']; } ?>">
						</div>
					</div>
					
					<label>Message</label>
					<div class="row margin-bottom-20">
						<div class="col-md-8 col-md-offset-0">
							<textarea rows="8" class="form-control" name="message" id="message" placeholder="Enter text ..."></textarea>
							<script type="text/javascript">
								//document.getElementByTagName('textarea').visibility="hidden";
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.

                //CKEDITOR.replace( 'message' );
            </script>
						</div>
					</div>
					
					<p><button type="submit" class="btn btn-primary" value="Send Message">Send Message</button></p>
				</form>
				<?php if(isset($status)) echo $status;?>
				<!-- End Contact Form -->
				<!-- End Main Content -->
			</div>
			<!-- End Main Column -->
			
		</div>
	</div>
	<!-- === END CONTENT === -->
	<?php require('footer.php');?>