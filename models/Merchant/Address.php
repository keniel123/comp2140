<?php


/**
 *
 */
class Address
{

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
    /**
     *
     */
    public function __construct($street, $city, $parish, $postal)
    {
        $this->streetAddress = $street;
        $this->city = $city;
        $this->parish = $parish;
        $this->postalCode = $postal;

    }






    /**
     * @return String
     */
    public function getStreetAddress()//:String
    {
        return $this->streetAddress;
    }

    /**
     * @param Street $address
     * @return boolean
     */
    public function setStreetAddress(String $address)//:boolean
    {
       return $this->streetAddress = $address;
    }

    /**
     * @return String
     */
    public function getCity()//:String
    {
       return $this->city;
    }

    /**
     * @param String $city
     * @return boolean
     */
    public function setCity(String $city)//:boolean
    {
       return $this->city = $city;
    }

    /**
     * @return String
     */
    public function getParish()//:String
    {
        return $this->parish;
    }

    /**
     * @param String $parish
     * @return boolean
     */
    public function setParish(String $parish)//:boolean
    {
       return $this->parish = $parish;
    }

    /**
     * @return String
     */
    public function getPostalCode()//:String
    {
        return $this->postalCode;
    }

    /**
     * @param String $postalCode
     * @return boolean
     */
    public function setPostalCode(String $postalCode)//:boolean
    {
         return $this->postalCode = $postalCode;
    }
}
