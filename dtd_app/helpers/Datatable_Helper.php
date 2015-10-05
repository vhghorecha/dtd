<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function callback_order_status($order_status,$order_id){
    if($order_status == 'Pending'){
        return '<a href="#" class="update_order" data-orderid="' . $order_id . '">' . $order_status . '</a>';
    }
    return $order_status;
}

function callback_edit($type_id,$type_name){
    return '<a href="#" class="edit_item" data-typeid="'.$type_id.'" data-typename="'.$type_name.'">Edit</a>';
    //            <a href="#" class="delete_item" data-typeid="'.$type_id.'">Delete</a>';
}