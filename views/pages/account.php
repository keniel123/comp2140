<div style="margin-bottom: 10%;">
 <div class="accountsection">
     <h1 style= "float:center">Your Account</h1>
     <div class="table-responsive" id="account-table">
         <table class="table">

             <tbody>
                 <?php 
                    $account = $_SESSION['account'];
                    $username = $account->getUsername();
                    $firstname = $account->getFirstName();
                    $lastname = $account->getLastName();
                    $phone = $account->getPhoneNumber();
                    $street = $account->getShippingAddress()->getStreetAddress();
                    $city = $account->getShippingAddress()->getCity();
                    $parish = $account->getShippingAddress()->getParish();
                    $postal = $account->getShippingAddress()->getPostalCode();
                    $tr = '<tr>';
                    $trc = '</tr>';
                    $td = '<td>';
                    $tdc = '</td>';
                 
                    $line_1 = $tr . $td . 'Name' . $tdc . $td . $firstname . ' ' . $lastname . $tdc . $trc;
                    $line_2 = $tr . $td . 'Username' . $tdc . $td . $username . $tdc . $trc;
                    $line_3 = $tr . $td . 'Phone' . $tdc . $td . $phone . $tdc . $trc;
                    $line_4 = $tr . $td . 'Shipping Address' . $tdc . $td . $street . $tdc . $trc;
                    $line_5 = $tr . $td . '' . $tdc . $td . $city . $tdc . $trc;
                    $line_6 = $tr . $td . '' . $tdc . $td . $parish . $tdc . $trc;
                    $line_7 = $tr . $td . '' . $tdc . $td . $postal . $tdc . $trc;
                 
                    echo $line_1 . $line_2 . $line_3 . $line_4 . $line_5 . $line_6 . $line_7;
                 ?>
                 <tr>
                     <td>Payment Method</td>
                     <td><?php
                            if (isset($_SESSION['payment'])){
                                $tr = '<tr>';
                                $trc = '</tr>';
                                $td = '<td>';
                                $tdc = '</td>';
                                $type = $_SESSION['paymenttype'];
                                $account = $_SESSION['account'];
                                switch($type){
                                    case 'cc':
                                        echo 'Credit Card<a href="?controller=pages&action=addpayment"> change</a>' . $tdc . $trc;
                                        $num = $account->getPaymentMethod()->getCardNumber();
                                        $b_address1 = $account->getPaymentMethod()->getBillingAddress()->getStreetAddress();
                                        $b_address2 = $account->getPaymentMethod()->getBillingAddress()->getCity();
                                        $b_address3 = $account->getPaymentMethod()->getBillingAddress()->getParish();
                                        $b_address4 = $account->getPaymentMethod()->getBillingAddress()->getPostalCode();
                                        $cardholder = $account->getPaymentMethod()->getCardHolder();
                                        echo $tr . $td . 'Card Number' . $tdc . $td . 'XXXX-XXXX-XXXX-' . substr($num, 12) . $tdc . $trc;
                                        echo $tr . $td . 'Cardholder' . $tdc . $td . $cardholder . $tdc . $trc;
                                        echo $tr . $td . 'Billing Address' . $tdc . $td . $b_address1 . $tdc . $trc;
                                        echo $tr . $td . '' . $tdc . $td . $b_address2 . $tdc . $trc;
                                        echo $tr . $td . '' . $tdc . $td . $b_address3 . $tdc . $trc;
                                        echo $tr . $td . '' . $tdc . $td . $b_address4;
                                        break;
                                    case 'ba':
                                        echo 'Bank Account<a href="?controller=pages&action=addpayment"> change</a>' . $tdc . $trc;
                                        $num = $account->getPaymentMethod()->getAccountNumber();
                                        $batype = $account->getPaymentMethod()->getAccountType();
                                        $bname = $account->getPaymentMethod()->getBank();
                                        echo $tr . $td . 'Account Number' . $tdc . $td . $num . $tdc . $trc;
                                        echo $tr . $td . 'Account Type' . $tdc . $td . $batype . $tdc . $trc;
                                        echo $tr . $td . 'Bank' . $tdc . $td . $bname;
                                        break;
                                    case 'pp':
                                        echo 'PayPal<a href="?controller=pages&action=addpayment"> change</a>' . $tdc . $trc;
                                        $ppemail = $account->getPaymentMethod()->getEmail();
                                        echo $tr . $td . 'PayPal Email' . $tdc . $td . $ppemail;
                                        break;
                                }
                            } else {
                                $add_payment = "Add a payment method  <a href='?controller=pages&action=addpayment'>here</a>";
                                echo $add_payment;
                            }
                         ?></td>
                 </tr>
             </tbody>
         </table>
         <button class="btn btn-primary" type="button" style="width: 25%;" 
                 onclick="location.href='?controller=pages&action=form'">Edit</button>
     </div>
    </div>
</div>