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

function callback_edit_order($order_status, $order_id){
    if($order_status != 'Delivered'){
        return '<a href="' . site_url('customer/editorder') . '/' . $order_id .'">Edit</a> | <a href="' . site_url('customer/deleteorder') . '/' . $order_id . '" onClick="return confirm(\'Are you sure?\')">Delete</a>';
    }
    return '---';
}

function callback_vendor_pay_order($order_id,$order_amount){
    return '<input type="checkbox" name="order_id[' . $order_id . ']" value="' . $order_amount . '" class="a_pay_order_amt"/> ' . $order_id;
}

function callback_edit_item($type_id,$type_name){
    return '<a href="#" class="edit_item" data-typeid="'.$type_id.'" data-typename="'.$type_name.'"><i class="fa fa-edit"></i> Edit</a> |
                <a href="#" class="delete_item" data-typeid="'.$type_id.'"><i class="fa fa-remove"></i> Delete</a>';
}

function callback_edit_deposit($dep_id){
    return '<a href="'. site_url("admin/editdeposit/") . '/' . $dep_id . '" class="edit_item" data-depid="'.$dep_id.'">Edit</a> |
                <a href="#" class="delete_item" data-depid="'.$dep_id.'">Delete</a>';
}

function callback_edit_grade($grade_id,$grade_name){
    return '<a href="#" class="edit_grade" data-gradeid="'.$grade_id.'" data-gradename="'.$grade_name.'"><i class="fa fa-edit"></i> Edit</a> |
                <a href="#" class="delete_grade" data-gradeid="'.$grade_id.'"><i class="fa fa-remove"></i> Delete</a>';
}

function callback_update_area_code($user_id,$user_areacode)
{
    if (!empty($user_areacode)) {
        return '<a href="#" class="update_area_code" data-userarea="' . $user_areacode . '" data-userid="' . $user_id . '">' . $user_areacode . '</a>';
    }
    return '<a href="#" class="update_area_code" data-userid="' . $user_id . '">Enter Code</a>';
}

function callback_update_customer($user_id,$user_areacode,$user_grade){
    return '<a href="#" class="update_customer" data-userid="' . $user_id . '" data-usergrade="' . $user_grade . '" data-userarea="' . $user_areacode . '">Modify</a>';
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

function callback_message_from($from){
    if($from == '0'){
        $from = 'Administrator';
    }else{
        $CI =& get_instance();
        $CI->load->model('User_Model');
        $from = $CI->User_Model->get_username($from);
    }
    return $from;
}

function callback_message_to($to){
    switch($to){
        case '0':
            $to = 'Administrator';
            break;
        case 'all':
            $to = 'All';
            break;
        case 'allc':
        case 'allvc':
            $to = 'All Customers';
            break;
        case 'allv':
            $to = 'All Vendors';
            break;
        default:
            $CI =& get_instance();
            $CI->load->model('User_Model');
            $to = $CI->User_Model->get_username($to);
            break;
    }
    return $to;
}