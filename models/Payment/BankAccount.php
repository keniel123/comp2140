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
    
    public function __construct($number, $bank, $type, $address){
        $this->accountNumber = $number;
        $this->bank = $bank;
        $this->accountType = $type;
        $this->address = $address;
    }


    /**
     * @return String
     */
    public function getAccountNumber()//String
    {
        return $this->accountNumber;
    }

    /**
     * @param String $accountNumber
     * @return boolean
     */
    public function setAccountNumber($accountNumber)//boolean
    {
        $this->accountNumber = $accountNumber;
        return TRUE;
    }

    /**
     * @return String
     */
    public function getBank()//String
    {
        return $this->bank;
    }

    /**
     * @return String
     */
    public function getAccountType()//String
    {
        return $this->accountType;
    }

    /**
     * @param String $accountType
     * @return boolean
     */
    public function setAccountType($accountType)//boolean
    {
        $this->accountType = $accountType;
        return TRUE;
    }

    /**
     * @return Address
     */
    public function getAddress()//Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return boolean
     */
    public function setAddress($address)//boolean
    {
        $this->address = $address;
        return TRUE;
    }
}
