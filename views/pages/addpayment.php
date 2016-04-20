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
                            
                            <!--== CHOOSE PAYMENT TYPE ==-->
                            <div id="payment">
                                <form>
                                    <ul class="payment_methods methods">
                                        <h2>Select Payment Type</h2>
                                        <li class="payment_method_bacs">
                                            <div class="form-group">
                                            <input name="method" type="radio" data-order_button_text="" 
                                                   checked="checked" value="bankaccount" 
                                                   class="input-radio" id="bank_account_button">
                                            <label>Bank Account </label>
                                            </div>
                                        </li>
                                        <li class="payment_method_cheque">
                                            <div class="form-group">
                                            <input name="method" type="radio" data-order_button_text="" 
                                                   value="creditcard" class="input-radio" 
                                                   id="credit_card_button">
                                            <label>Credit Card</label>
                                            </div>
                                        </li>
                                        <li class="payment_method_paypal">
                                            <div class="form-group">
                                            <input name="method" type="radio" data-order_button_text="Proceed to PayPal" 
                                                   value="paypal" class="input-radio" 
                                                   id="paypal_button">
                                            <label>PayPal</label>
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                            
                            <!--== BANK ACCOUNT FORM ==-->
            
                            <div id="bankaccount">
                                <form action="?controller=control&action=addpayment" method="post" id="bankaccountform">
                                    <input name="payment_method" value="bankaccount" hidden="true">
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input required class="form-control" name="bankname">
                                    </div>
                                    <div class="form-group">
                                        <label>Account Type</label>
                                        <input required class="form-control" name="accounttype">
                                    </div>
                                    <div class="form-group">
                                        <label>Account Number</label>
                                        <input required class="form-control" name="accountnumber">
                                    </div>
                                    <div class="form-group">
                                        <label>Billing Address</label>
                                        <input required class="form-control" name="streetaddress" placeholder="Street Address">
                                    </div>
                                    <div class="form-group">
                                        <label></label>
                                        <input required class="form-control" name="city" placeholder="City">
                                    </div>
                                    <div class="form-group">
                                        <label></label>
                                        <input required class="form-control" name="parish" placeholder="Parish">
                                    </div>
                                    <div class="form-group">
                                        <label></label>
                                        <input required class="form-control" name="postalcode" placeholder="Postal Code">
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="submit" value="add" class="button alt">
                                    </div>
                                </form>
                            </div>
                            
                            <!--== CREDIT CARD FORM ==-->
                            
                            <div id="credit-card">
                                <form action="?controller=control&action=addpayment" method="post" id="credit-cardform">
                                    <input name="payment_method" value="creditcard" hidden="true">
                                    <div class="form-group">
                                        <label>Card Type</label>
                                        <select name="cctype" class="form-control">
                                            <optgroup>
                                                <option value="Visa">Visa</option>
                                                <option value="Mastercard">Mastercard</option>
                                                <option value="AMEX">American Express</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Card Number</label>
                                        <input required class="form-control" name="ccnumber" type="number" 
                                               placeholder="XXXXXXXXXXXXXXXX">
                                    </div>
                                    <div class="form-group">
                                        <label>CVC</label>
                                        <input required class="form-control" name="cvc" type="number" placeholder="XXX">
                                    </div>
                                    <div class="form-group">
                                        <label>Expire Date</label>
                                        <input required class="form-control" name="ccexpiry" placeholder="MM/YY">
                                    </div>
                                    <div class="form-group">
                                        <label>Name on Card</label>
                                        <input required class="form-control" name="cccardholder" placeholder="E.g. John Doe">
                                    </div>
                                    <div class="form-group">
                                        <label>Billing Address</label>
                                        <input required class="form-control" name="ccstreetaddress" placeholder="Street Address">
                                    </div>
                                    <div class="form-group">
                                        <label></label>
                                        <input required class="form-control" name="cccity" placeholder="City">
                                    </div>
                                    <div class="form-group">
                                        <label></label>
                                        <input required class="form-control" name="ccparish" placeholder="Parish">
                                    </div>
                                    <div class="form-group">
                                        <label></label>
                                        <input required class="form-control" name="ccpostalcode" placeholder="Postal Code">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="add" class="button alt">
                                    </div>
                                </form>
                            </div>
                            
                            <!--== PAYPAL FORM ==-->
                            
                            <div id="paypal">
                                <form action="?controller=control&action=addpayment" method="post" id="paypalform">
                                    <input name="payment_method" value="paypal" hidden="true">
                                <div class="form-group">
                                    <label>PayPal Email</label>
                                    <input required class="form-control" name="paypalemail" placeholder="someone@example.com">
                                </div>
                                <div class="form-group">
                                    <label>PayPal Password</label>
                                    <input required class="form-control" name="paypalpassword" type="password">
                                </div>
                                <div class="form-group">
                                        <input type="submit" value="add" class="button alt">
                                    </div>
                                </form>
                            </div>
                        
                        <!--== FORM END ==-->
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div>
</div>