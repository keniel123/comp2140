<?php include('views/header.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 





//define page title
$title = 'Bowla Motoring World';
 
?>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			
				<h2>Welcome <?php echo $_SESSION['username']; ?></h2>
		</div>
	</div>


</div>

<?php 
//include footer template
require('footer.php'); 
?>
