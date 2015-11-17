<?php include"config.php";
include 'functions.php';?>


<!-- === BEGIN HEADER === -->
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	
	
	<!-- Meta -->
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	<!-- Favicon -->
	<link href="favicon.html" rel="shortcut icon">
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.css" rel="stylesheet">
	<!-- Template CSS -->
	<link rel="stylesheet" href="assets/css/animate.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/nexus.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/custom.css" rel="stylesheet">
	<!--Jquery Css-->
	<link rel="stylesheet" href="assets/css/jquery-ui.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/owl.carousel.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/jquery-ui.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/jquery-ui.structure.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/jquery-ui.structure.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/jquery-ui.theme.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/jquery-ui.theme.min.css" rel="stylesheet">
	<!-- Google Fonts-->
	<link href="http://fonts.googleapis.com/css?family=Lato:400,300" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet" type="text/css">
	<!--Bootstrap-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  	<script src="assets/ckeditor/ckeditor.js"></script>
  	
</head>
<body>
	<div id="pre_header" class="visible-lg"></div>
	<div id="header" class="container">
		<div class="row">
			<!-- Logo -->
			<div class="logo">
				<a href="index.php">
					<img src="assets/img/g.png" alt="Logo"style="background:transparent;" />
				<img src="assets/img/h.png"style="background:transparent;" /></a>
			</div>
			<!-- End Logo -->
			<!-- Top Menu -->
			<div class="col-md-12 margin-top-30">
				<div id="hornav" class="pull-right visible-lg">
					<ul class="nav navbar-nav">
						
						<?php if($user->is_logged_in()){
							include"authenticated.php";}
							else{include"notlogged.php";}?>		
						
						
							<li><span><a href="#"><i class="fa fa-shopping-cart"></i></a></span></li>
						
					</ul>				</div>
				</div>
				<div class="clear"></div>
				<!-- End Top Menu -->
			</div>
		</div>
		<!-- === END HEADER === -->
		<!-- === BEGIN CONTENT === -->