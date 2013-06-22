<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/27/13
 * Time: 9:31 PM
 * To change this template use File | Settings | File Templates.
 */
include 'base.php';

class Orders extends Base
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
    }

    public function create()
    {
        $food_id = $this->input->post('foodId');
        $food_owner_id = $this->input->post('foodOwnerId');
        $food_owner_name = $this->input->post('foodOwnerName');
        $user_id = $this->session->userdata('userid');
        $user_name = $this->session->userdata('realname');

        $food = $this->order_model->get_post_by_id($food_id);
        if ($food->count <= $food->bookedCount) {
            redirect('badluck');
        } else {
            $this->order_model->create($food_id, $food_owner_id, $food_owner_name, $user_id, $user_name);
            redirect('index.php', 'refresh');
        }
    }

    public function comment()
    {
        $order_id = $this->input->post('order_id');
        $comment = $this->input->post('comment');
        echo $this->order_model->comment($order_id, $comment);
    }

    public function get_by_post()
    {
        $food_id = $this->input->get('food_id');
        $orders = $this->order_model->get_orders_by_post($food_id);
        echo json_encode($orders);
    }
}