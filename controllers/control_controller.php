<?php
  require_once ('models/control/database.php');
  require_once ('models/merchant/user.php');
  require_once ('models/merchant/account.php');
  require_once ('models/merchant/admin.php');

  class ControlController {
      
    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = new User($username, $password);
        $boolean = $user->login('account');
        if ($boolean) {
            $_SESSION['username'] = $username;
            require_once('views/pages/index.php');
            //TODO: Create account
        } else {
            $boolean = $user->login('admin');
            if ($boolean) {
                $_SESSION['username'] = $username;
                require_once('views/pages/index.php');
                //TODO: Create admin
            } else {
                require_once('views/pages/login.php');
                echo '<script>alert(\'Incorrect username or password\')</script>';
            }
        }
    }
      
    public function signup(){
        require_once('views/pages/signup.php');
    }
  }
?>