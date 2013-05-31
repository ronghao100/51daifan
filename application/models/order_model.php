<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronghao
 * Date: 5/27/13
 * Time: 9:34 PM
 * To change this template use File | Settings | File Templates.
 */
require_once 'parse/parse.php';

class Order_model extends CI_Model
{

    public function get_orders_by_user($userid)
    {
        $parse_query = new parseQuery('order');
        $parse_query->wherePointer('owner', '_User', $userid);
        $parse_query->orderByDescending('createdAt');
        $parse_query->whereInclude('foodOwner');
        $parse_query->whereInclude('food');
        $orders = $parse_query->find();
        return $orders;
    }

    public function get_orders_count_by_user($userid)
    {
        $parse_query = new parseQuery('order');
        $parse_query->wherePointer('owner', '_User', $userid);
        return $parse_query->getCount()->count;
    }

    public function get_orders_count_by_post_user($userid)
    {
        $parse_query = new parseQuery('order');
        $parse_query->wherePointer('foodOwner', '_User', $userid);
        return $parse_query->getCount()->count;
    }

    public function get_post_by_id($id)
    {
        $parse_object = new parseObject('food');
        $post = $parse_object->get($id);
        return $post;
    }

    public function create($food_id, $food_owner_id,$food_owner_name, $userid,$user_name)
    {
        $food['__type'] = 'Pointer';
        $food['className'] = 'food';
        $food['objectId'] = $food_id;

        $food_owner['__type'] = 'Pointer';
        $food_owner['className'] = '_User';
        $food_owner['objectId'] = $food_owner_id;

        $user['__type'] = 'Pointer';
        $user['className'] = '_User';
        $user['objectId'] = $userid;

        $food_post=new parseObject('food');
        $food_post->increment('bookedCount',1);
        $food_post->update($food_id);

        $parse_object = new parseObject('order');
        $parse_object->food = $food;
        $parse_object->foodOwner = $food_owner;
        $parse_object->foodOwnerName = $food_owner_name;
        $parse_object->owner = $user;
        $parse_object->ownerName = $user_name;
        $order = $parse_object->save();
        return $order;
    }

}