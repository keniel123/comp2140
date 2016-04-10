<?php


/**
 *
 */
class User
{
    /**
     * @var String
     */
    protected $username='';

    /**
     * @var String
     */
    protected $password='';
    
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
    protected function setUsername(String $username)//boolean
    {
        $this->password = $username;
    }

    /**
     * @return String
     */
    protected function getUsername()//String
    {
        return $this->username;
    }

    /**
     * @param String $password
     * @return boolean
     */
    protected function setPassword(String $password)//boolean
    {
        $this->password = $password;
    }

    /**
     * @return String
     */
    protected function getPassword()//String
    {
       return $this->password;
    }

    /**
     * @return boolean
     */
    public function logout()//boolean
    {
        session_destroy();
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
    protected function is_logged_in()//boolean
    {
        if(isset($_SESSION['username']) && $_SESSION['username'] == $this->username){
            return true;
        }   
    }
}
