<div style="margin-bottom: 10%;">
 <div class="accountsection">
     <h1 style= "float:center">View your orders below</h1>
     <br>
     <div class="table-responsive" id="account-table">
         <?php 
         $account = $_SESSION['account'];
         $orders = $account->getOrders();
         if(count($orders) < 1){
             echo '<h4>You have made no orders yet.
             Let\'s go <a href="?controller=pages&action=shop">shopping</a></h4>';
         }
         else{
             $count = 0;
             $br = '<br>';
             foreach($orders as $order){
                 $count += 1;
                 echo '<h2>Order number </23>' . $count . '</h2>';
                 echo '<h4>Ordered on: ' . $order->getOrderDate() . '</h4>';
                 echo '<h4>Order total: $' . $order->getTotal() . '.00' . '</h4>';
                 if($order->getOrderStatus() == 'U'){
                     echo '<h4>Delivery status: Undelivered' . '</h4>';
                 } 
                 else{
                     echo '<h4>Delivery status: Delivered on ' . $order->getDeliveryDate() . '</h4>';
                 }
                 foreach($order->getItems() as $product){
                     echo '<h4>Product Name: ' . $product->getName() . '</h4>' . ' <h4>Quantity: ' . $product->getQuantity() . '</h4>';
                 }
                 echo $br;
             }
         }
         ?>
     </div>
    </div>
</div>