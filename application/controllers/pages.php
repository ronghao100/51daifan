<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/24/13
 * Time: 9:51 PM
 * To change this template use File | Settings | File Templates.
 */
include 'base.php';

class Pages extends Base
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
        $this->load->model('order_model');


    }

    public function show($page)
    {
        if ( ! file_exists('application/views/'.$page.'.php'))
        {
            // 页面不存在
            show_404();
        }

        $data['title'] = ucfirst($page); // 将title中的第一个字符大写
        $this->set_session_data($data);

        $this->load->view('templates/header', $data);
        $this->load->view($page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function view($page_num = 1)
    {
        if (!intval($page_num)) {
            show_404();
        }

        $data['active'] = 'home';
        $this->set_session_data($data);

        $page_config['perpage'] = 10; //每页条数
        $page_config['part'] = 2; //当前页前后链接数量
        $page_config['seg'] = 1; //参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
        $page_config['nowindex'] = $page_num; //当前页
        $this->load->library('my_page');
        $countnum = $this->post_model->get_posts_count(); //得到记录总数
        $page_config['total'] = $countnum;
        $this->my_page->initialize($page_config);

        $posts = $this->post_model->get_posts_by_page(($page_num - 1) * $page_config['perpage'], $page_config['perpage']);

        $post_ids = array();
        foreach ($posts as $post) {
            $post_ids[] = (int)$post->objectId;
        }

        $orders = $this->order_model->get_all_comments($post_ids);
        $orders_map = array();
        foreach ($orders as $order) {
            $post_id = $order->food;
            $orders_map[$post_id][] = $order;
        }

        foreach ($posts as $post) {
            if (array_key_exists($post->objectId, $orders_map)) {
                $post->orders = $orders_map[$post->objectId];
            } else {
                $post->orders = array();
            }
        }

        $data['posts'] = $posts;

        $this->load->view('templates/header', $data);
        $this->load->view('home', $data);
        $this->load->view('templates/footer', $data);
    }
}