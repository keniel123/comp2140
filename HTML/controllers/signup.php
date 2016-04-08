<?php
//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location:landingpage.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){

	//very basic validation
	if(strlen($_POST['username']) < 3){
		$error[] = 'Username is too short.';
	} else {
		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = 'Username provided is already in use.';
		}

	}

	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}

	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}

	}


	//if no errors have been created carry on
	if(!isset($error)){

		//hash the password
		$hashedpassword = $customer->password_hash($_POST['password'], PASSWORD_BCRYPT);

		//create the activasion code
		$activasion = md5(uniqid(rand(),true));
		try{
			$customer->Register($_POST['username'],$hashedpassword,$_POST['email'],$activasion,$db);
			$id = $db->lastInsertId('memberID');
			header('Location: index.php?action=joined');
			$customer->process($_POST['email'],$activasion,$id);
			exit;
		}
		catch(PDOException $e) {
		    $error[] = $e->getMessage();

		}
		
		

	}

}

if (isset($_SESSION['total'])) {
    $total=$_SESSION['total'] ;
}
if (isset($_SESSION['number'])) {
    $number=$_SESSION['number'] ;
}
$total=50;
$number=20;
?>