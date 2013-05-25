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

    public $parse_user;
    public $parse_query;

    public function __construct()
    {
        $this->parse_user = new parseUser;
        $this->parse_query = new parseQuery('users');
    }

    public function is_email_used($email)
    {
        $this->parse_query->where('email', $email);
        $return = $this->parse_query->find();
        $user = $return->results;
        return count($user);
    }

    public function register()
    {
        $this->load->helper('url');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $return = $this->parse_user->signup($username, $password, $email);
        $user = $return->results;
        return $user;
    }


}