<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/31/13
 * Time: 9:58 AM
 * To change this template use File | Settings | File Templates.
 */
require_once 'parse/parse.php';
class User_model extends CI_Model
{
    public function get($userid)
    {
        $parse_object=new parseUser();
        $user = $parse_object->get($userid);
        return $user;
    }
}