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
    private $paymentMethod = '';
    /**
     * @var Cart
     */
    private $cart;
    
    /**
     * @var emailAddress
     */
    private $emailAddress;
    
    
    
    
    
    public function __construct($user, $email, $pass, $phone_number,
                               $first_name, $last_name, $address){
        parent::__construct($user, $pass);
        $this->emailAddress = $email;
        $this->firstName = $first_name;
        $this->lastName = $last_name;
        $this->shippingAddress = $address;
        $this->phoneNumber = $phone_number;
        $this->cart = new Cart();
        $this->orders = array();
    }
    
    /**
     * @return String
     */
    public function getFirstName()//:String
    {
        
        return $this->firstName;
    }
    /**
     * @param String $firstName
     * @return boolean
     */
    public function setFirstName($firstName)//:boolean
    {
        
         $this->firstName = $firstName;
    }
    /**
     * @return String
     */
    public function getLastName()//:String
    {
        
        return $this->lastName;
    }
    /**
     * @param String $lastName
     * @return boolean
     */
    public function setLastName($lastName)//:boolean
    {
        
        $this->lastName = $lastName;
    }
    
    public function getEmail()//:String
    {
        
        return $this->emailAddress;
    }
    /**
     * @param String $lastName
     * @return boolean
     */
    public function setEmail($email)//:boolean
    {
        
        $this->emailAddress = $email;
    }
    /**
     * @return Address
     */
    public function getShippingAddress()//:Address
    {
        return $this->shippingAddress;
    }
    /**
     * @param Address $address
     * @return boolean
     */
    public function setShippingAddress($address)//:boolean
    {
        $this->shippingAddress = $address;
    }
    /**
     * @return List<Order>
     */
    public function getOrders()//:List<Order>
    {
        
        return $this->orders;
    }
    /**
     * @return boolean
     */
    public function updateOrders($order)//:boolean
    {
        array_push($this->orders, $order);
    }
    /**
     * @return String
     */
    public function getPhoneNumber()//:String
    {
        
        return $this->phoneNumber;
    }
    /**
     * @param String $number
     * @return boolean
     */
    public function setPhoneNumber($number)//:boolean
    {
        $this->phoneNumber = $number;
    }
    
    public function getPaymentMethod()//:String
    {
        
        return $this->paymentMethod;
    }
    /**
     * @param String $number
     * @return boolean
     */
    public function setPaymentMethod($method)//:boolean
    {
        $this->paymentMethod = $method;
    }
    /**
     * @return boolean
     */
    public function checkout()//:boolean
    {
        if (count($cart->getItems()) > 0){
            if ($paymentMethod->validatePayment()){
                $items = $this->fetchItems();
                foreach ($items as $item) {
                    if(!$cart->checkAvailability($item)){
                        return FALSE;
                    }
                }
                $this->chargePaymentMethod();
                $order = new Order($cart->getTotal(), $this->fetchItems());
                $this->updateOrders($order);
                return TRUE;
            }
            return FALSE;
        }
        return FALSE;
    }
    /**
     * @return List<Product>
     */
    public function fetchItems()//:List<Product>
    {
        return $cart->getItems();
    }
    /**
     * @return boolean
     */
    public function chargePaymentMethod()//:boolean
    {
        return TRUE;
    }
}