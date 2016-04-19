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
    public function setUsername($username){
        $old_username = $this->username;
        $this->username = $username;
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        $sql = "update account set username='$username' where username='$old_username';";
        $result = $database->update($sql);
        if($result > 0){
            return TRUE;
        }
        else {
            $this->username = $old_username;
            return FALSE;
        }
    }

    /**
     * @return String
     */
    public function getUsername(){
        return $this->username;
    }

    /**
     * @param String $password
     * @return boolean
     */
    public function setPassword($password){
        $old_password = $this->password;
        $this->password = $password;
        $hash = $this->get_user_hash();
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        $sql = "update account set password_hash='$hash' where username='$this->username';";
        $result = $database->update($sql);
        if($result > 0){
            return TRUE;
        }
        else {
            $this->password = $old_password;
            return FALSE;
        }
    }

    /**
     * @return String
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * @return boolean
     */
    public function logout(){
        session_unset();
        session_destroy();
        echo '<script>window.location.href = "?controller=pages&action=index";</script>';
    }

    /**
     * @return boolean
     */
    public function login($table){
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
    public function get_user_hash(){
        $hash = sha1($this->password);
        return $hash;
    }
    
    public function createAccount($email, $phone_number, $first_name, $last_name, $shipping_address){
        $database = new Database('localhost', 'pdo_ret', 'root', '');
        $account = new Account($this->username, $email, $this->password, $phone_number, 
                              $first_name, $last_name, $shipping_address);
        /* Create account */
        $sql = "insert into account values('$this->username', '$email', '" . $this->get_user_hash()
            . "', $phone_number, '$first_name', '$last_name');";
        $result = $database->update($sql);
        if($result < 1){
            return FALSE;
        }
        
        /* Create shipping address */
        $sql = "insert into address values('".$shipping_address->getAddressId()."',
        '".$shipping_address->getStreetAddress()."', '".$shipping_address->getCity()."',
        '".$shipping_address->getParish()."', '".$shipping_address->getPostalCode()."');";
        $result = $database->update($sql);
        if($result < 1){
            return FALSE;
        }
        
        /* Link shipping address to account */
        $sql = "insert into shipping_address values('$username', '".$shipping_address->getAddressId()."');";
        $result = $database->update($sql);
        if($result < 1){
            return FALSE;
        }
        
        /* Link account to cart */
        $sql = "insert into account_cart values('$username', '".$account->getCart()->getCartId()."');";
        $result = $database->update($sql);
        if($result < 1){
            return FALSE;
        }
        
        return TRUE;
    }
    
}
