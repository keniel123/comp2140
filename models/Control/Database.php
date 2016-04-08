<?php

/**
 *
 */
class Database
{

    /**
     * @return array
     */
    public static function query($sql)
    {
        try {
            //create PDO connection
            $db = new PDO("mysql:host=localhost;dbname=pdo_ret",'root','');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare($sql);
            $stmt->execute();
             $result = $stmt->fetchAll();
             return $result;
        } catch(PDOException $e) {
            //Return error
            return -1;
        }
    }

    /**
     * @return array
     */
    public static function update($sql)
    {
        try {
            //create PDO connection
            $db = new PDO("mysql:host=localhost;dbname=pdo_ret",'root','');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->rowCount();
        } catch(PDOException $e) {
            //Return error
            return -1;
        }
    }
}
?>