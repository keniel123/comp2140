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

    /**
     * @var int
     */
    private $qtyLeft;

	 public function __construct(string $_i, string $_n, string $_d, double $_p, int $_q, string $_img, int $_ql)
    {
		$this->$ID = $_i;
		$this->$name = $_n;
		$this->$description = $_d;
		$this->$price = $_p;
		$this->$image = $_i;
		$this->$qtyLeft = $_ql;
	}

    /**
     * @return String
     */
    public function getID()//String
    {
        return $this->$ID;
    }

    /**
     * @param String $ID
     * @return 
     */
    public function setID(String $ID)//boolean
    {
        $this->$ID = $ID;
        return true;
    }

    /**
     * @return String
     */
    public function getName()//String
    {
        return $this->$name;
    }

    /**
     * @param String $name
     * @return boolean
     */
    public function setName(String $name)//boolean
    {
        $this->$name = $name;
        return true;
    }

    /**
     * @return Double
     */
    public function getPrice()//Double
    {
        return $this->$price;
    }

    /**
     * @param Double $price
     * @return boolean
     */
    public function setPrice(Double $price)//boolean
    {
        $this->$price = $price;
        return true;
    }

    /**
     * @return List<String>
     */
    public function getDescription()//List<String>
    {
        return $this->$description;
    }

    /**
     * @param List<String> $description
     * @return boolean
     */
    public function setDescription(string $description)//boolean
    {
       $this->$description = $description;
       return true;
    }

    /**
     * @return int
     */
    public function getQuantity()//int
    {
        return $this->$quantity;
    }

    /**
     * @param String $quantity
     * @return boolean
     */
    public function setQuantity(String $quantity)//boolean
    {
        $this->$quantity = $quantity;
        return false;
    }
}
