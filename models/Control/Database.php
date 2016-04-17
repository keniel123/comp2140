<?php

/**
 *
 */
class Database
{
    private $db;
    
    public function __construct($host, $dbname, $user, $pass){
        try{
            //create PDO connection
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            $this->db = -1;
            print $e->getMessage();
        }
    }
    
    public function get_db(){
        return $this->db;
    }

    /**
     * @return array
     */
    public function query($sql){
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch(PDOException $e) {
            //Return error
            return -1;
            print $e->getMessage();
        }
    }

    /**
     * @return array
     */
    public function update($sql){
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->rowCount();
        } catch(PDOException $e) {
            //Return error
            return -1;
            print $e->getMessage();
        }
    }
    
    public function beginTransaction(){
        $this->db->beginTransaction();
    }
    
    public function commitChanges(){
        $this->db->commit();
    }
    
    public function rollbackUpdate(){
        $status = $this->db->rollBack();
        return $status;
    }
}
?>