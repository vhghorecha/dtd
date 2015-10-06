<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function callback_order_status($order_status,$order_id){
    if($order_status == 'Pending'){
        return '<a href="#" class="update_order" data-orderid="' . $order_id . '">' . $order_status . '</a>';
    }
    return $order_status;
}

function callback_edit_item($type_id,$type_name){
    return '<a href="#" class="edit_item" data-typeid="'.$type_id.'" data-typename="'.$type_name.'"><i class="fa fa-edit"></i> Edit</a> |
                <a href="#" class="delete_item" data-typeid="'.$type_id.'"><i class="fa fa-remove"></i> Delete</a>';
}

function callback_edit_grade($grade_id,$grade_name){
    return '<a href="#" class="edit_grade" data-gradeid="'.$grade_id.'" data-gradename="'.$grade_name.'"><i class="fa fa-edit"></i> Edit</a> |
                <a href="#" class="delete_grade" data-gradeid="'.$grade_id.'"><i class="fa fa-remove"></i> Delete</a>';
}

function callback_approve_user($user_id){
    return '<a href="#" class="approve_user" data-userid="'.$user_id.'" data-status="1">Approve</a>';
}