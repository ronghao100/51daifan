<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/24/13
 * Time: 9:51 PM
 * To change this template use File | Settings | File Templates.
 */
class Pages extends CI_Controller{
    public function view($page='home')
    {
        if ( ! file_exists('application/views/'.$page.'.php'))
        {
            // 页面不存在
            show_404();
        }

        $data['title'] = ucfirst($page); // 将title中的第一个字符大写

        $this->load->view('templates/header', $data);
        $this->load->view($page, $data);
        $this->load->view('templates/footer', $data);
    }
}