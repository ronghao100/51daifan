<?php
include 'parse/parse.php';
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/25/13
 * Time: 11:00 PM
 * To change this template use File | Settings | File Templates.
 */
class Account_model extends CI_Model
{

    public $parse_query;

    public function __construct()
    {
        $this->parse_query = new parseQuery('users');
    }

    public function is_email_used($email)
    {
        $this->parse_query->where('email', $email);
        $return = $this->parse_query->find();
        $user = $return->results;
        return count($user);
    }

    public function register($realname, $password, $email)
    {
        $parse_user = new parseUser;
        $user = $parse_user->signup($realname, $password, $email);
        return $user;
    }

    public function login($email, $password)
    {
        $parse_user = new parseUser;
        $parse_user->username = $email;
        $parse_user->password = $password;
        try {
            $user = $parse_user->login();
            return $user;
        } catch (ParseLibraryException $e) {
            return FALSE;
        }
    }


}