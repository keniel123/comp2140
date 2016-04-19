<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Add a New Payment Method below</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <?php
                if (isset($_SESSION['payment'])){
                    echo '<h1>Warning: This will overwrite your previous payment method!</h1><br><br>';
                }
                ?>
                <div class="product-content-right">
                    <div class="woocommerce">
                        
                        <!--== FORM START ==-->
                        
                        <form action="?controller=control&action=addpayment" method="post" id="addpaymentform">
                            
                            <!--== CHOOSE PAYMENT TYPE ==-->
                            <div id="payment">
                                <ul class="payment_methods methods">
                                    <h2>Select Payment Type</h2>
                                    <li class="payment_method_bacs">
                                        <input type="radio" data-order_button_text="" 
                                               checked="checked" value="bankaccount" 
                                               name="payment_method" class="input-radio" id="payment_method_bacs">
                                        <label for="payment_method_bacs">Bank Account </label>
                                        <div class="payment_box payment_method_bacs">
                                            <!--p>Make your payment directly into our bank account. 
                                                Please use your Order ID as the payment reference. 
                                                Your order won’t be shipped until the funds have cleared in our account.</p-->
                                        </div>
                                    </li>
                                    <li class="payment_method_cheque">
                                        <input type="radio" data-order_button_text="" 
                                               value="creditcard" name="payment_method" class="input-radio" 
                                               id="payment_method_cheque">
                                        <label for="payment_method_cheque">Credit Card</label>
                                    </li>
                                    <li class="payment_method_paypal">
                                        <input type="radio" data-order_button_text="Proceed to PayPal" 
                                               value="paypal" name="payment_method" class="input-radio" 
                                               id="payment_method_paypal">
                                        <label for="payment_method_paypal">PayPal
                                            <!--img alt="PayPal Acceptance Mark"
                                                 src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png">
                                            <a title="What is PayPal?"
                                               onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup',
                                                        'WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no,
                                                        scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"
                                               class="about_paypal" href="https://www.paypal.com/gb/webapps/mpp/paypal-popup">What is PayPal
</a!-->
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            
                            <!--== BANK ACCOUNT FORM ==-->
                            
                            <div id="bankaccount">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input class="form-control" name="bankname">
                                </div>
                                <div class="form-group">
                                    <label>Account Type</label>
                                    <input class="form-control" name="accounttype">
                                </div>
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input class="form-control" name="accountnumber">
                                </div>
                                <div class="form-group">
                                    <label>Billing Address</label>
                                    <input class="form-control" name="streetaddress" placeholder="Street Address">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input class="form-control" name="city" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input class="form-control" name="parish" placeholder="Parish">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input class="form-control" name="postalcode" placeholder="Postal Code">
                                </div>
                            </div>
                            
                            <!--== CREDIT CARD FORM ==-->
                            
                            <div id="credit card" hidden="true">
                                <div class="form-group">
                                    <label>Card Type</label>
                                    <input class="form-control" name="cctype" placeholder="E.g. Visa">
                                </div>
                                <div class="form-group">
                                    <label>Card Number</label>
                                    <input class="form-control" name="ccnumber" type="number" 
                                           placeholder="XXXX-XXXX-XXXX-XXXX">
                                </div>
                                <div class="form-group">
                                    <label>CVC</label>
                                    <input class="form-control" name="cvc" type="number" placeholder="XXX">
                                </div>
                                <div class="form-group">
                                    <label>Expire Date</label>
                                    <input class="form-control" name="ccexpiry" placeholder="MM/YY">
                                </div>
                                <div class="form-group">
                                    <label>Name on Card</label>
                                    <input class="form-control" name="cccardholder" placeholder="E.g. John Doe">
                                </div>
                                <div class="form-group">
                                    <label>Billing Address</label>
                                    <input class="form-control" name="ccstreetaddress" placeholder="Street Address">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input class="form-control" name="cccity" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input class="form-control" name="ccparish" placeholder="Parish">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input class="form-control" name="ccpostalcode" placeholder="Postal Code">
                                </div>
                            </div>
                            
                            <!--== PAYPAL FORM ==-->
                            
                            <div id="paypal" hidden="true">
                                <div class="form-group">
                                    <label>PayPal Email</label>
                                    <input class="form-control" name="paypalemail" placeholder="someone@example.com">
                                </div>
                                <div class="form-group">
                                    <label>PayPal Password</label>
                                    <input class="form-control" name="paypalpassword" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" data-value="Add" value="Add" 
                                           id="placeOrder" name="Add" class="button alt">
                            </div>
                        </form>
                        
                        <!--== FORM END ==-->
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div>
</div>
