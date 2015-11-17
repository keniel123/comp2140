<?php



function contactMessageAdd($database)
{
    $cc = $database->prepare('INSERT INTO contactmessage (name,subject,email,message) VALUES (:name, :subject, :email, :message)');
            $cc->execute(array(
                ':name' => $_POST['name'],
                ':subject' => $_POST['subject'],
                ':email' => $_POST['email'],
                ':message' => $_POST['message']));

}


            ?>