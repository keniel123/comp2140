<?php

	include 'config.php';
if (isset($_GET['page'])) {
	$pageid=$_GET['page'];//set $pageid to equal the value in the url
}else{
	$pageid = 1;// set $pageid to equal to 1 or the Home Page
}
	
#function call
$page=data_page($db,$pageid);




function data_page($database,$pageid)
{
	$q =$database->prepare("SELECT * FROM Pages WHERE id = $pageid");
			$q->execute();
			$data = $q->fetch();
			return $data;
			

}




?>


<!DOCTYPE html>

<html>

<body>

	<h1><?php echo $page['header'];?></h1>
	<p><?php echo $page['body'];?></p>
</body>

<html>