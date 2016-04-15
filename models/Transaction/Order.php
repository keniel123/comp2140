// <?php
// <<<<<<< HEAD

// =======
// >>>>>>> sultanofcardio
// /**
//  *
//  */
// class Order
// {
// <<<<<<< HEAD

// =======
// >>>>>>> sultanofcardio
//     /**
//      * @var String
//      */
//     private $ID;
//     /**
//      * @var String
//      */
//     private $orderDate;
//     /**
//      * @var String
//      */
//     private $deliveryDate;
//     /**
//      * @var String
//      */
//     private $orderStatus;
//     /**
//      * @var Double
//      */
//     private $total;
//     /**
//      * @var List<Product>
//      */
//     private $items;
// <<<<<<< HEAD
// <<<<<<< HEAD

// 	public function __construct()
//     {
// 		$this->$ID = "";
// 		$this->$orderDate = "";
// 		$this->$deliveryDate = "";
// 		$this->$orderStatus = "";
// 		$this->$total = 0.00;
// 		$this->$items = array();
//     }

// =======
// 	public function __construct()
// =======
    
// 	public function __construct($total, $items)
// >>>>>>> sultanofcardio
//     {
// 		$this->ID = sha1(date());
// 		$this->orderDate = date();
// 		$this->deliveryDate = "";
// 		$this->orderStatus = "";
// 		$this->total = $total;
// 		$this->items = $items;
//     }
// >>>>>>> sultanofcardio
//     /**
//      * @return String
//      */
//     public function getID()//String
//     {
// <<<<<<< HEAD
//         return $this->$ID;
// =======
//         return $this->ID;
// >>>>>>> sultanofcardio
//     }
//     /**
//      * @param String $ID
//      * @return boolean
//      */
//     public function setID(String $ID)//boolean
//     {
// <<<<<<< HEAD
// 		$this->$ID = $ID;
// =======
// 		$this->ID = $ID;
// >>>>>>> sultanofcardio
//         return true;
//     }
//     /**
//      * @return String
//      */
//     public function getOrderDate()//String
//     {
// <<<<<<< HEAD
//         return $this->$orderDate;
// =======
//         return $this->orderDate;
// >>>>>>> sultanofcardio
//     }
//     /**
//      * @param String $orderDate
//      * @return boolean
//      */
//     public function setOrderDate(String $orderDate)//boolean
//     {
// <<<<<<< HEAD
// 		$this->$orderDate = $orderDate;
// =======
// 		$this->orderDate = $orderDate;
// >>>>>>> sultanofcardio
//         return true;
//     }
//     /**
//      * @return String
//      */
//     public function getDeliveryDate()//String
//     {
// <<<<<<< HEAD
//         return $this->$deliveryDate;
// =======
//         return $this->deliveryDate;
// >>>>>>> sultanofcardio
//     }
//     /**
//      * @param String $deliveryDate
//      * @return boolean
//      */
//     public function setDeliveryDate(String $deliveryDate)//boolean
//     {
// <<<<<<< HEAD
//         $this->$deliveryDate = $deliveryDate;
// =======
//         $this->deliveryDate = $deliveryDate;
// >>>>>>> sultanofcardio
//         return true;
//     }
//     /**
//      * @return String
//      */
//     public function getOrderStatus()//String
//     {
// <<<<<<< HEAD
//         return $this->$orderStatus;
// =======
//         return $this->orderStatus;
// >>>>>>> sultanofcardio
//     }
//     /**
//      * @param String $orderStatus
//      * @return boolean
//      */
//     public function setOrderStatus(String $orderStatus)//boolean
//     {
// <<<<<<< HEAD
//         $this->$orderStatus = $orderStatus;
// =======
//         $this->orderStatus = $orderStatus;
// >>>>>>> sultanofcardio
//         return true;
//     }
//     /**
//      * @return Double
//      */
//     public function getTotal()//Double
//     {
// <<<<<<< HEAD
//         return $this->$total;
// =======
//         return $this->total;
// >>>>>>> sultanofcardio
//     }
//     /**
//      * @return boolean
//      */
//     public function calculateTotal()//boolean
//     {
//         $running_sum = 0.00;
// <<<<<<< HEAD
// 		$size = count($this->$items);
// =======
// 		$size = count($this->items);
// >>>>>>> sultanofcardio
//         if($size==0)
//         {
// 			return false;
// 		}
// <<<<<<< HEAD
// 		foreach($this->$items as $product)
// 		{
// 			$running_sum += $product->price;
// 		}
// 		$this->$total = $running_sum;
// =======
// 		foreach($this->items as $product)
// 		{
// 			$running_sum += $product->price;
// 		}
// 		$this->total = $running_sum;
// >>>>>>> sultanofcardio
// 		return true;
//     }
//     /**
//      * @return List<Product>
//      */
//     public function getItems()//List<Product>
//     {
// <<<<<<< HEAD
//         return $this->$items;
// =======
//         return $this->items;
// >>>>>>> sultanofcardio
//     }
//     /**
//      * @return void 
//      */
//      public function setItems(array $arr)
//      {
// <<<<<<< HEAD
// 		 $this->$items = $arr;
// 		 return true;
// 	 }
// }
// =======
// 		 $this->items = $arr;
// 		 return true;
// 	 }
// }
// >>>>>>> sultanofcardio
