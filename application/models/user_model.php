<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/31/13
 * Time: 9:58 AM
 * To change this template use File | Settings | File Templates.
 */
class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get($userid)
    {
        $query = $this->db->get_where('user', array('objectId' => $userid));
        $user = $query->row();
        return $user;
    }
}