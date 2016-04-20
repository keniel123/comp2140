<?php $account = $_SESSION['account']; $shippingAddress = $account->getShippingAddress(); ?>
<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                </div>
                
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">

                            

                            <div class="woocommerce-info">Have a coupon? <a class="showcoupon" data-toggle="collapse" href="#coupon-collapse-wrap" aria-expanded="false" aria-controls="coupon-collapse-wrap">Click here to enter your code</a>
                            </div>

                            <form id="coupon-collapse-wrap" method="post" class="checkout_coupon collapse" action="#">

                                <p class="form-row form-row-first">
                                    <input type="text" value="" id="coupon_code" placeholder="Coupon code" class="input-text" name="coupon_code">
                                </p>

                                <p class="form-row form-row-last">
                                    <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                                </p>

                                <div class="clear"></div>
                            </form><br>
                                <h3 id="order_review_heading">Your order details</h3><br>

                                <div id="order_review" style="position: relative;" class="table">
                                    <table class="shop_table">
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount"><?php echo '$' . $account->getCart()->getTotal() . '.00'; ?></span>
                                                </td>
                                            </tr>
                                            <tr class="shipping">
                                                <th>Shipping and Handling</th>
                                                <td>Free Shipping</td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount"><?php echo '$' . $account->getCart()->getTotal() . '.00'; ?>
                                                    </span></strong> </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Shipping Address</th>
                                                <td><?php echo $shippingAddress->getStreetAddress(); ?></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th></th>
                                                <td><?php echo $shippingAddress->getCity(); ?></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th></th>
                                                <td><?php echo $shippingAddress->getParish(); ?></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th></th>
                                                <td><?php echo $shippingAddress->getPostalCode(); ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                        </div>
                        <div id="payment">
                                        <?php
                                            $p = '<p>';
                                            $pc = '</p>';
                                            $h3 = '<h2>';
                                            $h3c = '</h2>';
                                            $cart = $account->getCart();
                                            if(isset($_SESSION['payment'])){
                                                if(count($cart->getItems()) < 1){
                                                echo $h3 . 'You have no items in your cart. 
                                                Add some <a href="?controller=pages&action=shop">here</a>' . $h3c;
                                                } 
                                                else{
                                                    switch($_SESSION['paymenttype']){
                                                        case 'ba':
                                                            $type = 'Bank Account';
                                                            break;
                                                        case 'cc':
                                                            $type = 'Credit Card';
                                                            break;
                                                        case 'pp':
                                                            $type = 'PayPal';
                                                            break;
                                                    }
                                                    echo $p . 'Your Payment Method: ' . $type . $pc;
                                                    echo $p . '<a href="?controller=pages&action=addpayment">Change</a>' . $pc;
                                                    echo '<div class="form-row place-order">
                                                    <form method="post" action="?controller=control&action=checkout">
                                                    <input type="submit" data-value="Place order" value="Place order" id="placeOrder"
                                                    name="placeOrder" class="button alt"></form></div>';
                                                }
                                            }
                                            else {
                                                echo $h3 . 'Add a payment method <a href="?controller=pages&action=addpaymentc">here</a>' . $h3c;
                                            }
                                        ?>
                                    </div>

                        </div>                       
                    </div>                    
                </div>
            </div>
        </div>
    </div>