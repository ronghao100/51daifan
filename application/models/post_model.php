<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/26/13
 * Time: 6:38 PM
 * To change this template use File | Settings | File Templates.
 */
class Post_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_posts()
    {
        $query = $this->db->query('SELECT p.*,u.realName,u.avatarThumbnail,u.address FROM post p,user u WHERE p.user = u.objectId ORDER BY eatDate DESC');
        $posts = $query->result();
        return $posts;
    }

    public function get_post_by_id($id)
    {
        $query = $this->db->get_where('post',array('objectId'=>(int)$id));
        $post = $query->row();
        return $post;
    }

    public function get_posts_by_user($userid)
    {
        $query = $this->db->order_by('eatDate','DESC')->get_where('post', array('user' => (int)$userid));
        $posts = $query->result();
        return $posts;
    }

    public function get_posts_count_by_user($userid)
    {
        $query = $this->db->query('SELECT count(*) as num FROM post WHERE user = ?',array((int)$userid));
        return $query->row()->num;
    }

    public function create($name, $describe, $count, $eatTime, $userid)
    {
        $eatDate = date("Y-m-d\TH:i:s.Z",$eatTime);

        $data = array(
            'name' => $name,
            'describe' => $describe,
            'count' => (int)$count,
            'bookedCount' => 0,
            'user' => (int)$userid,
            'eatDate' => $eatDate
        );

        $post = $this->db->insert('post',$data);
        return $post;
    }

}