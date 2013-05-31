<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/25/13
 * Time: 8:21 PM
 * To change this template use File | Settings | File Templates.
 */
include 'base.php';

class Account extends Base
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('account_model');
        $this->load->model('post_model');
        $this->load->model('order_model');
    }

    public function register()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('realname', '姓名', 'required');
        $this->form_validation->set_rules('email', '邮箱', 'required|valid_email|callback_email_check');
        $this->form_validation->set_rules('password', '密码', 'required');
        $this->form_validation->set_rules('passwordconf', '确认密码', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = '注册';
            $this->set_session_data($data);
            $this->load->view('templates/header', $data);
            $this->load->view('register');
            $this->load->view('templates/footer');
        } else {
            $realname = $this->input->post('realname');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $user = $this->account_model->register($realname, $password, $email);
            $session_data = array(
                'username' => $email,
                'realname' => $realname,
                'userid' => $user->objectId,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            redirect('home', 'refresh');
        }
    }

    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', '邮箱', 'required|valid_email');
        $this->form_validation->set_rules('password', '密码', 'required|callback_account_check');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = '登录';
            $this->set_session_data($data);
            $this->load->view('templates/header', $data);
            $this->load->view('login');
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->account_model->login($email, $password);
            $post_count = $this->post_model->get_posts_count_by_user($user->objectId);
            $post_order_count = $this->order_model->get_orders_count_by_post_user($user->objectId);
            $order_count = $this->order_model->get_orders_count_by_user($user->objectId);

            $session_data = array(
                'username' => $user->username,
                'realname' => $user->realname,
                'post_count' => $post_count,
                'post_order_count' => $post_order_count,
                'order_count' => $order_count,
                'userid' => $user->objectId,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            redirect('home', 'refresh');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('realname');
        $this->session->unset_userdata('userid');
        redirect('home', 'refresh');
    }

    public function email_check($str)
    {
        if ($this->account_model->is_email_used($str)) {
            $this->form_validation->set_message('email_check', '该邮箱已经注册过了');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function account_check($str)
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if (!$this->account_model->login($email, $password)) {
            $this->form_validation->set_message('account_check', '亲，不记得账号密码了吗');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}