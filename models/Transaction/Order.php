<?php




/**
 *
 */
class Order
{




    /**
     * @var String
     */
    private $ID;
    /**
     * @var String
     */
    private $orderDate;
    /**
     * @var String
     */
    private $deliveryDate;
    /**
     * @var String
     */
    private $orderStatus;
    /**
     * @var Double
     */
    private $total;
    /**
     * @var List<Product>
     */
    private $items;
    
	public function __construct($total, $items){
		$this->ID = sha1(round(microtime(true) * 1000));
		$this->orderDate = round(microtime(true) * 1000);
		$this->deliveryDate = 0;
		$this->orderStatus = "U";
		$this->total = $total;
		$this->items = $items;
    }

    /**
     * @return String
     */
    public function getOrderId()
    {

        return $this->ID;

    }
    /**
     * @param String $ID
     * @return boolean
     */
    public function setOrderId($ID)
    {

		$this->ID = $ID;

        return true;
    }
    /**
     * @return String
     */
    public function getOrderDate()
    {

        return $this->orderDate;

    }
    /**
     * @param String $orderDate
     * @return boolean
     */
    public function setOrderDate($orderDate)
    {

		$this->orderDate = $orderDate;

        return true;
    }
    /**
     * @return String
     */
    public function getDeliveryDate()
    {

        return $this->deliveryDate;

    }
    /**
     * @param String $deliveryDate
     * @return boolean
     */
    public function setDeliveryDate($deliveryDate)
    {

        $this->deliveryDate = $deliveryDate;

        return true;
    }
    /**
     * @return String
     */
    public function getOrderStatus()
    {

        return $this->orderStatus;

    }
    /**
     * @param String $orderStatus
     * @return boolean
     */
    public function setOrderStatus($orderStatus)
    {

        $this->orderStatus = $orderStatus;

        return true;
    }
    /**
     * @return Double
     */
    public function getTotal()//Double
    {

        return $this->total;

    }
    /**
     * @return boolean
     */
    public function calculateTotal()
    {
        $running_sum = 0.00;

		$size = count($this->items);

        if($size==0)
        {
			return false;
		}
        
		foreach($this->items as $product)
		{
			$running_sum += $product->price;
		}
		$this->total = $running_sum;

		return true;
    }
    /**
     * @return List<Product>
     */
    public function getItems()//List<Product>
    {

        return $this->items;

    }
    /**
     * @return void 
     */
     public function setItems(array $arr)
     {

		 $this->items = $arr;
		 return true;
	 }
}

