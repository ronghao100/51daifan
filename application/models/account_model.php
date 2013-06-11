<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/25/13
 * Time: 11:00 PM
 * To change this template use File | Settings | File Templates.
 */
class Account_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function is_email_used($email)
    {
        $query = $this->db->get_where('user', array('email' => $email));
        $user = $query->result_array();
        return count($user);
    }

    public function register($realname, $password, $email)
    {
        $data = array(
            'realname' => $realname,
            'email' => $email,
            'username' => $email,
            'password' => md5($password)
        );
        $this->db->insert('user', $data);
        return $this->db->get_where('user', array('email' => $email))->row();
    }

    public function login($email, $password)
    {
        $query = $this->db->get_where('user', array('email' => $email, 'password' => md5($password)));
        $user = $query->row();
        if (count($user) == 0) {
            return FALSE;
        } else {
            return $user;
        }
    }

    public function set_avatar($userid, $file_name, $thumb_name)
    {
        $updatedDate = date("Y-m-d\TH:i:s.Z");
        return $this->db->query('UPDATE user SET avatar = ? , avatarThumbnail=? , updatedAt = ? WHERE objectId = ?', array($file_name, $thumb_name, $updatedDate, (int)$userid));
    }


}