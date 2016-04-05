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


    /**
     * @return String
     */
    public function getCardHolder():String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $cardHolder
     * @return boolean
     */
    public function setCardHolder(String $cardHolder):boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getCardNumber():String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $cardNumber
     * @return boolean
     */
    public function setCardNumber(String $cardNumber):boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getExpiryDate():String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $expiryDate
     * @return boolean
     */
    public function setExpiryDate(String $expiryDate):boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getCardVerificationCode():String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $cvc
     * @return boolean
     */
    public function setCardVerificationCode(String $cvc):boolean
    {
        // TODO: implement here
        return false;
    }
}
