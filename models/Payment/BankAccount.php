<?php


/**
 *
 */
class BankAccount extends PaymentMethod
{

    /**
     * @var String
     */
    private $accountNumber;

    /**
     * @var String
     */
    private $bank;

    /**
     * @var String
     */
    private $accountType;

    /**
     * @var Address
     */
    private $address;


    /**
     * @return String
     */
    public function getAccountNumber()//String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $accountNumber
     * @return boolean
     */
    public function setAccountNumber(String $accountNumber)//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getBank()//String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $accountNumber
     * @param String $bank
     * @param String $accountType
     * @param Address $address
     * @return boolean
     */
    public function changeBank(String $accountNumber, String $bank, String $accountType, Address $address)//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getAccountType()//String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $accountType
     * @return boolean
     */
    public function setAccountType(String $accountType)//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return Address
     */
    public function getAddress()//Address
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param Address $address
     * @return boolean
     */
    public function setAddress(Address $address)//boolean
    {
        // TODO: implement here
        return false;
    }
}
