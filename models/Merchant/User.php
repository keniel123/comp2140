<?php


/**
 *
 */
class User
{
    /**
     * @var String
     */
    private $username='';

    /**
     * @var String
     */
    private $password='';
    
    /**
     *
     */
    public function __construct($user, $pass){
        $this->username = $user;
        $this->password = $pass;
    }

    /**
     * @param String $username
     * @return boolean
     */
    public function setUsername($username)//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getUsername()//String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $password
     * @return boolean
     */
    public function setPassword($password)//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    public function getPassword()//String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return boolean
     */
    public function logout()//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return boolean
     */
    public function login($table)//boolean
    {
        $hash = $this->get_user_hash();
        $sql = "select * from $table where username='$this->username' and password_hash='$hash';";
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        if (gettype($database->get_db()) != 'int'){
            $result = $database->query($sql);
            $result = count($result);
            if ($result > 0){
                return TRUE;
            } else {
                return FALSE;
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * @return String
     */
    public function get_user_hash()//String
    {
        $hash = sha1($this->password);
        return $hash;
    }

    /**
     * @return boolean
     */
    public function is_logged_in()//boolean
    {
        // TODO: implement here
        return false;
    }
}
