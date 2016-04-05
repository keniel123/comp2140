<?php


/**
 *
 */
class Admin extends User
{

    /**
     * @var List<Order>
     */
    private $orders;

    /**
     * @return List<Product>
     */
    private function getAllProducts():List<Product>
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return List<Account>
     */
    private function viewCustomers():List<Account>
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return List<Order>
     */
    private function getSalesList():List<Order>
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return boolean
     */
    private function confirmOrder():boolean
    {
        // TODO: implement here
        return false;
    }
}
