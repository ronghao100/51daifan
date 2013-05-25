<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/25/13
 * Time: 8:21 PM
 * To change this template use File | Settings | File Templates.
 */
class Account extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('account_model');
    }

    public function register()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', '姓名', 'required');
        $this->form_validation->set_rules('email', '邮箱', 'required|valid_email|callback_email_check');
        $this->form_validation->set_rules('password', '密码', 'required');
        $this->form_validation->set_rules('passwordconf', '确认密码', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('register');
            $this->load->view('templates/footer');
        }
        else
        {
            $this->account_model->register();
            redirect('home','refresh');
        }
    }

    public function email_check($str)
    {
        if ($this->account_model->is_email_used($str))
        {
            $this->form_validation->set_message('email_check', '该邮箱已经注册过了');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}