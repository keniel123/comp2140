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
                                echo $type . $tdc . $trc;
                                switch($type){
                                    case 'cc':
                                        $num = $account->getPaymentMethod()->getCardNumber();
                                        $b_address1 = $account->getPaymentMethod()->getBillingAddress()->getStreetAddress();
                                        $b_address2 = $account->getPaymentMethod()->getBillingAddress()->getCity();
                                        $b_address3 = $account->getPaymentMethod()->getBillingAddress()->getParish();
                                        $b_address4 = $account->getPaymentMethod()->getBillingAddress()->getPostalCode();
                                        $cardholder = $account->getPaymentMethod()->getCardHolder();
                                        echo $tr . $td . 'Card Number' . $tdc . $td . $num . $tdc . $trc;
                                        echo $tr . $td . 'Cardholder' . $tdc . $td . $cardholder . $tdc . $trc;
                                        echo $tr . $td . 'Billing Address' . $tdc . $td . $b_address1 . $tdc . $trc;
                                        echo $tr . $td . '' . $tdc . $td . $b_address2 . $tdc . $trc;
                                        echo $tr . $td . '' . $tdc . $td . $b_address3 . $tdc . $trc;
                                        echo $tr . $td . '' . $tdc . $td . $b_address4;
                                        break;
                                    case 'ba':
                                        $num = $account->getPaymentMethod()->getAccountNumber();
                                        $batype = $account->getPaymentMethod()->getAccountType();
                                        $bname = $account->getPaymentMethod()->getBank();
                                        echo $tr . $td . 'Account Number' . $tdc . $td . $num . $tdc . $trc;
                                        echo $tr . $td . 'Account Type' . $tdc . $td . $batype . $tdc . $trc;
                                        echo $tr . $td . 'Bank' . $tdc . $td . $bname;
                                        break;
                                    case 'pp':
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
     
     
     
     
     
     
     
     
     
     
     
     
     
    <!--form name="yourAccount" method = "post">
    <TABLE width= 500px class= "accountTable">
        <th> <h3>Settings</h3> </th>
            <tr>
                <td width=50%>
                Change Your Password:
                </td>
                   
                <td width=50%> 
                   <button class="btn btn-danger" type ="button" 
                id="resetPword" onclick="location.href='?controller=pages&action=reset'">Reset Password</button> 
                </td>
            </tr>
            <tr>
                <td width=50%> 
               Change Your Email Address: 
                 </td>   
             
    
                <td width=50%>
                     <input type ="text" name="changeEmail" placeholder="address@example.com"  class = "accountSettings" >
                </td>
            </tr>
           
    </TABLE>
    <input type="submit" value="Submit  Changes">
    </form>

</div>
    <div class="accountsection">
        <TABLE width= 500px>
        <th> <h3>Orders</h3> </th>
        <tr>
        <td width=50%>
          <a href="cart.php"> View orders </a>
        </td>

        
        <td width=50%>  </td>
       </tr>
       <tr>
        <td width=50%>
          <a href="#">Cancel orders </a>
        </td>

        
        <td width=50%>  </td>
       </tr>
        <tr>
        <td width=50%>
            To Change your billing address: 
        </td>

        
        <td width=50%>  <button class="btn btn-success" type ="button" id="chahgeBillingLink"
        onclick="location.href='?controller=pages&action=changeshipping'">Change Billing Address</button> </td>
       </tr> 
       <tr>
        <td width=50%>
            
        </td>

        
        <td width=50%>  </td>
       </tr>
    </TABLE-->
    </div>
 </div>