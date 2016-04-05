<?php


/**
 *
 */
class Order
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




    /**
     * @return String
     */
    public function getID():String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $ID
     * @return boolean
     */
    public function setID(String $ID):boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getOrderDate():String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $orderDate
     * @return boolean
     */
    public function setOrderDate(String $orderDate):boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getDeliveryDate():String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $deliveryDate
     * @return boolean
     */
    public function setDeliveryDate(String $deliveryDate):boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getOrderStatus():String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $orderStatus
     * @return boolean
     */
    public function setOrderStatus(String $orderStatus):boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return Double
     */
    public function getTotal():Double
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return boolean
     */
    public function calculateTotal():boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return List<Product>
     */
    public function getItems():List<Product>
    {
        // TODO: implement here
        return null;
    }
}
