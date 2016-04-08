<?php include 'views/header.php';?>

<link rel="stylesheet" type="text/css" href="css/style.css">

<div style="margin: 0 auto;">
<h2 style= "float:center">Your Account</h2>
 <div class="accountsection">
    <form name="yourAccount" method = "post">
    <TABLE width= 500px class= "accountTable">
        <th> <h3>Settings</h3> </th>
            <tr>
                <td width=50%>
                Change Your Password:
                </td>
                   
                <td width=50%> 
                   <button type ="button" id="resetPword" onclick="location.href='reset.php'">Reset Password</button> 
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

        
        <td width=50%>  <button type ="button" id="chahgeBillingLink" onclick="location.href='changeshipping.html'">Change Billing Address</button> </td>
       </tr> 
       <tr>
        <td width=50%>
            
        </td>

        
        <td width=50%>  </td>
       </tr>
    </TABLE>
    </div>
 </div>
   

   <?php include 'footer.php';
