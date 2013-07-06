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
        if ($this->is_sae) {
            $this->upload_path = 'avatar';
            $this->thumbnail_source_image_path = 'avatar/';
        } else {
            $this->upload_path = './uploads/';
            $this->thumbnail_source_image_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
        }
        $this->load->model('account_model');
        $this->load->model('post_model');
        $this->load->model('recipe_model');
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
                'post_count' => 0,
                'post_order_count' => 0,
                'recipe_count' => 0,
                'order_count' => 0,
                'avatar' => '',
                'avatar_thumbnail' => '',
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            redirect('index.php', 'refresh');
        }
    }

    public function rest_register()
    {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $data=array();
        if ($this->account_model->is_email_used($email)){
            $data['success']=0;
            $data['error']=1;
        }else{
            $user = $this->account_model->register($name, $password, $email);
            $data['success']=1;
            $data['error']=0;
            $data['user']['name']=$name;
            $data['user']['email']=$email;
            $data['user']['id']=$user->objectId;
            $data['user']['createdAt']=$user->createdAt;

        }
        echo json_encode($data);
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
            $recipe_count = $this->recipe_model->get_recipes_count_by_user($user->objectId);
            $order_count = $this->order_model->get_orders_count_by_user($user->objectId);

            $session_data = array(
                'username' => $user->username,
                'realname' => $user->realname,
                'post_count' => $post_count,
                'post_order_count' => $post_order_count,
                'recipe_count' => $recipe_count,
                'order_count' => $order_count,
                'userid' => $user->objectId,
                'avatar' => $user->avatar,
                'avatar_thumbnail' => $user->avatarThumbnail,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            redirect('index.php', 'refresh');
        }
    }

    public function rest_login()
    {
        $password = $_POST['password'];
        $email = $_POST['email'];

        $data=array();
        $user = $this->account_model->login($email, $password);
        if (!$user){
            $data['success']=0;
            $data['error']=1;
        }else{
            $data['success']=1;
            $data['error']=0;
            $data['user']['name']=$user->realname;
            $data['user']['email']=$email;
            $data['user']['id']=$user->objectId;
            $data['user']['createdAt']=$user->createdAt;

        }
        echo json_encode($data);
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('realname');
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('post_count');
        $this->session->unset_userdata('post_order_count');
        $this->session->unset_userdata('recipe_count');
        $this->session->unset_userdata('order_count');
        $this->session->unset_userdata('avatar');
        $this->session->unset_userdata('avatar_thumbnail');
        redirect('index.php', 'refresh');
    }

    public function avatar()
    {
        $data['title'] = 'avatar';
        $data['error'] = '';
        $this->set_session_data($data);
        $this->load->view('templates/header', $data);
        $this->load->view('avatar');
        $this->load->view('templates/footer');
    }

    public function upload_avatar()
    {
        $data['title'] = 'avatar';
        $data['error'] = '';
        $this->set_session_data($data);

        $this->upload_config['upload_path'] = $this->upload_path;
        $this->load->library('upload', $this->upload_config);

        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
            $this->load->view('templates/header', $data);
            $this->load->view('avatar');
            $this->load->view('templates/footer');
        } else {
            $upload_data = $this->upload->data();
            $image_url = 'http://' . $_SERVER['SERVER_NAME'] . '/uploads/' . $upload_data['file_name'];
            $image_thumbnail = $this->image_thumbnail($upload_data);
            $thumb_url = 'http://' . $_SERVER['SERVER_NAME'] . '/uploads/' . $image_thumbnail;

            if ($this->is_sae) {
                $image_url = $upload_data['file_url'];
                $image_url_array = explode('/',$image_url);
                $image_url_array[sizeof($image_url_array)-1]=$image_thumbnail;
                $thumb_url = join('/',$image_url_array);
            }

            $this->delete_image($this->avatar);
            $this->delete_image($this->avatar_thumbnail);

            $data['avatar'] = $image_url;
            $data['avatar_thumbnail'] = $thumb_url;
            $this->account_model->set_avatar($this->userid, $image_url, $thumb_url);
            $this->session->set_userdata('avatar', $image_url);
            $this->session->set_userdata('avatar_thumbnail', $thumb_url);

            $this->load->view('templates/header', $data);
            $this->load->view('avatar');
            $this->load->view('templates/footer');
        }
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