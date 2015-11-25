<?php
include_once '../../../user.php';
class Admin extends User {



public function getAllProducts($database){
	$currency="$";
if(isset($_SESSION['msgsucc'])){
  echo "<label style='color:orange; font-weight:bold;'>".$_SESSION['msgsucc']."</label>";
  unset($_SESSION['msgsucc']);
}



echo "<h1>Products</h1>";
echo"<button class='buy_now_button' style='float:right' onclick='addproduct()''>New Product</button>";
   echo" <div class='products' style='width:100%'>";
   
    //current URL of the Page. cart_update.php redirects back to this URL
  $current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    
  $results = $database->prepare("SELECT * FROM product ORDER BY ID ASC");
    $results->execute();
    $a=$results->fetchAll(PDO::FETCH_OBJ);
    if ($a) { 
      echo "<table id='example2' class='table table-bordered table-hover'>";
 
     echo "<thead>";
  echo "<tr>";
  echo '<th style="text-align: center";><u>Picture</u></th>';
  echo '<th style="text-align: center";><u>Name</u></th>';
   echo '<th style="text-align: center";><u>Description</u></th>';
    echo '<th style="text-align: center";><u>Price</u></th>';
    echo '<th style="text-align: center";><u>Quantity</u></th>';
  echo '<th style="text-align: center";><u>Action</u></th>';
  echo "</tr>";
  echo "</thead>";
  echo "<tbody";
  
  
        //fetch results set as object and output HTML
        foreach ($a as $a) {
            
           echo "<tr>";
       echo '<td><div class="product-thumb"><img width="145" height="145" src='.$a->Picture.'></div></td>';
      
       echo '<td><h3>'.$a->Name.'</h3>';
         
         echo '<td>'.$a->Description.'</td>';
         echo '<td>'.$a->Price.'</td>';
         echo '<td>'.$a->Quantity.'</td>';
         echo "<td>";
         echo '<button style="width:54px" class="buy_now_button" onclick="editproduct('. $a->ID .')" >Edit</button>';

         echo  '<form action="products.php" method="post" name="pro" id="pro">';
         echo '<input type="hidden" name="proid" value="'.$a->ID.'" />';
         echo '<input type="submit" class="buy_now_button" name="delete" value="Delete" onclick="return confirm(\'Are you sure to delete this product?\')" /></form>';
        echo" </td>";
         echo '</tr>';
          
       
     
}}}

public function removeProduct($database,$id){
	if(isset($_POST['delete'])){ 
  $del =$database->prepare("DELETE FROM product WHERE ID=".(int)$id);
  $del->execute();
  }

}

public function viewClients($database){
  $j = $database->prepare("SELECT * FROM members");
$j->execute(); //print_r($result); exit();
$result=$j->fetchAll(PDO::FETCH_OBJ);
$num = 1;

if($result){
  echo " <table id='example2' class='table table-bordered table-hover'>";
  echo "<thead>";
  echo "<tr>";
  echo '<th style="text-align: center";><u>#No.</u></th>';
  echo '<th style="text-align: center";><u>Username</u></th>';
  echo '<th style="text-align: center";><u>Email</u></th>';
  echo "</tr>";
  echo "</thead>";
  echo "<tbody";
  foreach ($result as $result ) {
  
    if($num%2 == 0){

      

    echo "<tr style='background-color:gold; color: #000'>";
    } else {
    echo "<tr style='background-color:#F2F2F2; color: #000'>";  
    }
      echo "<td style='text-align:center'>". $num . "</td>";
      echo "<td style='text-align:center'>". $result->username . "</td>";
      echo "<td style='text-align:center'>". $result->email . "</td>";
    echo "<td style='text-align:center'><a href='viewclient.php?id=". $result->memberID ."'><button style='background-color:green; color:#fff; cursor:pointer'>View</button></a></td>";
    echo "</tr>"; 
  $num++;
  }
  echo "</table>";
} else {
  echo "Horray! Clients Yet"; 
  }

}
public function salesList($database){
  $total_price = 0;
$sql = $database->prepare("SELECT * FROM sales INNER JOIN members ON sales.order_by = members.memberID ORDER BY sales.id");
 $sql->execute();
$rows = $sql->fetchAll(PDO::FETCH_OBJ);
if($rows){
foreach ($rows as $rows) {
echo "<div style='color: #000000'><span><strong>Order ID</strong>:&nbsp;".$rows->id.'</span>&nbsp;|&nbsp;&nbsp;';
echo "<span><strong>Order Date</strong>:&nbsp;".$rows->order_date.'</span>&nbsp;|&nbsp;&nbsp;';
echo "<span><strong>Ordered By</strong>:&nbsp;".$rows->username.'</span>&nbsp;|&nbsp;&nbsp;';
echo "<span><strong>Total Price</strong>:&nbsp;".$rows->total_price.'</span>&nbsp;</div>';
$total_price = $total_price + $rows->total_price;

//$query = "SELECT * FROM orders LEFT JOIN products ON orders.product_code = products.product_code WHERE orders.sale_id = ". (int)$rows->id;

//$result = $db->prepare(); //print_r($result); exit();
$result=$database->prepare("SELECT * FROM orders LEFT JOIN product ON orders.product_code = product.ID WHERE orders.sale_id = ".(int)$rows->id);
$result->execute();
$row = $result->fetchAll(PDO::FETCH_OBJ);
$num = 1;

if($result){
  echo "<table style='border:1px solid #000000; padding:6px;margin-bottom:12px; width:100%; text-align:center'>";
  echo "<tr><th><u>#Item No.</u></th>";
  echo "<th><u>Product Code</u></th>";
  echo "<th><u>Product Name</u></th>";
  echo "<th><u>Product Price</u></th>";
  echo "<th><u>Sale Quantity</u></th>";
  echo "<th><u>Sub-total</u></th>";
  echo "</tr>";
  
  foreach ($row as $row ) {
    echo "<tr>";
      echo "<td>". $num . "</td>";
      echo "<td>". $row->product_code . "</td>";
      echo "<td>". $row->product_name . "</td>";
      echo "<td>". $row->price . "</td>";
      echo "<td>". $row->quantity  . "</td>";
      echo "<td>". $row->price * $row->quantity . "</td>";
    echo "</tr>"; 
  $num++;
  }
  echo "</table>";
}
echo "<hr/>"; 
}
  echo "<h3 style='text-align:right'>Total Sales - ". $total_price ."</h3>";  
} else {
  echo "Horray! No Sales Yet"; 
  }
}
public function addProduct($database,$name,$description,$picture,$quantity,$price)
{

    $p =$database->prepare('INSERT INTO product (Name,Description,Picture,Price,Quantity) VALUES (:Name,:Description,:Picture,:Price,:Quantity)');
    $p->execute(array(
        ':Name' => $name ,
        ':Description' => $description,
        ':Picture' => $picture,
        ':Price' => $price,
        ':Quantity'=>$quantity

      ));
  
}

public function getComplaints()
{
  echo"I am a complaint";
}

public function getMostPopular($salesList)
{
  echo "I am the most popular product ";
}

public function getSold($database)
{
  $Array=[];
  return $Array;
}

}
?>