<?php


/**
 *
 */
class Account extends User
{

    /**
     * @var String
     */
    private $firstName;

    /**
     * @var String
     */
    private $lastName;

    /**
     * @var Address
     */
    private $shippingAddress;

    /**
     * @var List<Order>
     */
    private $orders;

    /**
     * @var String
     */
    private $phoneNumber;

    /**
     * @var PaymentMethod
     */
    private $paymentMethod;

    /**
     * @var Cart
     */
    private $cart;






    /**
     * @return String
     */
    public function getFirstName():String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $firstName
     * @return boolean
     */
    public function setFirstName(String $firstName):boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getLastName():String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $lastName
     * @return boolean
     */
    public function setLastName(String $lastName):boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return Address
     */
    public function getShippingAddress():Address
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param Address $address
     * @return boolean
     */
    public function setShippingAddress(Address $address):boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return List<Order>
     */
    public function getOrders():List<Order>
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return boolean
     */
    public function updateOrders():boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getPhoneNumber():String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $number
     * @return boolean
     */
    public function setPhoneNumber(String $number):boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return boolean
     */
    public function checkout():boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return List<Product>
     */
    public function fetchItems():List<Product>
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return void
     */
    public function makeComplaint():void
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return boolean
     */
    public function chargePaymentMethod():boolean
    {
        // TODO: implement here
        return false;
    }
}
