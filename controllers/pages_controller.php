<?php
  class PagesController {
    public function index() {
      require_once('views/pages/index.php');
    }

    public function error() {
      require_once('views/pages/error.php');
    }
      
      
    public function cart(){
        require_once('views/pages/cart.php');
    }
      
    public function shop(){
        require_once('views/pages/shop.php');
    }
      
    public function checkout(){
        require_once('views/pages/checkout.php');
    }
      
    public function contact(){
        require_once('views/pages/contact.php');
    }
      
    public function about(){
        require_once('views/pages/about.php');
    }
  }
?>