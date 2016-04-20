<?php

$database = new Database('localhost', 'pdo_ret', 'root', '');
/**
 *
 */
class Cart
{
    private $cartId;
    
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
        $this->cartId = sha1(round(microtime(true) * 1000));
		$this->dateCreated = round(microtime(true) * 1000);
		$this->total = 0.00;
		$this->items = array();
    }
    
    public function inCart($product_name){
        foreach($this->items as $product){
            if($product->getName() == $product_name){
                return $product->getQuantity();
            }
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
        
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        if(gettype($this->inCart($prod->getName())) != 'boolean'){ /* if product already in list increase quantity */
            $total = $this->inCart($prod->getName()) + $amt;
            $this->removeFromCart($prod->getName());
            $prod->setQuantity($total);
            array_push($this->items, $prod);
            
            /* Update relevent tables in the database */
            $productId = $prod->getProductId();
            $sql = "update cart_product set quantity=$total where cart_id='$this->cartId' and product_id='$productId';";
            $result = $database->update($sql);
            if($result < 1){
                array_pop($this->items);
                return FALSE;
            }
            return TRUE;
        } 
        else { /* Add as new product */
            array_push($this->items, $prod);
            
            /* Update relevent tables in the database */
            $prod->setQuantity($amt);
            $productId = $prod->getProductId();
            $sql = "delete from cart_product where cart_id='$this->cartId' and product_id='$productId';";
            $result = $database->update($sql);
            $sql = "insert into cart_product values('$this->cartId', '$productId', $amt);";
            $result = $database->update($sql);
            if($result < 1){
                array_pop($this->items);
                return FALSE;
            }
            return TRUE;
        }
    }
    
    /**
     * @param String $itemName
     * @return boolean
     */
    public function removeFromCart($itemName){
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        foreach($this->items as $product){
			if($product->getName() == $itemName){
				$key = array_search($product, $this->items);
                unset($this->items[$key]);
                $sql = "delete from cart_product where cart_id='$this->cartId' and product_id='".$product->getProductId()."';";
                $database->update($sql);
				return TRUE;
			}	
		}
        return FALSE;
    }
    
    /**
     * @return double
     */
    public function calculateTotal(){
		$running_sum = 0.00;
		foreach($this->items as $product)
		{
			$running_sum += $product->getPrice()*$product->getQuantity();
		}
		$this->total = $running_sum;
    }
    
    /**
     * @return String
     */
    public function getDateCreated(){
        return $this->dateCreated;
    }
    
    /**
     * @return Double
     */
    public function getTotal(){
        $this->calculateTotal();
        return $this->total;
    }
    
    /**
     * @return List<Product>
     */
    public function getItems(){
        return $this->items;
    }
    
    public function getCartId(){
        return $this->cartId;
    }
    
    public function setCartId($cartId){
        $this->cartId = $cartId;
    }
}