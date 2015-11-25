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
{   $id = $database->prepare('SELECT memberID FROM members WHERE username= :username AND active="Yes"');
    $id->execute(array('username' => $username));
    $row = $id->fetch();
    $a=$row['memberID'];
    $b = $database->prepare('INSERT INTO billing (id,country,firstName,lastName,address,town,county,postcode,phone) VALUES (:id,:country,:firstName,:lastName,:address,:town,:county,:postcode,:phone)');
    $b->execute(array(':id' => $a,
                    ':country'=> $_POST['billing_country'],
                    ':firstName'=>$_POST['billing_first_name'],
                    ':lastName'=>$_POST['billing_last_name'],
                    ':address'=>$_POST['billing_address_1'].$_POST['billing_address_2'],
                    ':town'=>$_POST['billing_city'],
                    ':county'=>$_POST['billing_state'],
                    ':postcode'=>$_POST['billing_postcode'],
                    ':phone'=>$_POST['billing_phone']));
}
function shipping($database,$username)
{   $id = $database->prepare('SELECT memberID FROM members WHERE username= :username AND active="Yes"');
    $id->execute(array('username' => $username));
    $row = $id->fetch();
    $a=$row['memberID'];
    $b = $database->prepare('INSERT INTO shipping (id,firstName,lastName,address,town,county,postcode,phone) VALUES (:id,:country,:firstName,:lastName,:address,:town,:county,:postcode,:phone)');
    $b->execute(array(':id' => $a,
                    ':firstName'=>$_POST['shipping_first_name'],
                    ':lastName'=>$_POST['shipping_last_name'],
                    ':address'=>$_POST['shipping_address_1'].$_POST['shipping_address_2'],
                    ':town'=>$_POST['shipping_city'],
                    ':county'=>$_POST['shpping_state'],
                    ':postcode'=>$_POST['shipping_postcode'],
                    ':phone'=>$_POST['shipping_phone']));
}



            ?>