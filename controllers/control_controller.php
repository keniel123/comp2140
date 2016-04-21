<?php

  class ControlController {
      public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = new User($username, $password);
        
        /* Login call to user object - checking credentials */
        $boolean = $user->login('account');
        if ($boolean) {
            $database = new Database('localhost', 'pdo_ret', 'root', '');
            $sql = "select * from account natural join shipping_address
            natural join address where username='$username';";
            $result = $database->query($sql);
            $result = $result[0];
            $address = new Address($result[7], $result[8], $result[9], $result[10]);
            $account = new Account($username, $result[2], $password, (float)$result[4],
                                  $result[5], $result[6], $address);
            
            /* Check for existing payment method */
            $sql = "select * from account natural join account_payment 
            natural join address where username='$username';";
            $result = $database->query($sql);
            if(count($result) > 0){
                $result = $result[0];
                $paymentID = $result[6];
                $methods = array('bank_account', 'credit_card', 'paypal');
                $ids = array('acc_id', 'cc_number', 'email');
                for($i=0; $i<count($methods); $i++){
                    $sql = "select * from " . $methods[$i] . " where ".$ids[$i]."='$paymentID';";
                    $result = $database->query($sql);
                    if(count($result) > 0){
                        $result = $result[0];
                        switch($methods[$i]){
                            case 'bank_account':{
                                $sql = "select * from bank_account natural join ba_billing_address 
                                natural join address where acc_number='$paymentID';";
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
                                }
                            case 'credit_card':{
                                $sql = "select * from credit_card natural join cc_billing_address 
                                natural join address where cc_number='$paymentID';";
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
                            }
                            case 'paypal':{
                                $sql = "select * from paypal where email='$paymentID';";
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
                        }
                        break;
                    }
                }
                
            }
            
            /* Get cart and products in cart */
            $sql = "select cart_id from account_cart where username='$username';";
            $result = $database->query($sql);
            $result = $result[0];
            $cartId = $result[0];
            $cart = new Cart();
            $cart->setCartId($cartId);
            
            $sql = "select * from cart_product where cart_id='$cartId';";
            $result = $database->query($sql);
            foreach($result as $row){
                $productId = $row[1];
                $quantity = $row[2];
                $sql = "select * from product where product_id='$productId';";
                $results = $database->query($sql);
                $results = $results[0];
                $name = $results[1];
                $price = $results[3];
                $product = new Product($productId, $name, $price);
                $cart->addToCart($product, $quantity);
            }
            
            /* Get orders */
            $products = array();
            $sql = "select order_id from account_order where username='$username';";
            $result = $database->query($sql);
            foreach($result as $row){
                $orderId = $row[0];
                $sql = "select * from orders natural join order_product where order_id='$orderId';";
                $results = $database->query($sql);
                $row = $results[0];
                $orderId = $row[0];
                $orderDate = $row[1];
                $deliveryDate = $row[2];
                $orderStatus = $row[3];
                $orderTotal = $row[4];
                foreach($results as $products_row){
                    $product = new Product($products_row[5], $products_row[6], $products_row[8]);
                    $product->setQuantity($products_row[7]);
                    array_push($products, $product);
                    
                }
                $order = new Order($orderTotal, $products);
                $order->setOrderId($orderId);
                $order->setOrderDate($orderDate);
                $order->setDeliveryDate($deliveryDate);
                $order->setOrderStatus($orderStatus);
                $account->updateOrders($order);
            }
            
            $account->setCart($cart);
            $_SESSION['account'] = $account;
            echo '<script>window.location.href = "?controller=pages&action=index";</script>';
        } 
        else {
            /* Login call to user object - checking credentials */
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
        $account = $_SESSION['account'];

        /* Logout call to account object */
        $account->logout();
    }

      public function signup(){
          if(isset($_SESSION['frompages'])){    
              unset($_SESSION['frompages']);
            /* Get posted form values */
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone_number = (float)$_POST['phonenumber'];
            $first_name = $_POST['firstname'];
            $last_name = $_POST['lastname'];
            $street_address = $_POST['saddress'];
            $city = $_POST['city'];
            $parish = $_POST['parish'];
            $postal_code = $_POST['postalcode'];

            /* Create various objects */

            $shipping_address = new Address($street_address, $city, $parish, $postal_code);
            $user = new User($username, $password);
            $bool = $user->createAccount($email, $phone_number, $first_name, $last_name, $shipping_address);
            if(!$bool){
                echo '<script>alert(\'Unknown error occurred\')</script>';
                echo '<script>window.location.href = "?controller=pages&action=signup";</script>';
                return;
            }
            echo '<script>window.location.href = "?controller=pages&action=index";</script>';
          }
          else{
              echo '<script>window.location.href = "?controller=pages&action=error";</script>';
          }
    }

      public function reset(){
        //Send reset email
        echo '<script>window.location.href = "?controller=pages&action=index";</script>';
    }

      public function change(){
        if (isset($_SESSION['fromaccount'])){
            unset($_SESSION['fromaccount']);

            /* Get postal values */
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone_number = (float) $_POST['phonenumber'];
            $first_name = $_POST['firstname'];
            $last_name = $_POST['lastname'];
            $street_address = $_POST['saddress'];
            $city = $_POST['city'];
            $parish = $_POST['parish'];
            $postal_code = $_POST['postalcode'];

            $shipping_address = new Address($street_address, $city, $parish, $postal_code);
            $account = $_SESSION['account'];
            $oldusername = $account->getUsername();


            $bool = $account->setUsername($username);
            if(!$bool){
                echo '<script>alert(\'Unknown error occurred\')</script>'; 
                return;
            }

            $bool = $account->setEmail($email);
            if(!$bool){
                echo '<script>alert(\'Unknown error occurred\')</script>'; 
                return;
            }

            $bool = $account->setPhoneNumber($phone_number);
            if(!$bool){
                echo '<script>alert(\'Unknown error occurred\')</script>'; 
                return;
            }

            $bool = $account->setFirstName($first_name);
            if(!$bool){
                echo '<script>alert(\'Unknown error occurred\')</script>'; 
                return;
            }

            $bool = $account->setLastName($last_name);
            if(!$bool){
                echo '<script>alert(\'Unknown error occurred\')</script>'; 
                return;
            }

            $bool = $account->setShippingAddress($shipping_address);
            if(!$bool){
                echo '<script>alert(\'Unknown error occurred\')</script>'; 
                return;
            }

            $_SESSION['account'] = $account;
            echo '<script>window.location.href = "?controller=pages&action=account";</script>';
        } 
        else {
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
                        $acc_id = sha1($bank_name . date());
                        $accounttype = $_POST['accounttype'];
                        $accountnumber = $_POST['accountnumber'];
                        $streetaddress = $_POST['streetaddress'];
                        $city = $_POST['city'];
                        $parish = $_POST['parish'];
                        $postalcode = $_POST['postalcode'];
                        $address_id = sha1($street_address . $city . $parish . $postalcode . sha1(round(microtime(true) * 1000)));
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new BankAccount($accountnumber, $bank_name, $accounttype, $address);
                        $account->setPaymentMethod($payment);


                        $sql = "insert into bank_account values('$acc_id', '$bank_name', '$accounttype',". (float)$accountnumber .");";
                        $result = $database->update($sql);
                        $sql = "insert into address values('$address_id', '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into ba_billing_address values('$acc_id', '$address_id');";
                        $result = $database->update($sql);
                        $sql = "insert into account_payment values('$username','$acc_id');";
                        $result = $database->update($sql);
                        $_SESSION['payment'] = 'yes';
                        $_SESSION['paymenttype'] = 'ba';
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
                        $address_id = sha1($street_address . $city . $parish . $postalcode . sha1(round(microtime(true) * 1000)));
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new CreditCard($cccardholder, $ccnumber, $ccexpiry, $cvc, $address);
                        $account->setPaymentMethod($payment);

                        $sql = "insert into credit_card values ('$ccnumber', '$cccardholder');";
                        $result = $database->update($sql);
                        $sql = "insert into address values('$address_id', '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into cc_billing_address values('$ccnumber', '$address_id');";
                        $result = $database->update($sql);
                        $sql = "insert into account_payment values('$username','$ccnumber');";
                        $result = $database->update($sql);
                        $_SESSION['payment'] = 'yes';
                        $_SESSION['paymenttype'] = 'cc';
                        break;
                    case 'paypal':
                        $paypal_email = $_POST['paypalemail'];
                        $paypal_password = $_POST['paypalpassword'];
                        //updates
                        $payment = new PayPal($paypal_email, $paypal_password);
                        $account->setPaymentMethod($payment);

                        $sql = "insert into paypal values ('$paypal_email', '$paypal_password');";
                        $result = $database->update($sql);
                        $sql = "insert into account_payment values('$username','$paypal_email');";
                        $result = $database->update($sql);
                        $_SESSION['payment'] = 'yes';
                        $_SESSION['paymenttype'] = 'pp';
                        break;
                }
            } 
            else {
                //deletes
                switch($_SESSION['paymenttype']){
                    case 'ba':{
                        $old = $account->getPaymentMethod()->getAccountNumber();
                        $sql = "select * from bank_account natural join ba_billing_address natural join address where acc_number=$old;";
                        $result = $database->query($sql);
                        $result = $result[0];
                        $sql = "delete from bank_account where acc_number=$old";
                        $database->update($sql);
                        $sql = "delete from address where address_id=$result[0]";
                        $database->update($sql);
                        break;
                    }
                    case 'cc':{
                        $old = $account->getPaymentMethod()->getCardNumber();
                        $sql = "select * from credit_card natural join cc_billing_address natural join address where cc_number=$old;";
                        $result = $database->query($sql);
                        $result = $result[0];
                        $sql = "delete from credit_card where cc_number=$old;";
                        $database->update($sql);
                        $sql = "delete from address where address_id=$result[0];";
                        $database->update($sql);
                        break;
                    }
                    case 'pp':{
                        $old = $account->getPaymentMethod()->getEmail();
                        $sql = "delete from paypal where email='$old';";
                        $database->update($sql);
                        break;
                    }
                }

                //updates
                switch ($payment_method){
                    case 'bankaccount':{
                        $bank_name = $_POST['bankname'];
                        $acc_id = sha1($bank_name . date());
                        $accounttype = $_POST['accounttype'];
                        $accountnumber = $_POST['accountnumber'];
                        $streetaddress = $_POST['streetaddress'];
                        $city = $_POST['city'];
                        $parish = $_POST['parish'];
                        $postalcode = $_POST['postalcode'];
                        $address_id = sha1($street_address . $city . $parish . $postalcode . sha1(round(microtime(true) * 1000)));
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new BankAccount($accountnumber, $bank_name, $accounttype, $address);
                        $account->setPaymentMethod($payment);


                        $sql = "insert into bank_account values('$acc_id', '$bank_name', '$accounttype', $accountnumber);";
                        $result = $database->update($sql);
                        $sql = "insert into address values('$address_id', '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into ba_billing_address values('$acc_id', '$address_id');";
                        $result = $database->update($sql);
                        $sql = "insert into account_payment values('$username','$acc_id');";
                        $result = $database->update($sql);
                        $_SESSION['payment'] = 'yes';
                        $_SESSION['paymenttype'] = 'ba';
                        break;
                    }
                    case 'creditcard':{
                        $cctype = $_POST['cctype'];
                        $ccnumber = $_POST['ccnumber'];
                        $cvc = $_POST['cvc'];
                        $ccexpiry = $_POST['ccexpiry'];
                        $cccardholder = $_POST['cccardholder'];
                        $streetaddress = $_POST['ccstreetaddress'];
                        $city = $_POST['cccity'];
                        $parish = $_POST['ccparish'];
                        $postalcode = $_POST['ccpostalcode'];
                        $address_id = sha1($street_address . $city . $parish . $postalcode . sha1(round(microtime(true) * 1000)));
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new CreditCard($cccardholder, $ccnumber, $ccexpiry, $cvc, $address);
                        $account->setPaymentMethod($payment);

                        $sql = "insert into credit_card values ($ccnumber, '$cccardholder');";
                        $result = $database->update($sql);
                        $sql = "insert into address values(0, '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into cc_billing_address values($ccnumber, 0);";
                        $result = $database->update($sql);
                        $sql = "insert into account_payment values('$username','$ccnumber');";
                        $result = $database->update($sql);
                        $_SESSION['payment'] = 'yes';
                        $_SESSION['paymenttype'] = 'cc';
                        break;
                    }
                    case 'paypal':{
                        $paypal_email = $_POST['paypalemail'];
                        $paypal_password = $_POST['paypalpassword'];
                        //updates
                        $payment = new PayPal($paypal_email, $paypal_password);
                        $account->setPaymentMethod($payment);

                        $sql = "insert into paypal values('$paypal_email', '$paypal_password');";
                        $result = $database->update($sql);
                        $sql = "insert into account_payment values('$username','$paypal_email');";
                        $result = $database->update($sql);
                        $_SESSION['payment'] = 'yes';
                        $_SESSION['paymenttype'] = 'pp';
                        break;
                    }
                }
            }
            echo '<script>window.location.href = "?controller=pages&action=checkout";</script>';
        } 
        else if(isset($_SESSION['fromaccount'])){
            unset($_SESSION['fromaccount']);
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
                    case 'bankaccount':{
                        $bank_name = $_POST['bankname'];
                        $acc_id = sha1($bank_name . date());
                        $accounttype = $_POST['accounttype'];
                        $accountnumber = $_POST['accountnumber'];
                        $streetaddress = $_POST['streetaddress'];
                        $city = $_POST['city'];
                        $parish = $_POST['parish'];
                        $postalcode = $_POST['postalcode'];
                        $address_id = sha1($street_address . $city . $parish . $postalcode . sha1(round(microtime(true) * 1000)));
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new BankAccount($accountnumber, $bank_name, $accounttype, $address);
                        $account->setPaymentMethod($payment);


                        $sql = "insert into bank_account values('$acc_id', '$bank_name', '$accounttype',". (float)$accountnumber .");";
                        $result = $database->update($sql);
                        $sql = "insert into address values('$address_id', '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into ba_billing_address values('$acc_id', '$address_id');";
                        $result = $database->update($sql);
                        $sql = "insert into account_payment values('$username','$acc_id');";
                        $result = $database->update($sql);
                        $_SESSION['payment'] = 'yes';
                        $_SESSION['paymenttype'] = 'ba';
                        break;
                    }
                    case 'creditcard':{
                        $cctype = $_POST['cctype'];
                        $ccnumber = $_POST['ccnumber'];
                        $cvc = $_POST['cvc'];
                        $ccexpiry = $_POST['ccexpiry'];
                        $cccardholder = $_POST['cccardholder'];
                        $streetaddress = $_POST['ccstreetaddress'];
                        $city = $_POST['cccity'];
                        $parish = $_POST['ccparish'];
                        $postalcode = $_POST['ccpostalcode'];
                        $address_id = sha1($street_address . $city . $parish . $postalcode . sha1(round(microtime(true) * 1000)));
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new CreditCard($cccardholder, $ccnumber, $ccexpiry, $cvc, $address);
                        $account->setPaymentMethod($payment);

                        $sql = "insert into credit_card values ('$ccnumber', '$cccardholder');";
                        $result = $database->update($sql);
                        $sql = "insert into address values('$address_id', '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into cc_billing_address values('$ccnumber', '$address_id');";
                        $result = $database->update($sql);
                        $sql = "insert into account_payment values('$username','$ccnumber');";
                        $result = $database->update($sql);
                        $_SESSION['payment'] = 'yes';
                        $_SESSION['paymenttype'] = 'cc';
                        break;
                    }
                    case 'paypal':{
                        $paypal_email = $_POST['paypalemail'];
                        $paypal_password = $_POST['paypalpassword'];
                        //updates
                        $payment = new PayPal($paypal_email, $paypal_password);
                        $account->setPaymentMethod($payment);

                        $sql = "insert into paypal values ('$paypal_email', '$paypal_password');";
                        $result = $database->update($sql);
                        $sql = "insert into account_payment values('$username','$paypal_email');";
                        $result = $database->update($sql);
                        $_SESSION['payment'] = 'yes';
                        $_SESSION['paymenttype'] = 'pp';
                        break;
                    }
                }
            } 
            else {
                //deletes
                switch($_SESSION['paymenttype']){
                    case 'ba':{
                        $old = $account->getPaymentMethod()->getAccountNumber();
                        $sql = "select * from bank_account natural join ba_billing_address natural join address where acc_number=$old;";
                        $result = $database->query($sql);
                        $result = $result[0];
                        $sql = "delete from bank_account where acc_number=$old;";
                        $database->update($sql);
                        $sql = "delete from address where address_id='$result[0]';";
                        $database->update($sql);
                        $sql = "delete from account_payment where username='$username';";
                        $database->update($sql);
                        break;
                    }
                    case 'cc':{
                        $old = $account->getPaymentMethod()->getCardNumber();
                        $sql = "select * from credit_card natural join cc_billing_address natural join address where cc_number='$old';";
                        $result = $database->query($sql);
                        $result = $result[0];
                        $sql = "delete from credit_card where cc_number='$old';";
                        $database->update($sql);
                        $sql = "delete from address where address_id='$result[0]';";
                        $database->update($sql);
                        $sql = "delete from account_payment where username='$username';";
                        $database->update($sql);
                        break;
                    }
                    case 'pp':{
                        $old = $account->getPaymentMethod()->getEmail();
                        $sql = "delete from paypal where email='$old';";
                        $database->update($sql);
                        $sql = "delete from account_payment where username='$username';";
                        $database->update($sql);
                        break;
                    }
                }

                //updates
                switch ($payment_method){
                    case 'bankaccount':{
                        $bank_name = $_POST['bankname'];
                        $acc_id = sha1($bank_name . date());
                        $accounttype = $_POST['accounttype'];
                        $accountnumber = $_POST['accountnumber'];
                        $streetaddress = $_POST['streetaddress'];
                        $city = $_POST['city'];
                        $parish = $_POST['parish'];
                        $postalcode = $_POST['postalcode'];
                        $address_id = sha1($street_address . $city . $parish . $postalcode . sha1(round(microtime(true) * 1000)));
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new BankAccount($accountnumber, $bank_name, $accounttype, $address);
                        $account->setPaymentMethod($payment);


                        $sql = "insert into bank_account values('$acc_id', '$bank_name', '$accounttype', $accountnumber);";
                        $result = $database->update($sql);
                        $sql = "insert into address values('$address_id', '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into ba_billing_address values('$acc_id', '$address_id');";
                        $result = $database->update($sql);
                        $sql = "insert into account_payment values('$username','$acc_id');";
                        $result = $database->update($sql);
                        $_SESSION['payment'] = 'yes';
                        $_SESSION['paymenttype'] = 'ba';
                        break;
                    }
                    case 'creditcard':{
                        $cctype = $_POST['cctype'];
                        $ccnumber = $_POST['ccnumber'];
                        $cvc = $_POST['cvc'];
                        $ccexpiry = $_POST['ccexpiry'];
                        $cccardholder = $_POST['cccardholder'];
                        $streetaddress = $_POST['ccstreetaddress'];
                        $city = $_POST['cccity'];
                        $parish = $_POST['ccparish'];
                        $postalcode = $_POST['ccpostalcode'];
                        $address_id = sha1($streetaddress . $city . $parish . $postalcode);
                        //updates
                        $address = new Address($streetaddress, $city, $parish, $postalcode);
                        $payment = new CreditCard($cccardholder, $ccnumber, $ccexpiry, $cvc, $address);
                        $account->setPaymentMethod($payment);

                        $sql = "insert into credit_card values ($ccnumber, '$cccardholder');";
                        $result = $database->update($sql);
                        $sql = "insert into address values('$address_id', '$streetaddress', '$city', '$parish', '$postalcode');";
                        $result = $database->update($sql);
                        $sql = "insert into cc_billing_address values($ccnumber, '$address_id');";
                        $result = $database->update($sql);
                        $sql = "insert into account_payment values('$username','$ccnumber');";
                        $result = $database->update($sql);
                        $_SESSION['payment'] = 'yes';
                        $_SESSION['paymenttype'] = 'cc';
                        break;
                    }
                    case 'paypal':{
                        $paypal_email = $_POST['paypalemail'];
                        $paypal_password = $_POST['paypalpassword'];
                        //updates
                        $payment = new PayPal($paypal_email, $paypal_password);
                        $account->setPaymentMethod($payment);

                        $sql = "insert into paypal values('$paypal_email', '$paypal_password');";
                        $result = $database->update($sql);
                        $sql = "insert into account_payment values('$username','$paypal_email');";
                        $result = $database->update($sql);
                        $_SESSION['payment'] = 'yes';
                        $_SESSION['paymenttype'] = 'pp';
                        break;
                    }
                }
            }
            echo '<script>window.location.href = "?controller=pages&action=account";</script>';
            } 
        else {
            echo '<script>window.location.href = "?controller=pages&action=account";</script>';
        }
    }

      public function addtocart(){
          if (isset($_SESSION['account'])){
        $account = $_SESSION['account'];
        $productId = $_POST['productid'];
        $quantity = $_POST['quantity'];

        /* Checking availability */
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        $sql = "select product_name, quantity_left, price from product where product_id='$productId';";
        $result = $database->query($sql);
        $result = $result[0];
        $product_name = $result[0];
        $quantity_left = $result[1];
        $price = $result[2];
        if($quantity <= $quantity_left){
            /* Adding to cart */
            $product = new Product($productId, $product_name, $price);
            $product->setQuantity($quantity);
            $bool = $account->getCart()->addToCart($product, (float)$quantity);
            if($bool == TRUE){
                echo '<script>window.location.href=\'?controller=pages&action=shop\';</script>';
            } 
            else {
                echo '<script>alert(\'Unknown error occurred\');</script>';
                echo '<script>window.location.href=\'?controller=pages&action=shop\';</script>';
            }
        }
        else {
            echo '<script>alert(\'Quantity not available\');</script>';
            echo '<script>window.location.href=\'?controller=pages&action=shop\';</script>';
        }
          }
          else{
              echo '<script>window.location.href=\'?controller=pages&action=login\';</script>';
          }
    }

      public function removefromcart(){
          $database = new Database('localhost', 'pdo_ret', 'root', '');
          $productId = $_POST['productid'];
          $sql = "select product_name from product where product_id='$productId';";
          $results = $database->query($sql);
          $row = $results[0];
          $name = $row[0];
          $account = $_SESSION['account'];
          $account->getCart()->removeFromCart($name);
          $_SESSION['account'] = $account;
          echo '<script>window.location.href=\'?controller=pages&action=cart\'</script>';
    }

      public function checkout(){
          //Implement here
          $account = $_SESSION['account'];
          $database = new Database('localhost', 'pdo_ret', 'root', '');
          $cart = $account->getCart();
          
          /* Validate Payment */
          $paymentMethod = $account->getPaymentMethod();
          $bool = $paymentMethod->validatePayment();
          if($bool){
              /* Get items from the cart */
              $items = $account->fetchItems();
              
              /* Check availability of each item */
              foreach($items as $product){
                  $sql = "select quantity_left from product where product_id='".$product->getProductId()."';";
                  $result = $database->query($sql);
                  $row = $result[0];
                  $quantity_left = $row[0];
                  if($product->getQuantity() > $quantity_left){
                      $overage = $product->getQuantity() - $quantity_left;
                      /* Generate error message */
                      echo '<script>alert("You have'. $overage .' more'. $product->getName() .' than is currently available");</script>';
                      echo '<script>window.location.href="?controller=pages&action=cart";</script>';
                  }
              }
              
              /* Charge payment method and update orders for this account */
              $account->chargePaymentMethod();
              $order = new Order($cart->getTotal(), $cart->getItems());
              $account->updateOrders($order);
              $sql = "insert into orders values('".$order->getOrderId()."', ".(float)$order->getOrderDate().",
              ".(float)$order->getDeliveryDate().", '".$order->getOrderStatus()."', ".$order->getTotal().");";
              $database->update($sql);
              $sql = "insert into account_order values('".$account->getUsername()."', '".$order->getOrderId()."');";
              $database->update($sql);
              foreach($items as $product){
                  $orderId = $order->getOrderId();
                  $productId = $product->getProductId();
                  $productName = $product->getName();
                  $productQuantity = (int)$product->getQuantity();
                  $productPrice = (float)$product->getPrice();
                  $sql = "insert into order_product values('$orderId', '$productId', '$productName', $productQuantity, $productPrice);";
                  $result = $database->update($sql);
                  
                  /* Decrease quantity of product available */
                  $sql = "update product set quantity_left=quantity_left-".$product->getQuantity()." 
                  where product_id='".$product->getProductId()."';";
                  $database->update($sql);
              }
              
              /* Empty Cart */
              $account->getCart()->emptyCart();
              $_SESSION['account'] = $account;
              
              /* Redirect to orders page */
              echo '<script>window.location.href="?controller=pages&action=orders";</script>';
          }
          else {
              //Generate error message
              echo '<script>alert("You do not have enough funds to make this purchase");</script>';
              echo '<script>window.location.href="?controller=pages&action=checkout";</script>';
          }
    }
      
  }
?>