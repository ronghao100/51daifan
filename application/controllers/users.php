<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/31/13
 * Time: 9:46 AM
 * To change this template use File | Settings | File Templates.
 */
include 'base.php';

class Users extends Base
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('post_model');
        $this->load->model('order_model');
        $this->load->model('recipe_model');
    }

    public function comment($user_id)
    {
        $data['title'] = 'icomment';
        $this->set_session_data($data);

        $user = $this->user_model->get($user_id);
        $data['user']=$user;

        $data['post_count']=$this->post_model->get_posts_count_by_user($user_id);
        $data['post_order_count']=$this->order_model->get_orders_count_by_post_user($user_id);
        $data['order_count']=$this->order_model->get_orders_count_by_user($user_id);
        $data['recipe_count']=$this->recipe_model->get_recipes_count_by_user($user_id);

        $comments = $this->order_model->get_comments($user_id);
        $data['comments'] = $comments;

        $this->load->view('templates/header', $data);
        $this->load->view('user_header', $data);
        $this->load->view('user_comment', $data);
        $this->load->view('templates/footer', $data);
    }

    public function post($user_id)
    {
        $data['title'] = 'ipost';
        $this->set_session_data($data);

        $user = $this->user_model->get($user_id);
        $data['user']=$user;

        $data['post_count']=$this->post_model->get_posts_count_by_user($user_id);
        $data['post_order_count']=$this->order_model->get_orders_count_by_post_user($user_id);
        $data['order_count']=$this->order_model->get_orders_count_by_user($user_id);
        $data['recipe_count']=$this->recipe_model->get_recipes_count_by_user($user_id);

        $posts = $this->post_model->get_posts_by_user($user_id);
        $data['posts'] = $posts;

        $this->load->view('templates/header', $data);
        $this->load->view('user_header', $data);
        $this->load->view('user_post', $data);
        $this->load->view('templates/footer', $data);

    }

    public function order($user_id)
    {
        $data['title'] = 'iorder';
        $this->set_session_data($data);

        $user = $this->user_model->get($user_id);
        $data['user']=$user;

        $data['post_count']=$this->post_model->get_posts_count_by_user($user_id);
        $data['post_order_count']=$this->order_model->get_orders_count_by_post_user($user_id);
        $data['order_count']=$this->order_model->get_orders_count_by_user($user_id);
        $data['recipe_count']=$this->recipe_model->get_recipes_count_by_user($user_id);

        $orders = $this->order_model->get_orders_by_user($user_id);
        $data['orders'] = $orders;

        $this->load->view('templates/header', $data);
        $this->load->view('user_header', $data);
        $this->load->view('user_order', $data);
        $this->load->view('templates/footer', $data);

    }

    public function recipe($user_id)
    {
        $data['title'] = 'irecipe';
        $this->set_session_data($data);
        $user = $this->user_model->get($user_id);
        $data['user']=$user;

        $data['post_count']=$this->post_model->get_posts_count_by_user($user_id);
        $data['post_order_count']=$this->order_model->get_orders_count_by_post_user($user_id);
        $data['order_count']=$this->order_model->get_orders_count_by_user($user_id);
        $data['recipe_count']=$this->recipe_model->get_recipes_count_by_user($user_id);

        $recipes = $this->recipe_model->get_recipes_by_user($user_id);
        $data['recipes'] = $recipes;

        $this->load->view('templates/header', $data);
        $this->load->view('user_header', $data);
        $this->load->view('recipe/user_recipes', $data);
        $this->load->view('templates/footer', $data);

    }

    public function edit_introduce()
    {
        $intro = $this->input->post('introduce');
        echo $this->user_model->edit_introduce($this->userid, $intro);
    }

    public function edit_address()
    {
        $address = $this->input->post('address');
        echo $this->user_model->edit_address($this->userid, $address);
    }

}
