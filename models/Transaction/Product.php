<?php
<<<<<<< HEAD

=======
>>>>>>> sultanofcardio
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
    /**
     * @var int
     */
    private $qtyLeft;
<<<<<<< HEAD

	 public function __construct(string $_i, string $_n, string $_d, double $_p, int $_q, string $_img, int $_ql)
    {
		$this->$ID = $_i;
		$this->$name = $_n;
		$this->$description = $_d;
		$this->$price = $_p;
		$this->$image = $_i;
		$this->$qtyLeft = $_ql;
	}

=======
	 public function __construct(string $_i, string $_n, string $_d, double $_p, int $_q, string $_img, int $_ql)
    {
		$this->ID = $_i;
		$this->name = $_n;
		$this->description = $_d;
		$this->price = $_p;
		$this->image = $_i;
		$this->qtyLeft = $_ql;
	}
>>>>>>> sultanofcardio
    /**
     * @return String
     */
    public function getID()//String
    {
<<<<<<< HEAD
        return $this->$ID;
=======
        return $this->ID;
>>>>>>> sultanofcardio
    }
    /**
     * @param String $ID
     * @return 
     */
    public function setID(String $ID)//boolean
    {
<<<<<<< HEAD
        $this->$ID = $ID;
=======
        $this->ID = $ID;
>>>>>>> sultanofcardio
        return true;
    }
    /**
     * @return String
     */
    public function getName()//String
    {
<<<<<<< HEAD
        return $this->$name;
=======
        return $this->name;
>>>>>>> sultanofcardio
    }
    /**
     * @param String $name
     * @return boolean
     */
    public function setName(String $name)//boolean
    {
<<<<<<< HEAD
        $this->$name = $name;
=======
        $this->name = $name;
>>>>>>> sultanofcardio
        return true;
    }
    /**
     * @return Double
     */
    public function getPrice()//Double
    {
<<<<<<< HEAD
        return $this->$price;
=======
        return $this->price;
>>>>>>> sultanofcardio
    }
    /**
     * @param Double $price
     * @return boolean
     */
    public function setPrice(Double $price)//boolean
    {
<<<<<<< HEAD
        $this->$price = $price;
=======
        $this->price = $price;
>>>>>>> sultanofcardio
        return true;
    }
    /**
     * @return List<String>
     */
    public function getDescription()//List<String>
    {
<<<<<<< HEAD
        return $this->$description;
=======
        return $this->description;
>>>>>>> sultanofcardio
    }
    /**
     * @param List<String> $description
     * @return boolean
     */
    public function setDescription(string $description)//boolean
    {
<<<<<<< HEAD
       $this->$description = $description;
=======
       $this->description = $description;
>>>>>>> sultanofcardio
       return true;
    }
    /**
     * @return int
     */
    public function getQuantity()//int
    {
<<<<<<< HEAD
        return $this->$quantity;
=======
        return $this->quantity;
>>>>>>> sultanofcardio
    }
    /**
     * @param String $quantity
     * @return boolean
     */
    public function setQuantity(String $quantity)//boolean
    {
<<<<<<< HEAD
        $this->$quantity = $quantity;
=======
        $this->quantity = $quantity;
>>>>>>> sultanofcardio
        return false;
    }
}