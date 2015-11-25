<?php
	include 'config.php';

	if ($_GET['func'] == 'getImage'){
		$catalog->getImage($_GET['ID'], $db);
	}elseif ($_GET['func'] == 'getName'){ 
		$catalog->getName($_GET['ID'],$db);
	}elseif ($_GET['func'] == 'getPrice'){
		$catalog->getPrice($_GET['ID'],$db);
	}elseif ($_GET['func'] == 'getDesc'){
		$catalog->getDesc($_GET['ID'],$db);
	}
	
   
?>		   
			   