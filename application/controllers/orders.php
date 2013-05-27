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

    public function index()
    {
        if (!$this->logged_in) {
            redirect('/account/login', 'refresh');
        }

        $data['active'] = 'orders';
        $this->set_session_data($data);
        $orders = $this->order_model->get_orders_by_user($this->userid);
        $data['orders'] = $orders;

        $this->load->view('templates/header', $data);
        $this->load->view('orders', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create()
    {
        $food_id = $this->input->post('foodId');
        $food_owner_id = $this->input->post('foodOwnerId');
        $user_id = $this->session->userdata('userid');

        $this->order_model->create($food_id, $food_owner_id, $user_id);
        redirect('home', 'refresh');
    }
}