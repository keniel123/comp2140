<?php


/**
 *
 */
class User
{
    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @var String
     */
    protected $username;

    /**
     * @var String
     */
    protected $password;

    /**
     * @param String $username
     * @return boolean
     */
    protected function setUsername(String $username)//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    protected function getUsername()//String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @param String $password
     * @return boolean
     */
    protected function setPassword(String $password)//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    protected function getPassword()//String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return boolean
     */
    protected function logout()//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return boolean
     */
    protected function login()//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return String
     */
    protected function get_user_hash()//String
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return boolean
     */
    protected function is_logged_in()//boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return \Account
     */
    public function createAccount()//\Account
    {
        // TODO: implement here
        return null;
    }
}
