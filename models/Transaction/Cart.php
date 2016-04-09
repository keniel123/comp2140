<?php
require_once('Product.php');
require_once(realpath('../').'/Control/Database.php');// ;)
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
    
    /**
     * @var Database Object 
     */
    private $db;
    
	/**
	 * @return	void 
	 **/
	public function __construct()
    {
		$this->$dateCreated = getdate();
		$this->$total = 0.00;
		$this->$items = array();
		$db = new Database();
    }
    /**
     * @return boolean
     */
    public function checkAvailability(Product $prod, int $qty)//boolean
    {
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
    public function addToCart(Product $prod, int $amt)//boolean
    {
        if (!checkAvailability($prod, $amt))
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
        foreach($this->$items as $product)
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
			$running_sum += $product->$price;
		}
		return $running_sum;
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
