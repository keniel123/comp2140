<?php


/**
 *
 */
class Cart
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
     * @return boolean
     */
    public function checkAvailability()//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return boolean
     */
    public function emptyCart()//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @param \Product $item
     * @return boolean
     */
    public function addToCart(\Product $item)//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @param String $itemName
     * @return boolean
     */
    public function removeFromCart(String $itemName)//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return void
     */
    public function calculateTotal()//void
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return String
     */
    public function getDateCreated()//String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return Double
     */
    public function getTotal()//Double
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return List<Product>
     */
    public function getItems()//List<Product>
    {
        // TODO: implement here
        return null;
    }
}
