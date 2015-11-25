<?php 

/**
* 
*/
class Catalog 
{
	public $items = array();
	public $orders=array();
	 function __construct(){
    	
    
    	$this->items = [];
    	$this->orders=[];
    }
	
	
	public function getImage($id,$database){
		$sql = "SELECT * FROM Product WHERE ID=${id}";
		$query = $database->prepare( $sql );
		$query->execute();
		$results = $query->fetchAll( PDO::FETCH_ASSOC );
		foreach( $results as $row ){		  
		echo $row['Picture'];}
	}

	public function getName($id,$database){
		$sql = "SELECT * FROM Product WHERE ID=${id}";
		$query = $database->prepare( $sql );
		$query->execute();
		$results = $query->fetchAll( PDO::FETCH_ASSOC );
		foreach( $results as $row ){		  
		echo $row['Name'];}
	}
	public function getPrice($id,$database){
		$sql = "SELECT * FROM Product WHERE ID=${id}";
		$query = $database->prepare( $sql );
		$query->execute();
		$results = $query->fetchAll( PDO::FETCH_ASSOC );
		foreach( $results as $row ){		  
		echo $row['Price'];}
	}
	public function getDesc($id,$database){
		$sql = "SELECT * FROM Product WHERE ID=${id}";
		$query = $database->prepare( $sql );
		$query->execute();
		$results = $query->fetchAll( PDO::FETCH_ASSOC );
		foreach( $results as $row ){		  
		echo $row['Description'];}
	}
	public function makeOrder($database,$Product,$User,$amount,$quantity,$isReady)
	{
		$b = $database->prepare("INSERT INTO orders (Product,User,amount,quantity,isReady) VALUES (:Product,:User,:amount,:quantity,:isReady)");
        $b->execute(array(
                        ':Product'=>$Product,
                        ':User'=>$User,
                        ':amount'=>$amount,
                        ':quantity'=>$quantity,
                        ':isReady'=>$isReady));
                                             

	}
	// public function getAmount($database,$id)
	// {
	// 	$prodAmount=$database->prepare("SELECT FROM product WHERE ID=:Id")
	// 	$prodAmount->execute(array('ID'=> : $id));
	// 	$amount=$prodAmount->fetch();
	// 	return $amount['Quantity'];

		
	// }






}

?>