<?php

$database = new Database('localhost', 'pdo_ret', 'root', '');
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
	public function __construct(){
		$this->dateCreated = getdate();
		$this->total = 0.00;
		$this->items = array();
    }
    /**
     * @return boolean
     */
    private function checkAvailability($prod, $qty){
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
    public function emptyCart(){
		unset($this->items);
		$this->items = array();
    }
    
    /**
     * @param prod			Product object
     * @return boolean
     */
    public function addToCart($prod, $amt){
        
		// if product already in list increase quantity
		foreach($this->items as $product){
			if($prod->getName() == $product->getName()){
                $total = $product->getQuantity() + $amt;
                $this->removeFromCart($product);
                $prod->setQuantity($total);
                $this->addToCart($prod);
			}
		}
		return TRUE;
    }
    
    /**
     * @param String $itemName
     * @return boolean
     */
    public function removeFromCart($itemName){
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
    public function calculateTotal()
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
    public function getDateCreated()
    {
        return $this->dateCreated;
    }
    /**
     * @return Double
     */
    public function getTotal()
    {
        return $this->total;
    }
    /**
     * @return List<Product>
     */
    public function getItems()
    {
        return $this->items;
    }
}