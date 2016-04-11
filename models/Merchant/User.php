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
        $this->username = $username;
        return false;
    }

    /**
     * @return String
     */
    public function getUsername()//String
    {
        return $this->username;
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

    /**
     * @return String
     */
    public function getPassword()//String
    {
        return $this->password;
    }

    /**
     * @return boolean
     */
    public function logout()//boolean
    {
        // TODO: implement here
        return TRUE;
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
}
