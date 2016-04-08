<?php
include 'config.php';
date_default_timezone_set('UTC');


		$results = $db->prepare("SELECT * FROM members WHERE memberID = ". (int)$_GET['id']);
		$results->execute();
		$s= $results->fetchAll(PDO::FETCH_OBJ);
		if ($s) { 
			foreach ($s as $s) {
				echo '<div>'; 
				echo '<span><strong>Name</strong>:&nbsp;'.ucfirst($s->username).'</span>&nbsp;|&nbsp;&nbsp;';
				echo '<span><strong>Email</strong>:&nbsp;'.$s->email.'</span>&nbsp;|&nbsp;&nbsp;';
				echo '</div><hr/>';
			}
			}
			
	?>
    
    <h1>My Orders</h1>
    <?php
	$sql = $db->prepare("SELECT * FROM members INNER JOIN orders ON orders.user = members.memberID WHERE members.memberID = ". (int)$_GET['id']);
	$sql->execute();
	$y= $sql->fetchAll(PDO::FETCH_OBJ);
	if($y){
		foreach ($y as $y) {
			echo '<form id="order'.$y->memberID.'" action="viewclient.php?id='. $_GET['id'] .'" method="post" style="text-align:right">';
		echo "<div style='color: #fff'><span><strong>Order ID</strong>:&nbsp;".$y->memberID.'</span>&nbsp;|&nbsp;&nbsp;';
	
		}}
		
		
	?>
	<form method="post" action=""></form>
		<select name="status">
			<option value="default">Select </option>
			<option value='0' name="pending">Pending</option>
			<option value='1' name="confirm">Confirmed</option>
		</select>
	</form>
        
        </div>
	<?php
		$query =$db->prepare("SELECT * FROM orders WHERE User =  ". (int)$_GET['id']);
		$query->execute();
		$t= $query->fetchAll(PDO::FETCH_OBJ);
		$num = 1;
		$total=0;
		if($t){
			echo "<table style='border:1px solid #fff; padding:6px; margin-bottom:12px; width:100%; text-align:center;' >";
			echo "<tr style='color:green'><th><u>#Item No.</u></th>";
			echo "<th><u>Order Id</u></th>";
			echo "<th><u>Product Name</u></th>";
			echo "<th><u>Product Price</u></th>";
			echo "<th><u>Sale Quantity</u></th>";
			echo "<th><u>Sub-total</u></th>";
			echo "</tr>";
			foreach ($t as $t) {
				echo "<tr>";
				echo "<td>". $num . "</td>";
				echo "<td>". $t->orderID . "</td>";
				echo "<td>". $t->Product . "</td>";
				echo "<td>". $t->amount . "</td>";
				echo "<td>". $t->quantity . "</td>";
				echo "<td>". $t->quantity*$t->amount . "</td>";
				echo "</tr>";
				$num++;
				$total+=$t->quantity*$t->amount;
			} 
					
			
			}
			echo "</table>";
			echo "</form>";
			echo "<input type=submit name=submit value=Submit></input>";
			$confirm=1;
			if (isset($_POST['submit']) AND $_POST['status']==1 ) {
				$ord=$db->prepare("UPDATE orders SET isReady = 1 WHERE User=".(int)$_GET['id']);
				$ord->execute(array(
					':isReady'=>$confirm
					));
			$sale=$db->prepare("INSERT INTO sales (total_price,order_date,order_by) VALUES (:total_price,:order_date,:order_by)");
			$sale->execute(array(
        		':total_price' => $total,
        		':order_date' => date('DATE_RFC2822'),
        		':order_by' =>(int)$_GET['id']
        		));

			$or=$db->prepare("DELETE FROM orders WHERE User=".(int)$_GET['id'] );
			$or->execute();
			}

			

			?>
    
			
	
	
    <div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->
    


