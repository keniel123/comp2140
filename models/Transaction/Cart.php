<?php
require_once('Product.php');
<<<<<<< HEAD
require_once($_SERVER['DOCUMENT_ROOT'].'/models/Control/Database.php');
=======
require_once(realpath('../').'/Control/Database.php');// ;)
>>>>>>> transaction
/**
 *
 */
class Cart
{

    /**
     * @var String
     */
    private $dateCreated;

    /**
     * @var Double
     */
    private $total;

    /**
     * @var List<Product>
     */
    private $items;
    
<<<<<<< HEAD
=======
    /**
     * @var Database Object 
     */
    private $db;
    
>>>>>>> transaction
	/**
	 * @return	void 
	 **/
	public function __construct()
    {
		$this->$dateCreated = getdate();
		$this->$total = 0.00;
		$this->$items = array();
<<<<<<< HEAD
=======
		$db = new Database();
>>>>>>> transaction
    }
    /**
     * @return boolean
     */
    public function checkAvailability(Product $prod, int $qty)//boolean
    {
<<<<<<< HEAD
        $db = new Database();
        if($db->query(
					//select product quantity left
					//too lazy to write this now
					)
					!= false)
		{
			//compare qty with qtyRemaining
			//if enough return true
			return true;
=======
        $query_result = $db->query(
					"SELECT quantity
					 FROM product
					  WHERE productId = '".$prod->$ID."';"
					);
		if ($result != false)
		{
			$row = msql_fetch_array($result);
			if($qty<$row[0])
				return true;
>>>>>>> transaction
		}
		return false;
    }

    /**
     * @return boolean
     */
    public function emptyCart()//boolean
    {
		unset($this->$items);
		$this->$items = array();
		return true;
    }

    /**
     * @param prod			Product object
     * @return boolean
     */
<<<<<<< HEAD
    public function addToCart(Product $prod)//boolean
    {
        if (!checkAvailability($prod))
=======
    public function addToCart(Product $prod, int $amt)//boolean
    {
        if (!checkAvailability($prod, $amt))
>>>>>>> transaction
        {
				return false;
		}
		// if product already in list increase quantity
		foreach($this->$items as $product)
		{
			if($prod->name == $product->name)
			{
				$product->quantity+=$prod->name;
			}
		}
		array_push($this->$items,prod);
		//update total price
		calculateTotal();
		return true;
    }

    /**
     * @param String $itemName
     * @return boolean
     */
    public function removeFromCart(String $itemName)//boolean
    {
<<<<<<< HEAD
        for($this->$items as $product)
=======
        foreach($this->$items as $product)
>>>>>>> transaction
        {
			if($product.name == $itemName)
			{
				array_pop($this->$items,$product);
				return true;
			}	
		}
        return false;
    }

    /**
     * @return double
     */
    public function calculateTotal()//double
    {
		$running_sum = 0.00;
		$size = count($this->$items);
        if($size==0)
        {
			return 0.00;
		}
		foreach($this->$items as $product)
		{
<<<<<<< HEAD
			$running_sum += $product->price;
		}
		return true;
=======
			$running_sum += $product->$price;
		}
		return $running_sum;
>>>>>>> transaction
    }

    /**
     * @return String
     */
    public function getDateCreated()//String
    {
        return $this->$dateCreated;
    }

    /**
     * @return Double
     */
    public function getTotal()//Double
    {
        return $this->$total;
    }

    /**
     * @return List<Product>
     */
    public function getItems()//List<Product>
    {
        return $this->$items;
    }
}
