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
    public function getFirstName(){
        return $this->firstName;
    }
    
    /**
     * @param String $firstName
     * @return boolean
     */
    public function setFirstName($firstName){
        $old_firstName = $this->firstName;
        $this->firstName = $firstName;
        $username = parent::getUsername();
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        $sql = "update account set f_name='$firstName' where username='$username';";
        $result = $database->update($sql);
        if($result > 0){
            return TRUE;
        }
        else {
            $this->firstName = $old_firstName;
            return FALSE;
        }
    }
    
    /**
     * @return String
     */
    public function getLastName(){ 
        return $this->lastName;
    }
    
    /**
     * @param String $lastName
     * @return boolean
     */
    public function setLastName($lastName){   
        $old_lastName = $this->lastName;
        $this->lastName = $lastName;
        $username = parent::getUsername();
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        $sql = "update account set l_name='$lastName' where username='$username';";
        $result = $database->update($sql);
        if($result > 0){
            return TRUE;
        }
        else {
            $this->lasttName = $old_lastName;
            return FALSE;
        }
    }
    
    public function getEmail(){ 
        return $this->emailAddress;
    }
    
    /**
     * @param String $lastName
     * @return boolean
     */
    public function setEmail($emailAddress){   
        $old_emailAddress = $this->emailAddress;
        $this->emailAddress = $emailAddress;
        $username = parent::getUsername();
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        $sql = "update account set email_address='$emailAddress' where username='$username';";
        $result = $database->update($sql);
        if($result > 0){
            return TRUE;
        }
        else {
            $this->emailAddress = $old_emailAddress;
            return FALSE;
        }
    }
    
    /**
     * @return Address
     */
    public function getShippingAddress(){
        return $this->shippingAddress;
    }
    
    /**
     * @param Address $address
     * @return boolean
     */
    public function setShippingAddress($shippingAddress){
        $bool = $this->shippingAddress->setStreetAddress($shippingAddress->getStreetAddress());
        if(!$bool){
            return FALSE;
        }
        $bool = $this->shippingAddress->setCity($shippingAddress->getCity());
        if(!$bool){
            return FALSE;
        }
        $bool = $this->shippingAddress->setParish($shippingAddress->getParish());
        if(!$bool){
            return FALSE;
        }
        $bool = $this->shippingAddress->setPostalCode($shippingAddress->getPostalCode());
        if(!$bool){
            return FALSE;
        }
        return TRUE;
    }
    
    /**
     * @return List<Order>
     */
    public function getOrders(){  
        return $this->orders;
    }
    
    public function updateOrders($order){
        array_push($this->orders, $order);
    }
    
    /**
     * @return String
     */
    public function getPhoneNumber(){
        return $this->phoneNumber;
    }
    
    /**
     * @param String $number
     * @return boolean
     */
    public function setPhoneNumber($phoneNumber){
        $old_phoneNumber = $this->phoneNumber;
        $this->phoneNumber = $phoneNumber;
        $username = parent::getUsername();
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        $sql = "update account set p_number=$phoneNumber where username='$username';";
        $result = $database->update($sql);
        if($result > 0){
            return TRUE;
        }
        else {
            $this->phoneNumber = $old_phoneNumber;
            return FALSE;
        }
    }
    
    public function getPaymentMethod(){
        return $this->paymentMethod;
    }
    
    /**
     * @param String $number
     * @return boolean
     */
    public function setPaymentMethod($method){
        $this->paymentMethod = $method;
    }
    
    /**
     * @return List<Product>
     */
    public function fetchItems(){
        return $this->cart->getItems();
    }
    
    /**
     * @return boolean
     */
    public function chargePaymentMethod(){
        //Stub method
        return TRUE;
    }
    
    public function setCart($cart){
        $this->cart = $cart;
    }
    
    public function getCart(){
        return $this->cart;
    }
}