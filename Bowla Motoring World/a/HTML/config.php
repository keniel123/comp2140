<?php
session_start();
$errmsg_arr = array();
$errflag = false;
// configuration
$dbhost 	= "localhost";
$dbname		= "pdo_ret";
$dbuser		= "root";
$dbpass		= "";
define('DIR','localhost/Bowla Motoring World/a/HTML/');


try {

	//create PDO connection
	$db = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
//include('user.php');

//include('classes/phpmailer/mail.php');
//$user = new User($db);
include('customer/customer.php');

//include('classes/phpmailer/mail.php');
$customer = new Customer($db);


include('catalog/catalog.php');

$catalog = new Catalog()

?>
