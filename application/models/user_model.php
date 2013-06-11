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

    public function edit_introduce($user_id,$intro)
    {
        $updatedDate = date("Y-m-d\TH:i:s.Z");
        return $this->db->query('UPDATE user SET introduce = ? , updatedAt = ? WHERE objectId = ?',array($intro,$updatedDate,(int)$user_id));
    }

    public function edit_address($user_id,$address)
    {
        $updatedDate = date("Y-m-d\TH:i:s.Z");
        return $this->db->query('UPDATE user SET address = ? , updatedAt = ? WHERE objectId = ?',array($address,$updatedDate,(int)$user_id));
    }
}