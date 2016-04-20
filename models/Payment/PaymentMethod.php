<?php

/**
 * We were unable to access actual APIs for validation of payment methods without having access to
 * SSH/HTTPS, so we used a stub method
 */

/**
 *
 */
class PaymentMethod
{
    /**
     *
     */
    public function __construct(){
        //Empty constructor
    }





    /**
     * @return boolean
     */
    public function validatePayment(){
        //Stub method
        return TRUE;
    }
}
