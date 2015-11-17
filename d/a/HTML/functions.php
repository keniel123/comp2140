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

function newsletter($database)
{
    $n = $database->prepare('INSERT INTO newsletter (email) VALUES (:email)');
            $n->execute(array(
                ':email' => $_POST['newsEmail']));

}



function billing($database,$username)
{   $id = $database->prepare('SELECT memberID FROM members WHERE username=:username)');
    $id->execute(array('username' => $username));
    $row = $id->fetch();
    $row['id']
    $b = $database->prepare('INSERT INTO billingaddress (id,country,firstName,lastName,address,town,county,postcode,phone) VALUES (:id,:country,:firstName,:lastName,:address,:town,:county,:postcode,:phone) ((SELECT memberID FROM members WHERE username=$username)');
}

            ?>