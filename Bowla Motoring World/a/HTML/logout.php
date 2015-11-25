<?php require('views/header.php');

//logout
$customer->logout(); 

//logged in return to index page
header('Location: index.php');
exit;
?>