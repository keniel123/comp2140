<?php

  class PagesController {
      
    public function index() {
      require_once('views/pages/index.php');
    }
      
    public function admin() {
      if (isset($_SESSION['account'])) {
          if ($_SESSION['username'] == 'admin'){
            require_once('views/pages/admin.php');
          } else{
              echo '<script>alert(\'Restricted area\');
            window.location.href = "?controller=pages&action=index";</script>';
          }
        } else {
            require_once('views/pages/login.php');
        }
    }

    public function error() {
      require_once('views/pages/error.php');
    }
      
    public function cart(){
        if (isset($_SESSION['account'])) {
            require_once('views/pages/cart.php');
        } else {
            require_once('views/pages/login.php');
        }
    }
      
    public function shop(){
        require_once('views/pages/shop.php');
    }
      
    public function checkout(){
        if (isset($_SESSION['account'])) {
            require_once('views/pages/checkout.php');
        } else {
            require_once('views/pages/login.php');
        }
    }
      
    public function contact(){
        require_once('views/pages/contact.php');
    }
      
    public function about(){
        require_once('views/pages/about.php');
    }
      
    public function login(){
        if (isset($_SESSION['account'])) {
            echo '<script>window.location.href = "?controller=pages&action=index";</script>';
        } else {
            require_once('views/pages/login.php');
            if (isset($_SESSION['incorrect'])){
                unset($_SESSION[incorrect]);
                echo '<script>alert(\'Incorrect username or password\');</script>';
            }
        }
    }
      
    public function signup(){
        if (isset($_SESSION['account'])) {
            echo '<script>alert(\'You already have an account.\n Please log out first\');
            window.location.href = "?controller=pages&action=account";</script>';
        } else {
            $_SESSION['frompages'] = 'yes';
            require_once('views/pages/signup.php');
        }
    }
      
    public function form(){
        if (isset($_SESSION['account'])) {
            $_SESSION['fromaccount'] = 'yes';
            require_once('views/pages/form.php');
        } else {
            echo '<script>window.location.href = "?controller=pages&action=login";</script>';
        }
    }
      
    public function account(){
        if (isset($_SESSION['account'])) {
            require_once('views/pages/account.php');
        } else {
            require_once('views/pages/login.php');
        }
    }
      
    public function reset(){
        require_once('views/pages/reset.php');
    }
      
    public function addpayment(){
        if (isset($_SESSION['account'])) {
            $_SESSION['fromaccount'] = 'yes';
            require_once('views/pages/addpayment.php');
        } else {
            require_once('views/pages/login.php');
        }
    }
      
    public function addpaymentc(){
        if (isset($_SESSION['account'])) {
            $_SESSION['fromcheckout'] = 'yes';
            require_once('views/pages/addpayment.php');
        } else {
            require_once('views/pages/login.php');
        }
    }
      
    public function singleproduct(){
        require_once('views/pages/single-product.php');
    }
      
    public function terms(){
        require_once('views/pages/terms.php');
    }
      
    public function privacy(){
        require_once('views/pages/privacy.php');
    }    
      
    public function orders(){
        if(isset($_SESSION['account'])){
        require_once('views/pages/orders.php');
        }
        else{
            echo '<script>window.location.href="?controller=pages&action=login"</script>';
        }
    }
  }
?>
