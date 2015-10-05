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
        $query = $this->db->get();
        $custids = array('');
        $custnames = array('Select Customer');
        foreach($query->result_array() as $cust){
            $custids[] = $cust['user_id'];
            $custnames[] = $cust['user_name'];
        }
        return array_combine($custids,$custnames);
    }
	public function get_unallocated_customers(){
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
	
	public function get_vendor_bank($vendorid){
        $this->db->select('pay_bankacno,pay_bankname');
        $this->db->from('vendor');
        $this->db->where('user_id',$vendorid);
        $query = $this->db->get();
        return json_encode($query->row_array());
    }
    public function vendor_allocate($data,$userid){
        $this->db->where('user_id',$userid);
        $this->db->set('vendor_id',$data);
        $this->db->update('cust');
    }
    public function get_customerid($userid){
        $custid = $this->general_model->get_single_val('cust_id','cust',array('user_id' => $userid));
        return $custid;
    }
    public function customer_deposit($data){
        $this->db->insert('custdep',$data);
        return $this->db->insert_id();
    }
    public function get_daily_deposits(){
        $this->datatables->select('DATE_FORMAT(dep_date,"%b-%d")as depdate,user_name,,dep_amount,dep_transno,dep_bankname')
            ->from('custdep')
            ->join('users','users.user_id=custdep.dep_custid');
        return $this->datatables->generate();
    }
    public function get_daily_payments(){
        $this->datatables->select('DATE_FORMAT(pay_date,"%b-%d")as paydate,user_name,pay_amount,pay_transno,pay_bankname')
            ->from('dtd_vendorpay')
            ->join('users','users.user_id=vendorpay.pay_vendorid');
        return $this->datatables->generate();
    }
    public function get_vendorid($userid){
        $vendid = $this->general_model->get_single_val('vendor_id','vendor',array('user_id' => $userid));
        return $vendid;
    }
    public function vendor_pay($data){
        $this->db->insert('vendorpay',$data);
        return $this->db->insert_id();
    }
    public function vendor_price($data){
        $this->db->insert('vendorprice',$data);
        return $this->db->insert_id();
    }
    public function get_vendor_price(){
        $this->datatables->select('vp_id,user_id,user_name,type_id,type_name,gp_price,(gi_price-gp_price) as profit')
            ->from('vendorprice')
            ->join('users','users.user_id=vendorprice.gp_vendorid')
            ->join('itemprice','vendorprice.gp_typeid=itemprice.gi_type')
            ->join('item_type','itemprice.gi_type=item_type.type_id')
            ->add_column('edit','<a href="'.base_url().'admin/vendorprice">Edit</a> / <a href="#">Delete</a>');
        return $this->datatables->generate();
    }
    public function get_customer_grade(){
        $this->datatables->select('gp_id,CONCAT(DATE_FORMAT(gp_fromdt,"%d-%m-%Y")," to ",DATE_FORMAT(gp_todt,"%d-%m-%Y")) as term,gp_no_order,grade_name,gp_disc')
             ->from('gradeprice')
             ->join('cust_grade','gradeprice.gp_grade=cust_grade.grade_id')
             ->add_column('edit','<a href="'.base_url().'admin/grade">Edit</a> / <a href="#">Delete</a>');
        return $this->datatables->generate();
    }
    public function get_item_price(){
        $this->datatables->select('gi_id,type_name,gi_price,gi_type')
            ->from('itemprice')
            ->join('item_type','item_type.type_id=itemprice.gi_type')
            ->add_column('edit','<a href="'.base_url().'admin/item/$1">Edit</a> / <a href="#">Delete</a>');
        return $this->datatables->generate();
    }
    public function item_price($data){
        $this->db->where('gi_type', $data['gi_type']);
        $this->db->update('itemprice', $data);
        if($this->db->affected_rows()<1){
            $this->db->insert('itemprice', $data);
            return $this->db->insert_id();
        }
        return $this->db->affected_rows();
    }
    public function add_item($data){
        $this->db->insert('item_type', $data);
        return $this->db->insert_id();
    }
    public function edit_item($data,$type_id){
        $this->db->where('type_id',$type_id);
        $this->db->update('item_type', $data);
        return $this->db->affected_rows();
    }
    public function get_item_type(){
        $this->db->select('type_id,type_name');
        $this->db->from('item_type');
        $query = $this->db->get();
        $itemids = array('');
        $itemnames = array('Select Item Type');
        foreach($query->result_array() as $item){
            $itemids[] = $item['type_id'];
            $itemnames[] = $item['type_name'];
        }
        return array_combine($itemids,$itemnames);
    }
    public function get_items(){
        $this->datatables->select('type_id,type_name')
             ->from('item_type')
            ->add_column('edit','<a href="#" class="edit_item" data-typeid="type_id" data-typename="type_name">Edit</a>');
        return $this->datatables->generate();
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

    public function get_vendor_json(){
        $this->db->select('user_id,user_name');
        $this->db->where('user_role','vendor');
        $this->db->from('users');
        $query = $this->db->get();
        $states = array();
        foreach($query->result_array() as $state){
            $states[] = array($state['user_id'], $state['user_name']);
        }
        return json_encode($query->result_array());
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
        $this->datatables->select("vendor_id, user_name, user_email, user_add, user_tel, user_mob, user_site, user_staffname, user_stafftel, user_balance")
            ->from("dtd_users")
            ->join("dtd_cust", "dtd_users.user_id = dtd_cust.user_id")
            ->where("is_active",1)
            ->where("user_role","customer");
        return $this->datatables->generate();
    }
}
?>