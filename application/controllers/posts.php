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

    public function create()
    {
        if (!$this->logged_in) {
            redirect('/account/login', 'refresh');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', '菜名', 'required');
        $this->form_validation->set_rules('describe', '描述', 'required');
        $this->form_validation->set_rules('count', '数量', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('eatDate', '带饭日期', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['active'] = 'posts';
            $this->set_session_data($data);

            $this->load->view('templates/header', $data);
            $this->load->view('post/create', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $name = $this->input->post('name');
            $describe = $this->input->post('describe');
            $count = $this->input->post('count');
            $eatDate = date_parse_from_format("Y-m-d", $this->input->post('eatDate'));
            $eatTime = mktime(13, 0, 0, $eatDate['month'], $eatDate['day'], $eatDate['year']);

            $this->post_model->create($name, $describe, $count, $eatTime, $this->userid);
            redirect('index.php', 'refresh');
        }
    }

    public function rest_view()
    {
        $type = $_GET['type'];
        $current_id = isset($_GET['currentId']) ? $_GET['currentId'] : 1;

        $data['success'] = 1;
        $data['error'] = 0;

        $posts = array();

        //o-> first load 1->refresh latest rows 2->refresh old rows
        if ($type == 0) {
            $posts = $this->post_model->get_first_posts(0, 10);
        } elseif ($type == 1) {
            $posts = $this->post_model->get_latest_posts($current_id);
        } elseif ($type == 2) {
            $posts = $this->post_model->get_old_posts($current_id);
            echo $posts;
        }

        $data['posts'] = $posts;
        header('Content-Type: application/json');

        echo json_encode($data);

    }
}