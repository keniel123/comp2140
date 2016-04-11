<?php


/**
 *
 */
class PayPal extends PaymentMethod
{

    /**
     * @var String
     */
    private $email;

    /**
     * @var String
     */
    private $password;
    
    public function __construct($email, $password){
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return String
     */
    public function getEmail()//String
    {
        return $this->email;
    }

    /**
     * @param String $email
     * @return boolean
     */
    public function setEmail($email)//boolean
    {
        $this->email = $email;
        return TRUE;
    }

    /**
     * @return String
     */
    public function getPassword()//String
    {
        return $this->password;
    }

    /**
     * @param String $password
     * @return boolean
     */
    public function setPassword($password)//boolean
    {
        $this->password = $password;
        return TRUE;
    }
}
