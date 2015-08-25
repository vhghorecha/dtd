<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendor_Model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->library('Datatables');
    }
    public function get_vendor_profile($user_id){
        $this->db->select('t1.user_name,t1.user_email,t1.user_mob,t1.user_add,t1.user_site,t1.user_memo,t2.vendor_comp,t2.vendor_hq1,t2.vendor_hq2,t2.vendor_hq3,t2.vendor_taxno');
        $this->db->from('dtd_users t1');
        $this->db->join('dtd_vendor t2',' t1.user_id=t2.user_id');
        $this->db->where("t1.user_id=$user_id");
        return $this->db->get()->row_array();
    }
    public function get_user_pwd()
    {
        $this->db->select('user_pass');
        $this->db->from('dtd_users');
        $this->db->where('user_id', $this->User_Model->get_current_user_id());
        $query=$this->db->get();
        $pwd['pwd']=current($query->row_array());
        return $pwd;
    }
    public function get_vendor_id($user_id){
        $this->db->select('vendor_id');
        $this->db->from('dtd_vendor');
        $this->db->where('user_id',$user_id);
        return current($this->db->get()->row_array());
    }

    public function get_orders(){
        $vendor_id = $this->get_vendor_id($this->User_Model->get_current_user_id());
        $this->datatables->select("DATE_FORMAT(dtd_order.order_date,'%d-%m-%Y')as order_date,dtd_order.order_id,dtd_users.user_name,dtd_order.order_recipient,dtd_order.order_telno,dtd_item_type.type_name,dtd_order.order_itemname,dtd_cust.user_sercomp,dtd_users.user_mob")
            ->from('dtd_order')
            ->join('dtd_cust','dtd_cust.cust_id=dtd_order.order_custid')
            ->join('dtd_users','dtd_users.user_id=dtd_cust.user_id')
            ->join('dtd_item_type','dtd_item_type.type_id=dtd_order.order_typeid')
            ->where('dtd_order.order_vendorid',$vendor_id);
        return $this->datatables->generate();
    }
}
?>