<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 6/15/13
 * Time: 10:29 PM
 * To change this template use File | Settings | File Templates.
 */
class Recipe_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function create($name, $describe, $user_id, $image1, $image2 = null, $image3 = null, $image4 = null, $image5 = null, $image6 = null)
    {
        $data = array(
            'name' => $name,
            'des' => $describe,
            'user' => (int)$user_id,
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'image4' => $image4,
            'image5' => $image5,
            'image6' => $image6
        );

        $post = $this->db->insert('recipes', $data);
        return $post;
    }

    public function get_recipes()
    {
        $query = $this->db->query('SELECT r.*,u.realName,u.avatarThumbnail FROM recipes r,user u WHERE r.user = u.objectId ORDER BY createdAt DESC');
        $posts = $query->result();
        return $posts;
    }

    public function get_recipes_by_user($user_id)
    {
        $query = $this->db->order_by('createdAt','DESC')->get_where('recipes', array('user' => (int)$user_id));
        $recipes = $query->result();
        return $recipes;
    }

    public function get_recipes_count_by_user($user_id)
    {
        $query = $this->db->query('SELECT count(*) as num FROM recipes WHERE user = ?',array((int)$user_id));
        return $query->row()->num;
    }

}