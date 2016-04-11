<?php

  class ControlController {
      
    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = new User($username, $password);
        $boolean = $user->login('account');
        if ($boolean) {
            $database = new Database('localhost', 'pdo_ret', 'root', '');
            $sql = "select * from account natural join shipping_address
            natural join address where username='$username';";
            $result = $database->query($sql);
            $result = $result[0];
            $address = new Address($result[7], $result[8], $result[9], $result[10]);
            $account = new Account($username, $result[2], $password, $result[4],
                                  $result[5], $result[6], $address);
            
            //Check for existing payment method
            $sql = "select * from account natural join account_payment 
            natural join address where username='$username';";
            $result = $database->query($sql);
            if(count($result) > 0){
                $result = $result[0];
                $paymentID = $result[1];
                $methods = array('bank_account', 'credit_card', 'paypal');
                for($i=0; $i<count($methods); $i++){
                    $sql = "select * from " . $methods[i] . " where payment_id='$paymentID';";
                    $result = $database->query($sql);
                    if(count($result) > 0){
                        $result = $result[0];
                        switch($methods[i]){
                            case 'bank_account':
                                $sql = "select * from bank_account natural join ba_billing_address 
                                natural join address where payment_id='$paymentID';";
                                $result = $database->query($sql);
                                $result = $result[0];
                                $street = $result[5];
                                $city = $result[6];
                                $parish = $result[7];
                                $postal = $result[8];
                                $address = new Address($street, $city, $parish, $postal);
                                $payment = new BankAccount($result[4], $result[2], $result[3], $address);
                                $account->setPaymentMethod($payment);
                                $_SESSION['payment'] = 'yes';
                                $_SESSION['paymenttype'] = 'ba';
                                break;
                            case 'credit_card':
                                $sql = "select * from credit_card natural join cc_billing_address 
                                natural join address where payment_id='$paymentID';";
                                $result = $database->query($sql);
                                $result = $result[0];
                                $ccnumber = $result[1];
                                $cardholder = $result[2];
                                $street = $result[3];
                                $city = $result[4];
                                $parish = $result[5];
                                $postal = $result[6];
                                $address = new Address($street, $city, $parish, $postal);
                                $payment = new CreditCard($cardholder, $ccnumber, '', '', $address);
                                $account->setPaymentMethod($payment);
                                $_SESSION['payment'] = 'yes';
                                $_SESSION['paymenttype'] = 'cc';
                                break;
                            case 'paypal':
                                $sql = "select * from paypal where payment_id='$paymentID';";
                                $result = $database->query($sql);
                                $result = $result[0];
                                $email = $result[0];
                                $password = $result[1];
                                $payment = new PayPal($email, $password);
                                $account->setPaymentMethod($payment);
                                $_SESSION['payment'] = 'yes';
                                $_SESSION['paymenttype'] = 'pp';
                                break;
                        }
                        break;
                    }
                }
                
            }
            $_SESSION['account'] = $account;
            $_SESSION['username'] = $account->getUsername();
            $_SESSION['email'] = $account->getEmail();
            $_SESSION['phonenumber'] = $account->getPhoneNumber();
            $_SESSION['firstname'] = $account->getFirstName();
            $_SESSION['lastname'] = $account->getLastName();
            $_SESSION['streetaddress'] = $account->getShippingAddress()->getStreetAddress();
            $_SESSION['city'] = $account->getShippingAddress()->getCity();
            $_SESSION['parish'] = $account->getShippingAddress()->getParish();
            $_SESSION['postalcode'] = $account->getShippingAddress()->getPostalCode();
            echo '<script>window.location.href = "?controller=pages&action=index";</script>';
        } else {
            $boolean = $user->login('admin');
            if ($boolean) {
                $admin = new Admin($username, $password);
                $_SESSION['admin'] = $admin;
                $_SESSION['username'] = $admin->getUsername();
                echo '<script>window.location.href = "?controller=pages&action=index";</script>';
                
            } else {
                $_SESSION['incorrect'] = 'yes';
                echo '<script>window.location.href = "?controller=pages&action=login";</script>';
            }
        }
    }
      
    public function logout(){
        session_unset();
        session_destroy();
        echo '<script>window.location.href = "?controller=pages&action=index";</script>';
    }
      
    public function signup(){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone_number = $_POST['phonenumber'];
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $street_address = $_POST['saddress'];
        $city = $_POST['city'];
        $parish = $_POST['parish'];
        $postal_code = $_POST['postalcode'];
        
        $shipping_address = new Address($street_address, $city, $parish, $postal_code);
        $account = new Account($username, $email, $password, $phone_number, 
                              $first_name, $last_name, $shipping_address);
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        if (gettype($database->get_db()) == 'object'){
            $sql = "insert into account values('$username', '$email', '" . sha1($password)
                . "', ".(int)$phone_number.", '$first_name', '$last_name');";
            $result = $database->update($sql);
            if ($result == -1){
                echo '<script>alert(\'Unknown error occurred\')</script>';
                echo '<script>window.location.href = "?controller=pages&action=signup";</script>';
            }
            $sql = "insert into address values(0, '$street_address', '$city', '$parish', '$postal_code');";
            $result = $database->update($sql);
            if ($result == -1){
                echo '<script>alert(\'Unknown error occurred\')</script>';
                echo '<script>window.location.href = "?controller=pages&action=signup";</script>';
            }
            $sql = "insert into shipping_address values('$username', 0);";
            $result = $database->update($sql);
            if ($result == -1){
                echo '<script>alert(\'Unknown error occurred\')</script>';
                echo '<script>window.location.href = "?controller=pages&action=signup";</script>';
            }
            $_SESSION['account'] = $account;
            $_SESSION['username'] = $account->getUsername();
            $_SESSION['email'] = $account->getEmail();
            $_SESSION['phonenumber'] = $account->getPhoneNumber();
            $_SESSION['firstname'] = $account->getFirstName();
            $_SESSION['lastname'] = $account->getLastName();
            $_SESSION['streetaddress'] = $account->getShippingAddress()->getStreetAddress();
            $_SESSION['city'] = $account->getShippingAddress()->getCity();
            $_SESSION['parish'] = $account->getShippingAddress()->getParish();
            $_SESSION['postalcode'] = $account->getShippingAddress()->getPostalCode();
            echo '<script>window.location.href = "?controller=pages&action=index";</script>';
        } else {
            echo '<script>alert(\'Unknown error occurred\')</script>';
            echo '<script>window.location.href = "?controller=pages&action=signup";</script>';
        }
        
    }
      
    public function reset(){
        //Send reset email
        echo '<script>window.location.href = "?controller=pages&action=index";</script>';
    }
      
    public function change(){
        if (isset($_SESSION['fromaccount'])){
            unset($_SESSION['fromaccount']);
            //Make changes to user details
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone_number = $_POST['phonenumber'];
            $first_name = $_POST['firstname'];
            $last_name = $_POST['lastname'];
            $street_address = $_POST['saddress'];
            $city = $_POST['city'];
            $parish = $_POST['parish'];
            $postal_code = $_POST['postalcode'];

            $shipping_address = new Address($street_address, $city, $parish, $postal_code);
            $account = $_SESSION['account'];
            $oldusername = $account->getUsername();
            $account->setUsername($username);
            $account->setEmail($email);
            $account->setPhoneNumber($phone_number);
            $account->setFirstName($first_name);
            $account->setLastName($last_name);
            $account->setShippingAddress($shipping_address);

            $database = new Database('localhost', 'pdo_ret', 'root', '');
            if (gettype($database->get_db()) != 'int'){
                $sql = "update account set username='$username', email_address='$email', 
                p_number=". (int)$phone_number .", f_name='$first_name', l_name='$last_name' where username='$oldusername';";
                $result = $database->update($sql);
                if ($result == -1){echo '<script>alert(\'Unknown error occurred\')</script>'; return;}
                $sql = "select from shipping_address where username='$oldusername'";
                $result = $database->query($sql);
                if (count($result) < 1){
                    echo '<script>alert(\'Unknown error occurred\')</script>'; return;
                } else {
                    $result = $result[0];
                    $address_id = $result[1];
                    $sql = "update address set street_address='$street_address',
                    city='$city', parish='$parish', postal_code='$postal_code' where address_id=" . (int)$address_id . ";";
                    $result = $database->update($sql);
                    if ($result == -1){echo '<script>alert(\'Unknown error occurred\')</script>'; return;}
                    $_SESSION['account'] = $account;
                    $_SESSION['username'] = $account->getUsername();
                    $_SESSION['email'] = $account->getEmail();
                    $_SESSION['phonenumber'] = $account->getPhoneNumber();
                    $_SESSION['firstname'] = $account->getFirstName();
                    $_SESSION['lastname'] = $account->getLastName();
                    $_SESSION['streetaddress'] = $account->getShippingAddress()->getStreetAddress();
                    $_SESSION['city'] = $account->getShippingAddress()->getCity();
                    $_SESSION['parish'] = $account->getShippingAddress()->getParish();
                    $_SESSION['postalcode'] = $account->getShippingAddress()->getPostalCode();
                    echo '<script>window.location.href = "?controller=pages&action=account";</script>';
                }
            } else {
                echo '<script>alert(\'Unknown error occurred\')</script>';
            }
        } else {
            echo '<script>window.location.href = "?controller=pages&action=login";</script>';
        }
    }
      
    public function addpayment(){
        if (isset($_SESSION['fromcheckout'])){
            unset($_SESSION['fromcheckout']);
            $account = $_SESSION['account'];
            $username = $account->getUsername();
            $existing = 'no';

            //Check for existing payment method
            $method = $account->getPaymentMethod();
            if(gettype($method) == 'object'){
                $existing = 'yes';
            }
            
            $payment_method = $_POST['payment_method'];
            $database = new Database('localhost', 'pdo_ret', 'root', '');
            if($existing == 'no') {
                switch ($payment_method){
                    case 'bankaccount':
                        $bank_name = $_POST['bankname'];
                        $accounttype = $_POST['accounttype'];
                        $accountnumber = $_POST['accountnumber'];
                        $streetaddress = $_POST['streetaddress'];
                        $city = $_POST['city'];
                        $parish = $_POST['parish'];
                        $postalcode = $_POST['postalcode'];
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new BankAccount($accountnumber, $bank, $accounttype, $address);
                        $account->setPaymentMethod($payment);
                        
                        
                        $sql = "insert into bank_account values(0, '$bank_name', '$accounttype', $accountnumber);";
                        $result = $database->update($sql);
                        $sql = "insert into address values(0, '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into ba_billing_address values(0, 0);";
                        $result = $database->update($sql);
                        $_session['payment'] = 'yes';
                        break;
                    case 'creditcard':
                        $cctype = $_POST['cctype'];
                        $ccnumber = $_POST['ccnumber'];
                        $cvc = $_POST['cvc'];
                        $ccexpiry = $_POST['ccexpiry'];
                        $cccardholder = $_POST['cccardholder'];
                        $streetaddress = $_POST['ccstreetaddress'];
                        $city = $_POST['cccity'];
                        $parish = $_POST['ccparish'];
                        $postalcode = $_POST['ccpostalcode'];
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new CreditCard($cccardholder, $ccnumber, $ccexpiry, $cvc, $address);
                        $account->setPaymentMethod($payment);
                        
                        $sql = "insert into credit_card values ($ccnumber, '$cccardholder')";
                        $result = $database->update($sql);
                        $sql = "insert into address values(0, '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into cc_billing_address values($ccnumber, 0);";
                        $result = $database->update($sql);
                        $_session['payment'] = 'yes';
                        break;
                    case 'paypal':
                        $paypal_email = $_POST['paypalemail'];
                        $paypal_password = $_POST['paypalpassword'];
                        //updates
                        $payment = new PayPal($paypal_email, $paypal_password);
                        $account->setPaymentMethod($payment);
                        
                        $sql = "insert into paypal values ('$paypal_email', '$paypal_password');";
                        $result = $database->update($sql);
                        $_session['payment'] = 'yes';
                        break;
                }
            } else {
                //deletes
                switch($_SESSION['paymenttype']){
                    case 'ba':
                        $old = $account->getPaymentMethod()->getAccountNumber();
                        $sql = "select * from bank_account natural join ba_billing_address natural join address where acc_number=$old;";
                        $result = $database->query($sql);
                        $result = $result[0];
                        $sql = "delete * from bank_account where acc_number=$old";
                        $database->update($sql);
                        $sql = "delete * from address where address_id=$result[0]";
                        $database->update($sql);
                        break;
                    case 'cc':
                        $old = $account->getPaymentMethod()->getCardNumber();
                        $sql = "select * from credit_card natural join cc_billing_address natural join address where cc_number=$old;";
                        $result = $database->query($sql);
                        $result = $result[0];
                        $sql = "delete * from credit_card where cc_number=$old;";
                        $database->update($sql);
                        $sql = "delete * from address where address_id=$result[0];";
                        $database->update($sql);
                        break;
                    case 'pp':
                        $old = $account->getPaymentMethod()->getEmail();
                        $sql = "delete * from paypal where email='$old';";
                        $database->update($sql);
                        break;
                }
                
                switch ($payment_method){
                    case 'bankaccount':
                        $bank_name = $_POST['bankname'];
                        $accounttype = $_POST['accounttype'];
                        $accountnumber = $_POST['accountnumber'];
                        $streetaddress = $_POST['streetaddress'];
                        $city = $_POST['city'];
                        $parish = $_POST['parish'];
                        $postalcode = $_POST['postalcode'];
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new BankAccount($accountnumber, $bank, $accounttype, $address);
                        $account->setPaymentMethod($payment);
                        
                        
                        $sql = "insert into bank_account values(0, '$bank_name', '$accounttype', $accountnumber);";
                        $result = $database->update($sql);
                        $sql = "insert into address values(0, '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into ba_billing_address values(0, 0);";
                        $result = $database->update($sql);
                        $_session['payment'] = 'yes';
                        break;
                    case 'creditcard':
                        $cctype = $_POST['cctype'];
                        $ccnumber = $_POST['ccnumber'];
                        $cvc = $_POST['cvc'];
                        $ccexpiry = $_POST['ccexpiry'];
                        $cccardholder = $_POST['cccardholder'];
                        $streetaddress = $_POST['ccstreetaddress'];
                        $city = $_POST['cccity'];
                        $parish = $_POST['ccparish'];
                        $postalcode = $_POST['ccpostalcode'];
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new CreditCard($cccardholder, $ccnumber, $ccexpiry, $cvc, $address);
                        $account->setPaymentMethod($payment);
                        
                        $sql = "insert into credit_card values ($ccnumber, '$cccardholder')";
                        $result = $database->update($sql);
                        $sql = "insert into address values(0, '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into cc_billing_address values($ccnumber, 0);";
                        $result = $database->update($sql);
                        $_session['payment'] = 'yes';
                        break;
                    case 'paypal':
                        $paypal_email = $_POST['paypalemail'];
                        $paypal_password = $_POST['paypalpassword'];
                        //updates
                        $payment = new PayPal($paypal_email, $paypal_password);
                        $account->setPaymentMethod($payment);
                        
                        $sql = "insert into paypal values ('$paypal_email', '$paypal_password');";
                        $result = $database->update($sql);
                        $_session['payment'] = 'yes';
                        break;
                }
            }
            echo '<script>window.location.href = "?controller=pages&action=checkout";</script>';
        } else {
            if(isset($_SESSION['fromaccount'])){
                unset($_SESSION['fromaccount']);
                $account = $_SESSION['account'];
            $username = $account->getUsername();
            $existing = 'no';

            //Check for existing payment method
            $method = $account->getPaymentMethod();
                echo gettype($method);
            if(gettype($method) == 'object'){
                $existing = 'yes';
            }
            
            $payment_method = $_POST['payment_method'];
            $database = new Database('localhost', 'pdo_ret', 'root', '');
            if($existing == 'no') {
                switch ($payment_method){
                    case 'bankaccount':
                        $bank_name = $_POST['bankname'];
                        $accounttype = $_POST['accounttype'];
                        $accountnumber = $_POST['accountnumber'];
                        $streetaddress = $_POST['streetaddress'];
                        $city = $_POST['city'];
                        $parish = $_POST['parish'];
                        $postalcode = $_POST['postalcode'];
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new BankAccount($accountnumber, $bank_name, $accounttype, $address);
                        $account->setPaymentMethod($payment);
                        
                        
                        $sql = "insert into bank_account values(0, '$bank_name', '$accounttype',". (int)$accountnumber .");";
                        $result = $database->update($sql);
                        $sql = "insert into address values(0, '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into ba_billing_address values(0, 0);";
                        $result = $database->update($sql);
                        $_session['payment'] = 'yes';
                        $_session['paymenttype'] = 'ba';
                        break;
                    case 'creditcard':
                        $cctype = $_POST['cctype'];
                        $ccnumber = $_POST['ccnumber'];
                        $cvc = $_POST['cvc'];
                        $ccexpiry = $_POST['ccexpiry'];
                        $cccardholder = $_POST['cccardholder'];
                        $streetaddress = $_POST['ccstreetaddress'];
                        $city = $_POST['cccity'];
                        $parish = $_POST['ccparish'];
                        $postalcode = $_POST['ccpostalcode'];
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new CreditCard($cccardholder, $ccnumber, $ccexpiry, $cvc, $address);
                        $account->setPaymentMethod($payment);
                        
                        $sql = "insert into credit_card values (".(int)$ccnumber.", '$cccardholder')";
                        $result = $database->update($sql);
                        $sql = "insert into address values(0, '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into cc_billing_address values(".(int)$ccnumber.", 0);";
                        $result = $database->update($sql);
                        $_session['payment'] = 'yes';
                        $_session['paymenttype'] = 'cc';
                        break;
                    case 'paypal':
                        $paypal_email = $_POST['paypalemail'];
                        $paypal_password = $_POST['paypalpassword'];
                        //updates
                        $payment = new PayPal($paypal_email, $paypal_password);
                        $account->setPaymentMethod($payment);
                        
                        $sql = "insert into paypal values ('$paypal_email', '$paypal_password');";
                        $result = $database->update($sql);
                        $_session['payment'] = 'yes';
                        $_session['paymenttype'] = 'pp';
                        break;
                }
            } else {
                //deletes
                switch($_SESSION['paymenttype']){
                    case 'ba':
                        $old = $account->getPaymentMethod()->getAccountNumber();
                        $sql = "select * from bank_account natural join ba_billing_address natural join address where acc_number=$old;";
                        $result = $database->query($sql);
                        $result = $result[0];
                        $sql = "delete * from bank_account where acc_number=$old";
                        $database->update($sql);
                        $sql = "delete * from address where address_id=$result[0]";
                        $database->update($sql);
                        break;
                    case 'cc':
                        $old = $account->getPaymentMethod()->getCardNumber();
                        $sql = "select * from credit_card natural join cc_billing_address natural join address where cc_number=$old;";
                        $result = $database->query($sql);
                        $result = $result[0];
                        $sql = "delete * from credit_card where cc_number=$old;";
                        $database->update($sql);
                        $sql = "delete * from address where address_id=$result[0];";
                        $database->update($sql);
                        break;
                    case 'pp':
                        $old = $account->getPaymentMethod()->getEmail();
                        $sql = "delete * from paypal where email='$old';";
                        $database->update($sql);
                        break;
                }
                
                switch ($payment_method){
                    case 'bankaccount':
                        $bank_name = $_POST['bankname'];
                        $accounttype = $_POST['accounttype'];
                        $accountnumber = $_POST['accountnumber'];
                        $streetaddress = $_POST['streetaddress'];
                        $city = $_POST['city'];
                        $parish = $_POST['parish'];
                        $postalcode = $_POST['postalcode'];
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new BankAccount($accountnumber, $bank_name, $accounttype, $address);
                        $account->setPaymentMethod($payment);
                        
                        
                        $sql = "insert into bank_account values(0, '$bank_name', '$accounttype', $accountnumber);";
                        $result = $database->update($sql);
                        $sql = "insert into address values(0, '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into ba_billing_address values(0, 0);";
                        $result = $database->update($sql);
                        $_session['payment'] = 'yes';
                        $_session['paymenttype'] = 'ba';
                        break;
                    case 'creditcard':
                        $cctype = $_POST['cctype'];
                        $ccnumber = $_POST['ccnumber'];
                        $cvc = $_POST['cvc'];
                        $ccexpiry = $_POST['ccexpiry'];
                        $cccardholder = $_POST['cccardholder'];
                        $streetaddress = $_POST['ccstreetaddress'];
                        $city = $_POST['cccity'];
                        $parish = $_POST['ccparish'];
                        $postalcode = $_POST['ccpostalcode'];
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new CreditCard($cccardholder, $ccnumber, $ccexpiry, $cvc, $address);
                        $account->setPaymentMethod($payment);
                        
                        $sql = "insert into credit_card values ($ccnumber, '$cccardholder')";
                        $result = $database->update($sql);
                        $sql = "insert into address values(0, '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into cc_billing_address values($ccnumber, 0);";
                        $result = $database->update($sql);
                        $_session['payment'] = 'yes';
                        $_session['paymenttype'] = 'cc';
                        break;
                    case 'paypal':
                        $paypal_email = $_POST['paypalemail'];
                        $paypal_password = $_POST['paypalpassword'];
                        //updates
                        $payment = new PayPal($paypal_email, $paypal_password);
                        $account->setPaymentMethod($payment);
                        
                        $sql = "insert into paypal values ('$paypal_email', '$paypal_password');";
                        $result = $database->update($sql);
                        $_session['payment'] = 'yes';
                        $_session['paymenttype'] = 'pp';
                        break;
                }
            }
                //echo '<script>window.location.href = "?controller=pages&action=account";</script>';
            } else {
                //echo '<script>window.location.href = "?controller=pages&action=account";</script>';
            }
        }
    }
      
    public function addtocart(){
        //Implement
    }
      
    public function removefromcart(){
        //Implement
    }
  }
?>