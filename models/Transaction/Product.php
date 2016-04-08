<?php


/**
 *
 */
class Product
{
    /**
     *
     */
    public function __construct()
    {
    }

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



    /**
     * @return String
     */
    public function getID()//String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $ID
     * @return boolean
     */
    public function setID(String $ID)//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getName()//String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $name
     * @return boolean
     */
    public function setName(String $name)//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return Double
     */
    public function getPrice()//Double
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param Double $price
     * @return boolean
     */
    public function setPrice(Double $price)//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return List<String>
     */
    public function getDescription()//List<String>
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param List<String> $description
     * @return boolean
     */
    public function setDescription($description)//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return int
     */
    public function getQuantity()//int
    {
        // TODO: implement here
        return 0;
    }

    /**
     * @param String $quantity
     * @return boolean
     */
    public function setQuantity(String $quantity)//boolean
    {
        // TODO: implement here
        return false;
    }
}
