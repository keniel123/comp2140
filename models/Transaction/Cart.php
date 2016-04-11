<?php
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
	 * @return	void 
	 **/
	public function __construct()
    {
		$this->dateCreated = getdate();
		$this->total = 0.00;
		$this->items = array();
    }
    /**
     * @return boolean
     */
    public function checkAvailability($prod, $qty)//boolean
    {
        $result = $database->query(
					"SELECT quantity
					 FROM product
					  WHERE productId = ".$prod->getID().";"
					);
		if (gettype($result) == 'object')
		{
			$row = $result[0];
			if($qty <= $row[4])
				return TRUE;
		}
		return FALSE;
    }
    /**
     * @return boolean
     */
    public function emptyCart()//boolean
    {
		unset($this->items);
		$this->items = array();
		return TRUE;
    }
    /**
     * @param prod			Product object
     * @return boolean
     */
    public function addToCart(Product $prod, int $amt)//boolean
    {
        if (!checkAvailability($prod, $amt))
        {
				return FALSE;
		}
		// if product already in list increase quantity
		foreach($this->items as $product)
		{
			if($prod->name == $product->name)
			{
				$product->quantity+=$prod->name;
			}
		}
		array_push($this->items,prod);
		//update total price
		calculateTotal();
		return TRUE;
    }
    /**
     * @param String $itemName
     * @return boolean
     */
    public function removeFromCart(String $itemName)//boolean
    {
        foreach($this->items as $product)
        {
			if($product.name == $itemName)
			{
				array_pop($this->items,$product);
				return TRUE;
			}	
		}
        return FALSE;
    }
    /**
     * @return double
     */
    public function calculateTotal()//double
    {
		$running_sum = 0.00;
		$size = count($this->items);
        if($size==0)
        {
			return 0.00;
		}
		foreach($this->items as $product)
		{
			$running_sum += $product->price;
		}
		return $running_sum;
    }
    /**
     * @return String
     */
    public function getDateCreated()//String
    {
        return $this->dateCreated;
    }
    /**
     * @return Double
     */
    public function getTotal()//Double
    {
        return $this->total;
    }
    /**
     * @return List<Product>
     */
    public function getItems()//List<Product>
    {
        return $this->items;
    }
}