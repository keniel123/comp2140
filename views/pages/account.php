<div style="margin-bottom: 10%;">
 <div class="accountsection">
     <h1 style= "float:center">Your Account</h1>
     <div class="table-responsive" id="account-table">
         <table class="table">

             <tbody>
                 <tr>
                     <td>Name</td>
                     <td><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></td>
                 </tr>
                 <tr>
                     <td>Username</td>
                     <td><?php echo $_SESSION['username']; ?></td>
                 </tr>
                 <tr>
                     <td>Phone</td>
                     <td><?php echo $_SESSION['phonenumber']; ?></td>
                 </tr>
                 <tr>
                     <td>Shipping Address</td>
                     <td><?php echo $_SESSION['streetaddress']; ?></td>
                 </tr>
                 <tr>
                     <td></td>
                     <td><?php echo $_SESSION['city']; ?></td>
                 </tr>
                 <tr>
                     <td></td>
                     <td><?php echo $_SESSION['parish']; ?></td>
                 </tr>
                 <tr>
                     <td></td>
                     <td><?php echo $_SESSION['postalcode']; ?></td>
                 </tr>
                 <tr>
                     <td>Payment Method</td>
                     <td><?php 
                            if (isset($_SESSION['payment'])){
                                $tr = '<tr>';
                                $trc = '</tr>';
                                $td = '<td>';
                                $tdc = '</td>';
                                $type = $_SESSION['paymenttype'];
                                echo $type . $tdc . $trc;
                                switch($type){
                                    case 'cc':
                                        $num = $_SESSION['ccnumber'];
                                        $b_address1 = $_SESSION['billingaddressstreet'];
                                        $b_address2 = $_SESSION['city'];
                                        $b_address3 = $_SESSION['parish'];
                                        $b_address4 = $_SESSION['postalcode'];
                                        $cardholder = $_SESSION['cardholder'];
                                        echo $tr . $td . 'Card Number' . $tdc . $td . $num . $tdc . $trc;
                                        echo $tr . $td . 'Cardholder' . $tdc . $td . $cardholder . $tdc . $trc;
                                        echo $tr . $td . 'Billing Address' . $tdc . $td . $b_address1 . $tdc . $trc;
                                        echo $tr . $td . '' . $tdc . $td . $b_address2 . $tdc . $trc;
                                        echo $tr . $td . '' . $tdc . $td . $b_address3 . $tdc . $trc;
                                        echo $tr . $td . '' . $tdc . $td . $b_address4;
                                        break;
                                    case 'ba':
                                        $num = $_SESSION['accnumber'];
                                        $batype = $_SESSION['acctype'];
                                        $bname = $_SESSION['bankname'];
                                        echo $tr . $td . 'Account Number' . $tdc . $td . $num . $tdc . $trc;
                                        echo $tr . $td . 'Account Type' . $tdc . $td . $batype . $tdc . $trc;
                                        echo $tr . $td . 'Bank' . $tdc . $td . $bname;
                                        break;
                                    case 'pp':
                                        $ppemail = $_SESSION['paypalemail'];
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