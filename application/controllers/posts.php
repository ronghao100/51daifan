<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/24/13
 * Time: 9:51 PM
 * To change this template use File | Settings | File Templates.
 */
include 'base.php';

class Posts extends Base
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
    }

    public function index()
    {
        if (!$this->logged_in) {
            redirect('/account/login', 'refresh');
        }

        $data['active'] = 'posts';
        $this->set_session_data($data);
        $posts = $this->post_model->get_posts_by_user($this->userid);
        $data['posts'] = $posts;

        $this->load->view('templates/header', $data);
        $this->load->view('posts', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', '菜名', 'required');
        $this->form_validation->set_rules('describe', '描述', 'required');
        $this->form_validation->set_rules('count', '数量', 'required');
        $this->form_validation->set_rules('eatDate', '带饭日期', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['active'] = 'posts';
            $this->set_session_data($data);
            $posts = $this->post_model->get_posts_by_user($this->userid);
            $data['posts'] = $posts;

            $this->load->view('templates/header', $data);
            $this->load->view('posts', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $name = $this->input->post('name');
            $describe = $this->input->post('describe');
            $count = $this->input->post('count');
            $eatDate = date_parse_from_format("Y-m-d", $this->input->post('eatDate'));
            $eatTime=mktime(13,0,0,$eatDate['month'],$eatDate['day'],$eatDate['year']);

            $this->post_model->create($name, $describe,$count, $eatTime,$this->userid);
            redirect('posts', 'refresh');
        }
    }
}