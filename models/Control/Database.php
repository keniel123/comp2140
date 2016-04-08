<?php

/**
 *
 */
class Database
{
    private $db;
    
    /**
     *
     */
    public function __construct($dbhost, $dbname, $dbuser, $dbpass)
    {
        try {
                //create PDO connection
                $this->$db = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
                $this->$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return 0;
        } catch(PDOException $e) {
            //Return error
            return -1;
        }
    }

    /**
     * @return ResultSet
     */
    public function query($sql)
    {
        try {
            $stmt = $this->$db->prepare($sql);
            $stmt->execute();
             $result = $stmt->fetchAll();
             return $result;
        } catch(PDOException $e) {
            //Return error
            return -1;
        }
    }

    /**
     * @return ResultSet
     */
    public function update($sql)
    {
        try {
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