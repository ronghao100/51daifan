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
    public $avatar;
    public $avatar_thumbnail;
    public $post_count;
    public $post_order_count;
    public $recipe_count;
    public $order_count;

    public $upload_path;
    public $upload_config;
    public $thumbnail_source_image_path;
    public $is_sae = FALSE;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));

        $this->logged_in = $this->session->userdata('logged_in');
        if ($this->logged_in) {
            $this->realname = $this->session->userdata('realname');
            $this->userid = $this->session->userdata('userid');
            $this->post_count = $this->session->userdata('post_count');
            $this->post_order_count = $this->session->userdata('post_order_count');
            $this->recipe_count = $this->session->userdata('recipe_count');
            $this->order_count = $this->session->userdata('order_count');
            $this->avatar = $this->session->userdata('avatar');
            $this->avatar_thumbnail = $this->session->userdata('avatar_thumbnail');
        }

        $this->upload_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->upload_config['max_size'] = '2048';
        $this->upload_config['max_width'] = '2048';
        $this->upload_config['max_height'] = '1600';
        $this->upload_config['encrypt_name'] = TRUE;
    }

    public function set_session_data(&$data)
    {
        $data['logged_in'] = $this->logged_in;
        $data['userid'] = $this->userid;
        $data['realname'] = $this->realname;
        $data['post_count'] = $this->post_count;
        $data['post_order_count'] = $this->post_order_count;
        $data['recipe_count'] = $this->recipe_count;
        $data['order_count'] = $this->order_count;
        $data['avatar'] = $this->avatar;
        $data['avatar_thumbnail'] = $this->avatar_thumbnail;
    }

    public function image_thumbnail($upload_image, $width = 48, $height = 48)
    {
        $thumb_name = $upload_image['raw_name'] . '_thumb' . $upload_image['file_ext'];

        $thumbnail_config['source_image'] = $this->thumbnail_source_image_path . $upload_image['file_name'];
        $thumbnail_config['new_image'] = $this->thumbnail_source_image_path . $thumb_name;
        $thumbnail_config['maintain_ratio'] = FALSE;
        $thumbnail_config['width'] = $width;
        $thumbnail_config['height'] = $height;
        $this->load->library('image_lib', $thumbnail_config);
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
        return $thumb_name;
    }

    public function delete_image($image_url)
    {
        if ($image_url) {
            $per_image_array = explode('/', $image_url);
            if ($this->is_sae) {
                //no more user can set avatar frequently, so cancel delete function for effective
//                $s = new SaeStorage();
//                $s->delete($this->upload_path, $per_image_array[count($per_image_array) - 1]);
            } else {
                unlink($this->upload_path . $per_image_array[count($per_image_array) - 1]);
            }
        }
    }

}