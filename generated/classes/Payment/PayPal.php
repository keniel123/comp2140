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

    /**
     * @return String
     */
    public function getEmail():String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $email
     * @return boolean
     */
    public function setEmail(String $email):boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getPassword():String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $password
     * @return boolean
     */
    public function setPassword(String $password):boolean
    {
        // TODO: implement here
        return false;
    }
}
