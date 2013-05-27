<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/24/13
 * Time: 9:51 PM
 * To change this template use File | Settings | File Templates.
 */
include 'base.php';

class Pages extends Base{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
    }

    public function view($page='home')
    {
        if ( ! file_exists('application/views/'.$page.'.php'))
        {
            // 页面不存在
            show_404();
        }
        $data['active'] = 'home';
        $this->set_session_data($data);

        $posts = $this->post_model->get_posts();
        $data['posts'] = $posts;

//        foreach($posts as $post)
//        {
//            foreach($post as $item)
//            {
//                echo var_dump($posts);
//                echo $item->name;
//            }
//        }

        $this->load->view('templates/header', $data);
        $this->load->view($page, $data);
        $this->load->view('templates/footer', $data);
    }
}