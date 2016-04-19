<?php
/**
 *
 */
class Address
{
    private $addressId="";
    
        /**
     * @var String
     */
    private $streetAddress="";
    /**
     * @var String
     */
    private $city="";
    /**
     * @var String
     */
    private $parish="";
    /**
     * @var String
     */
    private $postalCode="";
    
    
    public function __construct($street, $city, $parish, $postal){
        $this->addressId = sha1($street . $city . $parish . $postal);
        $this->streetAddress = $street;
        $this->city = $city;
        $this->parish = $parish;
        $this->postalCode = $postal;
    }
    
    /**
     * @return String
     */
    public function getStreetAddress(){
        return $this->streetAddress;
    }
    
    /**
     * @param Street $address
     * @return boolean
     */
    public function setStreetAddress($streetAddress){
        $old_streetAddress = $this->streetAddress;
        $this->streetAddress = $streetAddress;
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        $sql = "update address set street_address='$shippingAddress' where address_id='$this->addressId';";
        $result = $database->update($sql);
        if($result > 0){
            return TRUE;
        }
        else {
            $this->streetAddress = $old_streetAddress;
            return FALSE;
        }
    }
    
    /**
     * @return String
     */
    public function getCity(){
       return $this->city;
    }
    
    /**
     * @param String $city
     * @return boolean
     */
    public function setCity($city){
        $old_city = $this->city;
        $this->city = $city;
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        $sql = "update address set city='$city' where address_id='$this->addressId';";
        $result = $database->update($sql);
        if($result > 0){
            return TRUE;
        }
        else {
            $this->city = $old_city;
            return FALSE;
        }
    }
    
    /**
     * @return String
     */
    public function getParish(){
        return $this->parish;
    }
    
    /**
     * @param String $parish
     * @return boolean
     */
    public function setParish($parish){
        $old_parish = $this->parish;
        $this->parish = $parish;
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        $sql = "update address set parish='$parish' where address_id='$this->addressId';";
        $result = $database->update($sql);
        if($result > 0){
            return TRUE;
        }
        else {
            $this->parish = $old_parish;
            return FALSE;
        }
    }
    
    /**
     * @return String
     */
    public function getPostalCode(){
        return $this->postalCode;
    }
    
    /**
     * @param String $postalCode
     * @return boolean
     */
    public function setPostalCode($postalCode){
        $old_postalCode = $this->postalCode;
        $this->postalCode = $postalCode;
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        $sql = "update address set postal_code='$postalCode' where address_id='$this->addressId';";
        $result = $database->update($sql);
        if($result > 0){
            return TRUE;
        }
        else {
            $this->postalCode = $old_postalCode;
            return FALSE;
        }
    }
    
    /**
     * @return String
     */
    public function getAddressId(){
        return $this->addressId;
    }
    
    public function setAddressId($addressId){
        $this->addressId = $addressId;
    }
}