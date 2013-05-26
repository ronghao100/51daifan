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

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));

        $this->logged_in = $this->session->userdata('logged_in');
        if ($this->logged_in) {
            $this->realname = $this->session->userdata('realname');
            $this->userid = $this->session->userdata('userid');
        }
    }

    public function set_session_data(&$data)
    {
        $data['logged_in'] = $this->logged_in;
        $data['userid'] = $this->userid;
        $data['realname'] = $this->realname;
    }

}