<?php

require_once ('Database.php');
require_once ('/models/Merchant/User.php');
/**
 *
 */
class System
{
    /**
     * @var List<Product>
     */
    private $stock;
    
    /**
     *
     */
    public function __construct()
    {
    }
    
    public static function create_account(){
        
        //$database = Database();
        $sql = "insert into members values(2, 'user1', 'password', 'someone@example.com', 'Y', 'r', '','');";
        $result = Database::update($sql);
        return $result;
    }


    /**
     * @return boolean
     */
    public function generateToken()
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return boolean
     */
    public function updateStock()//:boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return boolean
     */
    public function deleteProduct()//:boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return boolean
     */
    public function editProduct()//:boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return boolean
     */
    public function addProduct()//:boolean
    {
        // TODO: implement here
        return false;
    }
}
