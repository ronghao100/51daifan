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

    public $upload_path;
    public $thumbnail_source_image_path;
    public $is_sae = FALSE;

    public function __construct()
    {
        parent::__construct();
        if($this->is_sae)
        {
            $this->upload_path='avatar';
            $this->thumbnail_source_image_path='avatar/';
        }else{
            $this->upload_path='./uploads/';
            $this->thumbnail_source_image_path=$_SERVER['DOCUMENT_ROOT'] . '/uploads/';
        }
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
                'post_count' => 0,
                'post_order_count' => 0,
                'order_count' => 0,
                'avatar' => '',
                'avatar_thumbnail' => '',
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
                'avatar' => $user->avatar,
                'avatar_thumbnail' => $user->avatarThumbnail,
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
        $this->session->unset_userdata('post_count');
        $this->session->unset_userdata('post_order_count');
        $this->session->unset_userdata('order_count');
        $this->session->unset_userdata('avatar');
        $this->session->unset_userdata('avatar_thumbnail');
        redirect('home', 'refresh');
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

        $config['upload_path'] = $this->upload_path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['max_width'] = '2048';
        $config['max_height'] = '1600';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
            $this->load->view('templates/header', $data);
            $this->load->view('avatar');
            $this->load->view('templates/footer');
        } else {
            $upload_data = $this->upload->data();
            $image_url='http://'.$_SERVER['SERVER_NAME'].'/uploads/'.$upload_data['file_name'];
            $image_thumbnail = $this->image_thumbnail($upload_data);
            $thumb_url='http://'.$_SERVER['SERVER_NAME'].'/uploads/'. $image_thumbnail;

            if($this->is_sae){
                $image_url=$upload_data['file_url'];
                $s = new SaeStorage();
//                $s->delete($this->upload_path,$this->avatar);
                $thumb_url=$s->getUrl($this->upload_path, $image_thumbnail);
            }else{
//                unlink($this->upload_path . $this->avatar);
            }

            $data['avatar'] = $image_url;
            $data['avatar_thumbnail'] = $thumb_url;
            $this->account_model->set_avatar($this->userid, $image_url,$thumb_url);
            $this->session->set_userdata('avatar', $image_url);
            $this->session->set_userdata('avatar_thumbnail', $thumb_url);

            $this->load->view('templates/header', $data);
            $this->load->view('avatar');
            $this->load->view('templates/footer');
        }
    }

    public function image_thumbnail($upload_image)
    {
        $thumb_name = $upload_image['raw_name'] . '_thumb' . $upload_image['file_ext'];

        $thumbnail_config['source_image'] = $this->thumbnail_source_image_path . $upload_image['file_name'];
        $thumbnail_config['new_image'] = $this->thumbnail_source_image_path . $thumb_name;
        $thumbnail_config['maintain_ratio'] = FALSE;
        $thumbnail_config['width'] = 48;
        $thumbnail_config['height'] = 48;
        $this->load->library('image_lib', $thumbnail_config);
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        } else {
//            if($this->is_sae){
////                $s = new SaeStorage();
////                $s->delete($this->upload_path,$this->avatar_thumbnail);
//            }else{
////                unlink($this->upload_path . $this->avatar_thumbnail);
//            }
        }
        return $thumb_name;
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