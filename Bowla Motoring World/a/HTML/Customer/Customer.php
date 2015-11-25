<?php

include '/../user.php';
class Customer extends User {
	private $orders;
	
	public function removeOrder($orders)
	{
		return $orders;
	}


	public function makeComplaint($string)
	{
		echo "Your complaint have been made";
	}

	public function process($email,$activate,$id)
	{
		    $to = $email;
			$subject = "Registration Confirmation";
			$body = strip_tags("<p>Thank you for registering </p>" ."\n").
			strip_tags("<p>To activate your account, please click on this link:</p>") . "<a href='".DIR."activate.php?x=$id&y=$activate'></a>".strip_tags("
			<p>Regards Site Admin</p>");

			$head='From: localhost@example.com' . "\r\n" .
    'Reply-To: localhost@example.com' . "\r\n";


			mail($to, $subject,$body,$head);

			
	}

	public function Register ($name,$password,$email,$activate,$database)
	{
		
			//insert into database with a prepared statement
			$stmt = $database->prepare('INSERT INTO members (username,password,email,active,usertype) VALUES (:username, :password, :email, :active,:usertype)');
			$stmt->execute(array(
				':username' => $name,
				':password' => $password,
				':email' => $email,
				':active' => $activate,
				':usertype' => 'R'
			));
			

			
			
			

	}
}
?>
