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
                $_SESSION['username'] = 'admin';
                echo '<script>window.location.href = "?controller=pages&action=index";</script>';
                
            } else {
                require_once('views/pages/login.php');
                echo '<script>alert(\'Incorrect username or password\')</script>';
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
            $_SESSION['username'] = $username;
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
        //Make changes to user details
    }
      
    public function addpayment(){
        if (isset($_SESSION['fromcheckout'])){
            unset($_SESSION['fromcheckout']);
            //Implement
            //$_SESSION['payment'] = yes;
            echo '<script>window.location.href = "?controller=pages&action=checkout";</script>';
        } else {
            if(isset($_SESSION['fromaccount'])){
                unset($_SESSION['fromaccount'])
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