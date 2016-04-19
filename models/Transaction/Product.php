 <?php
 /**
  *
  */
 class Product
 {
     /**
      * @var String
      */
     private $ID;
     /**
      * @var String
      */
     private $name;
     /**
      * @var List<String>
      */
     private $description;
     /**
      * @var Double
      */
     private $price;
     /**
      * @var int
      */
     private $quantity;
     /**
      * @var String
      */
     private $image;
 

 	 public function __construct($id, $name, $price){
         $this->ID = $id;
         $this->name = $name;
         $this->price = $price;
 	}
 
     /**
      * @return String
      */
     public function getProductId(){
 
         return $this->ID;
 
     }
     
     /**
      * @param String $ID
      * @return 
      */
     public function setProductId($ID){
 
         $this->ID = $ID;
     }

     /**
      * @return String
      */
     public function getName(){
 
         return $this->name;
     }
     
     /**
      * @param String $name
      * @return boolean
      */
     public function setName($name){
 
         $this->name = $name;
     }
     
     /**
      * @return Double
      */
     public function getPrice(){
 
         return $this->price;
     }
     
     /**
      * @param Double $price
      * @return boolean
      */
     public function setPrice($price){
 
         $this->price = $price;
     }
     
     /**
      * @return List<String>
      */
     public function getDescription(){
 
         return $this->description;
     }
     
     /**
      * @param List<String> $description
      * @return boolean
      */
     public function setDescription($description){
 
        $this->description = $description;
     }
     
     /**
      * @return int
      */
     public function getQuantity(){
 
         return $this->quantity;
     }
     
     /**
      * @param String $quantity
      * @return boolean
      */
     public function setQuantity($quantity){

         $this->quantity = $quantity;
     }
     
 }
?>