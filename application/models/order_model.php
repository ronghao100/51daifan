<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/27/13
 * Time: 9:34 PM
 * To change this template use File | Settings | File Templates.
 */
class Order_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_orders_by_user($userid)
    {
        $query = $this->db->query('SELECT o.*,p.eatDate,p.name,p.describe,u.avatarThumbnail FROM orders o,post p,user u WHERE o.food = p.objectId AND o.foodOwner = u.objectId AND owner = ? ORDER BY createdAt DESC',
            array('owner' => (int)$userid));

        $orders = $query->result();
        return $orders;
    }

    public function get_orders_by_post($postid)
    {
        $query = $this->db->order_by('createdAt','DESC')->get_where('orders', array('food' => (int)$postid));
        $orders = $query->result();
        return $orders;
    }

    public function get_orders_count_by_user($userid)
    {
        $query = $this->db->query('SELECT count(*) as num FROM orders WHERE owner = ?',array((int)$userid));
        return $query->row()->num;
    }

    public function get_orders_count_by_post_user($userid)
    {
        $query = $this->db->query('SELECT count(*) as num FROM orders WHERE foodOwner = ?',array((int)$userid));
        return $query->row()->num;
    }

    public function get_post_by_id($id)
    {
        $query = $this->db->get_where('post', array('objectId' => $id));
        $post = $query->row();
        return $post;
    }

    public function create($food_id, $food_owner_id,$food_owner_name, $userid,$user_name)
    {
        $query=$this->db->query('SELECT bookedCount FROM post WHERE objectId = ?',array((int)$food_id));
        $bookedCount = $query->row()->bookedCount +1;
        $this->db->query('UPDATE post SET bookedCount = ? WHERE objectId = ?',array((int)$bookedCount,(int)$food_id));

        $data = array(
            'food' => $food_id,
            'foodOwner' => $food_owner_id,
            'foodOwnerName' => $food_owner_name,
            'owner' => $userid,
            'ownerName' => $user_name
        );

        $order = $this->db->insert('orders',$data);
        return $order;
    }

    public function comment($order_id,$comment)
    {
        $updatedDate = date("Y-m-d\TH:i:s.Z");
        return $this->db->query('UPDATE orders SET comment = ? , updatedAt = ? WHERE objectId = ?',array($comment,$updatedDate,(int)$order_id));
    }


    public function get_comments($userid)
    {
        $query = $this->db->query('SELECT o.*, u.avatarThumbnail FROM orders o ,user u WHERE o.owner = u.objectId AND o.foodOwner = ? AND comment IS NOT NULL ORDER BY updatedAt DESC',
            array((int)$userid));

        $orders = $query->result();
        return $orders;
    }

    public function get_all_comments($post_ids)
    {
        $query = $this->db->order_by('createdAt','DESC')->where_in('food',$post_ids)->get_where('orders');

        $orders = $query->result();
        return $orders;
    }

}