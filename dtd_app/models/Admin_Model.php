<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin_Model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->library('Datatables');
        $this->load->model('user_model');
        $this->load->model('general_model');
        $this->load->model('Vendor_Model');
        $this->load->model('Customer_Model');
    }
    public function get_customers(){
        $this->db->select('users.user_id,user_name');
        $this->db->from('cust');
        $this->db->join('users','users.user_id=cust.user_id');
        $this->db->where('cust.vendor_id IS NULL');
        $query = $this->db->get();
        $custids = array('');
        $custnames = array('Select Customer');
        foreach($query->result_array() as $cust){
            $custids[] = $cust['user_id'];
            $custnames[] = $cust['user_name'];
        }
        return array_combine($custids,$custnames);
    }
    public function get_vendors(){
        $this->db->select('users.user_id,user_name');
        $this->db->from('users');
        $this->db->where("user_role","vendor");
        $query = $this->db->get();
        $vendids = array('');
        $vendnames = array('Select Vendor');
        foreach($query->result_array() as $vend){
            $vendids[] = $vend['user_id'];
            $vendnames[] = $vend['user_name'];
        }
        return array_combine($vendids,$vendnames);
    }

    //Created By Hardik Mehta
    public function get_adm_pwd(){
        $this->db->select('admin_pass');
        $this->db->from('dtd_admin');
        $this->db->where('admin_id', $this->user_model->get_admin_id());
        $query = $this->db->get();
        $pwd['pwd'] = current($query->row_array());
        return $pwd;
    }

    //Created by Hardik Mehta
    public function get_pending_vendors()
    {
        $this->datatables->select("user_name, user_email, user_add, user_tel, user_mob, user_site, user_staffname, user_stafftel")
            ->from("dtd_users")
            ->where("is_active",0)
        ->where("user_role","vendor");
        return $this->datatables->generate();

    }

    //Created by Hardik Mehta
    public function get_pending_customers()
    {
        $this->datatables->select("user_name, user_email, user_add, user_tel, user_mob, user_site, user_staffname, user_stafftel")
            ->from("dtd_users")
            ->where("is_active",0)
            ->where("user_role","customer");
        return $this->datatables->generate();

    }

    //Created by Hardik Mehta
    public function get_all_customers()
    {
        $this->datatables->select("user_name, user_email, user_add, user_tel, user_mob, user_site, user_staffname, user_stafftel, user_balance")
            ->from("dtd_users")
            ->where("is_active",1)
            ->where("user_role","customer");
        return $this->datatables->generate();
    }

    //Created by Hardik Mehta
    public function get_all_vendors()
    {
        $this->datatables->select("user_name, user_email, user_add, user_tel, user_mob, user_site, user_staffname, user_stafftel, user_balance")
            ->from("dtd_users")
            ->where("is_active",1)
            ->where("user_role","vendor");
        return $this->datatables->generate();
    }
    public function get_vendor_customers(){
        $this->datatables->select("user_name, user_email, user_add, user_tel, user_mob, user_site, user_staffname, user_stafftel, user_balance")
            ->from("dtd_users")
            ->where("is_active",1)
            ->where("user_role","customer");
        return $this->datatables->generate();
    }
}
?>