<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/26/13
 * Time: 6:38 PM
 * To change this template use File | Settings | File Templates.
 */
include 'parse/parse.php';

class Post_model extends CI_Model
{
    public $parse_query;

    public function __construct()
    {
        $this->parse_query = new parseQuery('food');
    }

    public function get_posts()
    {
        $now['__type'] = 'Date';
        $now['iso'] = date("Y-m-d\TH:i:s.Z");

        $parse_query = $this->parse_query;
        $parse_query->whereGreaterThan('eatDate', $now);
        $parse_query->whereInclude('user');
        $parse_query->orderByDescending('eatDate');
        $posts = $parse_query->find();
        return $posts;
    }

    public function get_post_by_id($id)
    {
        $parse_object = new parseObject('food');
//        $parse_object->addInclude('user');
        $post = $parse_object->get($id);
        return $post;
    }

    public function get_posts_by_user($userid)
    {
        $parse_query = $this->parse_query;
        $parse_query->wherePointer('user', '_User', $userid);
//        $parse_query->whereInclude('user');
        $parse_query->orderByDescending('eatDate');
        $posts = $parse_query->find();
        return $posts;
    }

    public function create($name, $describe, $count, $eatTime, $userid)
    {
        $user['__type'] = 'Pointer';
        $user['className'] = '_User';
        $user['objectId'] = $userid;

        $eatDate['__type'] = 'Date';
        $eatDate['iso'] = date("Y-m-d\TH:i:s.Z",$eatTime);

        $parse_object = new parseObject('food');
        $parse_object->name = $name;
        $parse_object->describe = $describe;
        $parse_object->count = (int)$count;
        $parse_object->bookedCount = 0;
        $parse_object->user = $user;
        $parse_object->eatDate = $eatDate;
        $post = $parse_object->save();
        return $post;
    }

}