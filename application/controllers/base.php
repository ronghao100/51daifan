<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/26/13
 * Time: 12:56 PM
 * To change this template use File | Settings | File Templates.
 */
class Base extends CI_Controller
{

    public $logged_in = FALSE;
    public $userid;
    public $realname;
    public $avatar;
    public $avatar_thumbnail;
    public $post_count;
    public $post_order_count;
    public $order_count;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));

        $this->logged_in = $this->session->userdata('logged_in');
        if ($this->logged_in) {
            $this->realname = $this->session->userdata('realname');
            $this->userid = $this->session->userdata('userid');
            $this->post_count = $this->session->userdata('post_count');
            $this->post_order_count = $this->session->userdata('post_order_count');
            $this->order_count = $this->session->userdata('order_count');
            $this->avatar = $this->session->userdata('avatar');
            $this->avatar_thumbnail = $this->session->userdata('avatar_thumbnail');
        }
    }

    public function set_session_data(&$data)
    {
        $data['logged_in'] = $this->logged_in;
        $data['userid'] = $this->userid;
        $data['realname'] = $this->realname;
        $data['post_count'] = $this->post_count;
        $data['post_order_count'] = $this->post_order_count;
        $data['order_count'] = $this->order_count;
        $data['avatar'] = $this->avatar;
        $data['avatar_thumbnail'] = $this->avatar_thumbnail;
    }

}