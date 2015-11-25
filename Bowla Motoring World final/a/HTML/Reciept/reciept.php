<?php 

/**
* 
*/
class Reciept
	
	function __construct($products,$customer,$price)
	{
		$this->products=$products;
		$this->customer=$customer;
		$this->price=$price;
	}


	public function produceReceipt($customer,$date,$price,$product)
	{
		echo "This is yoyr Reciept";
		
	}
}














?>