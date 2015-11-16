<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function callback_order_status($order_status,$order_id){
    if($order_status == 'Pending'){
        return '<a href="#" class="update_order" data-orderid="' . $order_id . '">' . $order_status . '</a>';
    }else if($order_status == 'Created'){
        return '<a href="#" class="approve_order" data-orderid="' . $order_id . '">Approve Order</a>';
    }
    return $order_status;
}

function callback_vendor_pay_order($order_id,$order_amount){
    return '<input type="checkbox" value="' . $order_amount . '" class="a_pay_order_amt"/> ' . $order_id;
}

function callback_edit_item($type_id,$type_name){
    return '<a href="#" class="edit_item" data-typeid="'.$type_id.'" data-typename="'.$type_name.'"><i class="fa fa-edit"></i> Edit</a> |
                <a href="#" class="delete_item" data-typeid="'.$type_id.'"><i class="fa fa-remove"></i> Delete</a>';
}

function callback_edit_grade($grade_id,$grade_name){
    return '<a href="#" class="edit_grade" data-gradeid="'.$grade_id.'" data-gradename="'.$grade_name.'"><i class="fa fa-edit"></i> Edit</a> |
                <a href="#" class="delete_grade" data-gradeid="'.$grade_id.'"><i class="fa fa-remove"></i> Delete</a>';
}

function callback_update_area_code($user_id,$user_areacode){
    if(!empty($user_areacode)){
        return '<a href="#" class="update_area_code" data-userid="' . $user_id . '">' . $user_areacode . '</a>';
    }
    return '<a href="#" class="update_area_code" data-userid="' . $user_id . '">Enter Code</a>';
}

function callback_approve_user($user_id){
    return '<a href="#" class="approve_user" data-userid="'.$user_id.'" data-status="1">Approve</a>';
}

function callback_format_amount($amount){
    if($amount >= 0) {
        return '$' . number_format($amount, 0);
    }else{
        return '-$' . number_format(abs($amount),0);
    }
}