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

    private $db;
    /**
     * @return List<Product>
     */
    private function getAllProducts()//List<Product>
    {
        $query_result = $db->query(
                    "SELECT *
                     FROM product
                      ORDER BY product_id ASC;"
                    );
        if ($query_result != false)
        {
                foreach ($query_result as $query_result) {
                        return $query_result
                }
        }
        return false;
    }
    

    /**
     * @return List<Account>
     */
    private function viewCustomers()//List<Account>
    {
        $query_result = $db->query(
                    "SELECT *
                     FROM account;"
                    );
        if ($query_result != false)
        {
                foreach ($query_result as $query_result) {
                        return $query_result
                }
        }
        return false;
    }

    /**
     * @return List<Order>
     */
    private function getSalesList()//List<Order>
    {
        $query_result = $db->query(
                    "SELECT DISTINCT orders.order_id,order_date,delivery_date , orderStatus,order_total,product.product_id,product_name,image,price,quantity_left
                     FROM orders JOIN order_product JOIN product
                     ON orders.order_id = order_product.order_id AND product.product_id = order_product.product_id;"
                    );
        if ($query_result != false)
        {
                foreach ($query_result as $query_result) {
                        return $query_result
                }
        }
        return false;
    }

    /**
     * @return boolean
     */
    private function confirmOrder($username)//boolean
    {
        $update_result = $db->update(
            "UPDATE orders JOIN account_order 
            ON orders.order_id = account_order.order_id WHERE account_order.username = '%s'  
            SET orderStatus = confirmed;",$username)
        
    }
}
