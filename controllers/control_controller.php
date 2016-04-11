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
            $sql = "select * from account natural join account_payment 
            natural join address where username='$username';";
            $result = $database->query($sql);
            if(count($result) > 0){
                $result = $result[0];
                $paymentID = $result[1];
                $methods = array('bank_account', 'credit_card', 'paypal');
                for($i=0; $<count($methods); $i++){
                    $sql = "select * from " . $methods[i] . " where payment_id='$paymentID';";
                    $result = $database->query($sql);
                    if(count($result) > 0){
                        $result = $result[0];
                        switch($methods[i]){
                            case 'bank_account':
                                $sql = "select * from " . $methods[i] . " where payment_id='$paymentID';";
                                $result = $database->query($sql);
                                $payment = new BankAccount();
                                break;
                            case 'credit_card':
                                $payment = new CreditCard();
                                break;
                            case 'paypal':
                                $payment = new PayPal();
                                break;
                        }
                        break;
                    }
                }
                
            }
            $_SESSION['account'] = $account;
            //$_SESSION['username'] = $account->getUsername();
            //$_SESSION['email'] = $account->getEmail();
            //$_SESSION['phonenumber'] = $account->getPhoneNumber();
            //$_SESSION['firstname'] = $account->getFirstName();
            //$_SESSION['lastname'] = $account->getLastName();
            //$_SESSION['streetaddress'] = $account->getShippingAddress()->getStreetAddress();
            //$_SESSION['city'] = $account->getShippingAddress()->getCity();
            //$_SESSION['parish'] = $account->getShippingAddress()->getParish();
            //$_SESSION['postalcode'] = $account->getShippingAddress()->getPostalCode();
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $result[2];
            $_SESSION['phonenumber'] = $result[4];
            $_SESSION['firstname'] = $result[5];
            $_SESSION['lastname'] = $result[6];
            $_SESSION['streetaddress'] = $result[7];
            $_SESSION['city'] = $result[8];
            $_SESSION['parish'] = $result[9];
            $_SESSION['postalcode'] = $result[10];
            echo '<script>window.location.href = "?controller=pages&action=index";</script>';
        } else {
            $boolean = $user->login('admin');
            if ($boolean) {
                //$admin = new Admin($username, $password);
                //$_SESSION['admin'] = $admin;
                //$_SESSION['username'] = $admin->getUsername();
                $_SESSION['username'] = 'admin';
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
        if (gettype($database->get_db()) != 'int'){
            $sql = "insert into account values('$username', '$email', '" . sha1($password)
                . "', $phone_number, '$first_name', '$last_name');";
            $result = $database->update($sql);
            if ($result == -1){echo '<script>alert(\'Unknown error occurred\')</script>'; return;};
            $sql = "insert into address values(0, '$street_address', '$city', '$parish', '$postal_code');";
            $result = $database->update($sql);
            if ($result == -1){echo '<script>alert(\'Unknown error occurred\')</script>'; return;};
            $sql = "insert into shipping_address values('$username', 0);";
            $result = $database->update($sql);
            if ($result == -1){echo '<script>alert(\'Unknown error occurred\')</script>'; return;};
            $_SESSION['account'] = $account;
            //$_SESSION['username'] = $account->getUsername();
            //$_SESSION['email'] = $account->getEmail();
            //$_SESSION['phonenumber'] = $account->getPhoneNumber();
            //$_SESSION['firstname'] = $account->getFirstName();
            //$_SESSION['lastname'] = $account->getLastName();
            //$_SESSION['streetaddress'] = $account->getShippingAddress()->getStreetAddress();
            //$_SESSION['city'] = $account->getShippingAddress()->getCity();
            //$_SESSION['parish'] = $account->getShippingAddress()->getParish();
            //$_SESSION['postalcode'] = $account->getShippingAddress()->getPostalCode();
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['phonenumber'] = $phone_number;
            $_SESSION['firstname'] = $first_name;
            $_SESSION['lastname'] = $last_name;
            $_SESSION['streetaddress'] = $street_address;
            $_SESSION['city'] = $city;
            $_SESSION['parish'] = $parish;
            $_SESSION['postalcode'] = $postal_code;
            echo '<script>window.location.href = "?controller=pages&action=index";</script>';
        } else {
            echo '<script>alert(\'Unknown error occurred\')</script>';
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
            $account->setUsername($username);
            $account->setEmail($email);
            $account->setPhoneNumber($phone_number);
            $account->setFirstName($first_name);
            $account->setLastName($last_name);
            $account->setShippingAddress($shipping_address);

            $database = new Database('localhost', 'pdo_ret', 'root', '');
            if (gettype($database->get_db()) != 'int'){
                $sql = "update account where username='$username' set username='$username', 
                email_address='$email', p_number=$phone_number, f_name='$first_name', l_name='$last_name';";
                $result = $database->update($sql);
                if ($result == -1){echo '<script>alert(\'Unknown error occurred\')</script>'; return;}
                $sql = "select from shipping_address where username='$username'";
                $result = $database->query($sql);
                if (count($result) < 1){
                    echo '<script>alert(\'Unknown error occurred\')</script>'; return;
                } else {
                    $result = $result[0];
                    $address_id = $result[1];
                }
                $sql = "update address where address_id=$address_id set street_address='$street_address',
                city='$city', parish='$parish', postal_code='$postal_code';";
                $result = $database->update($sql);
                if ($result == -1){echo '<script>alert(\'Unknown error occurred\')</script>'; return;}
                $_SESSION['account'] = $account;
                //$_SESSION['username'] = $account->getUsername();
                //$_SESSION['email'] = $account->getEmail();
                //$_SESSION['phonenumber'] = $account->getPhoneNumber();
                //$_SESSION['firstname'] = $account->getFirstName();
                //$_SESSION['lastname'] = $account->getLastName();
                //$_SESSION['streetaddress'] = $account->getShippingAddress()->getStreetAddress();
                //$_SESSION['city'] = $account->getShippingAddress()->getCity();
                //$_SESSION['parish'] = $account->getShippingAddress()->getParish();
                //$_SESSION['postalcode'] = $account->getShippingAddress()->getPostalCode();
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['phonenumber'] = $phone_number;
                $_SESSION['firstname'] = $first_name;
                $_SESSION['lastname'] = $last_name;
                $_SESSION['streetaddress'] = $street_address;
                $_SESSION['city'] = $city;
                $_SESSION['parish'] = $parish;
                $_SESSION['postalcode'] = $postal_code;
                echo '<script>window.location.href = "?controller=pages&action=account";</script>';
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
            //Implement
            $account = $_SESSION['account'];
            //Is there already a payment method on record?
            
            
            
            
            $payment_method = $_POST['payment_method'];
            $database = new Database('localhost', 'pdo_ret', 'root', '');
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
                    $sql = "insert into bank_account values()";
                    $result = $database->update($sql);
                    $sql = "insert into";
                    $result = $database->update($sql);
                    $sql = "insert into";
                    $result = $database->update($sql);
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
                    $sql = "insert into ";
                    $result = $database->update($sql);
                    $sql = "insert into";
                    $result = $database->update($sql);
                    $sql = "insert into";
                    $result = $database->update($sql);
                    break;
                case 'paypal':
                    $paypal_email = $_POST['paypalemail'];
                    $paypal_password = $_POST['paypalpassword'];
                    //updates
                    $sql = "insert into ";
                    $result = $database->update($sql);
                    $sql = "insert into";
                    $result = $database->update($sql);
                    $sql = "insert into";
                    $result = $database->update($sql);
                    break;
            }
            
            
            //$_SESSION['payment'] = yes;
            echo '<script>window.location.href = "?controller=pages&action=checkout";</script>';
        } else {
            if(isset($_SESSION['fromaccount'])){
                unset($_SESSION['fromaccount']);
                //$_SESSION['payment'] = yes;
                echo '<script>window.location.href = "?controller=pages&action=account";</script>';
            } else {
                echo '<script>window.location.href = "?controller=pages&action=account";</script>';
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