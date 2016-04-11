<?php
  require_once('models/control/database.php');
  require_once ('models/merchant/user.php');
  require_once ('models/merchant/account.php');
  require_once ('models/merchant/address.php');
  require_once ('models/merchant/admin.php');
require_once ('models/transaction/product.php');
  require_once ('models/transaction/cart.php');
require_once ('models/transaction/order.php');
require_once ('models/payment/paymentmethod.php');
require_once ('models/payment/creditcard.php');
require_once ('models/payment/bankaccount.php');
require_once ('models/payment/paypal.php');
  session_start();
  if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
  } else {
    $controller = 'pages';
    $action     = 'index';
  }

  require_once('views/layout.php');

?>