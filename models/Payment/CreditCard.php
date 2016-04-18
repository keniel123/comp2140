<?php


/**
 *
 */
class CreditCard extends PaymentMethod
{

    /**
     * @var String
     */
    private $cardHolder;

    /**
     * @var String
     */
    private $cardNumber;

    /**
     * @var String
     */
    private $expiryDate;

    /**
     * @var String
     */
    private $cardVerificationCode;

    /**
     * @var Address
     */
    private $address;
    
    public function __construct($cardholder, $cardnumber, $date, $cvc, $address){
        $this->cardHolder = $cardholder;
        $this->cardNumber = $cardnumber;
        $this->expiryDate = $date;
        $this->cardVerificationCode = $cvc;
        $this->address = $address;
    }


    /**
     * @return String
     */
    public function getCardHolder()//String
    {
        return $this->cardHolder;
    }

    /**
     * @param String $cardHolder
     * @return boolean
     */
    public function setCardHolder($cardHolder)//boolean
    {
        $this->cardHolder = $cardHolder;
        return TRUE;
    }

    /**
     * @return String
     */
    public function getCardNumber()//String
    {
        return $this->cardNumber;
    }

    /**
     * @param String $cardNumber
     * @return boolean
     */
    public function setCardNumber($cardNumber)//boolean
    {
        $this->cardNumber = $cardNumber;
        return TRUE;
    }

    /**
     * @return String
     */
    public function getExpiryDate()//String
    {
        return $this->expiryDate;
    }

    /**
     * @param String $expiryDate
     * @return boolean
     */
    public function setExpiryDate($expiryDate)//boolean
    {
        $this->expiryDate = $expiryDate;
        return TRUE;
    }

    /**
     * @return String
     */
    public function getCardVerificationCode()//String
    {
        return $this->cardVerificationCode;
    }

    /**
     * @param String $cvc
     * @return boolean
     */
    public function setCardVerificationCode($cvc)//boolean
    {
        $this->cardVerificationCode = $cvc;
        return TRUE;
    }
    
    public function getBillingAddress()//String
    {
        return $this->address;
    }

    /**
     * @param String $cvc
     * @return boolean
     */
    public function setBillingAddress($address)//boolean
    {
        $this->address = $address;
        return TRUE;
    }
}
