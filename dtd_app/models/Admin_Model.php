<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin_Model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->helper('Datatable');
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
    public function message_insert($data=null)
    {
        $this->db->insert('dtd_message',$data);
        return $this->db->insert_id();
    }

    public function get_rec_message(){

        $this->datatables->select("msg_id, msg_from,  msg_title, msg_desc, DATE_FORMAT(msg_date,'%b-%d') as msg_date")
            ->from('dtd_message')
            ->edit_column('msg_from','$1', 'callback_message_from(msg_from)')
            ->edit_column('msg_id','$1', 'callback_edit_message(msg_id,admin)')
            ->edit_column('msg_desc','$1','strip_tags(msg_desc)')
            ->where('msg_to', '0');
        return $this->datatables->generate();
    }

    public function delete_rec_message($msg_id)
    {
        $this->db->where('msg_id',$msg_id);
        $this->db->delete('message');
        return $this->db->affected_rows();
    }
    public function get_sent_message(){
        $cust_id = '0';
        $this->datatables->select("msg_to, msg_title, msg_desc, DATE_FORMAT(msg_date,'%b-%d') as msg_date, msg_id")
            ->from('dtd_message')
            ->edit_column('msg_to','$1', 'callback_message_to(msg_to)')
            ->edit_column('msg_id','$1', 'callback_send_message_delete(msg_id)')
            ->where('msg_from', $cust_id);
        return $this->datatables->generate();
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

    public function update_deposit($data, $dep_id){
        $this->db->where('dep_id', $dep_id);
        $this->db->update('custdep', $data);
    }

    public function update_payment($data, $dep_id){
        $this->db->where('dep_id', $dep_id);
        $this->db->update('vendorpay', $data);
    }

    public function get_daily_deposits(){
        $this->datatables->select('DATE_FORMAT(dep_date,"%b-%d")as depdate,user_name,dep_amount,dep_transno,dep_bankname,dep_id')
            ->from('custdep')
            ->join('users','users.user_id=custdep.dep_custid')
            ->edit_column('dep_amount','$1','callback_format_amount(dep_amount)')
            ->edit_column('dep_id','$1','callback_edit_deposit(dep_id)');
        return $this->datatables->generate();
    }

    public function get_daily_payments(){
        $this->datatables->select('DATE_FORMAT(pay_date,"%b-%d")as paydate,user_name,pay_amount,pay_transno,pay_bankacno,pay_bankname,dep_id,pay_orderids')
            ->from('vendorpay')
            ->join('users','users.user_id=vendorpay.pay_vendorid')
            ->edit_column('pay_amount','$1','callback_format_amount(pay_amount)')
            ->edit_column('dep_id','$1','callback_edit_payment(dep_id)')
            ->add_column('download','$1','callback_download_payment(dep_id)');
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

    public function get_edit_vendor($vp_id=null)
    {
        $this->db->select('dtd_vendorprice.vp_id,dtd_users.user_name,dtd_item_type.type_name,dtd_vendorprice.gp_price');
        $this->db->from('dtd_vendorprice');
        $this->db->join('dtd_users','dtd_users.user_id=dtd_vendorprice.gp_vendorid');
        $this->db->join('dtd_item_type','dtd_item_type.type_id=dtd_vendorprice.gp_typeid');
        $this->db->where('dtd_vendorprice.vp_id',$vp_id);
        $query=$this->db->get();
        return $query->row_array();
    }
    public function get_vendor_price(){
        $this->datatables->select('vp_id,user_id,user_name,type_id,type_name,gp_price,(gi_price-gp_price) as profit')
            ->from('vendorprice')
            ->join('users','users.user_id=vendorprice.gp_vendorid')
            ->join('itemprice','vendorprice.gp_typeid=itemprice.gi_type')
            ->join('item_type','itemprice.gi_type=item_type.type_id')
            ->edit_column('gp_price','$1','callback_format_amount(gp_price)')
            ->edit_column('profit','$1','callback_format_amount(profit)')
            ->add_column('edit','<a href="'.site_url('admin/editvendorprice/$1').'">Edit</a> | <a href="'.site_url('admin/deletevendorprice/$1').'" onClick="return confirm(\'Are you sure?\')">Delete</a>','vp_id');
        return $this->datatables->generate();
    }

    public function get_customer_grade(){
        $this->datatables->select('gp_id,CONCAT(DATE_FORMAT(gp_fromdt,"%d-%m-%Y")," to ",DATE_FORMAT(gp_todt,"%d-%m-%Y")) as term,gp_no_order,grade_name,gp_disc')
             ->from('gradeprice')
             ->join('cust_grade','gradeprice.gp_grade=cust_grade.grade_id')
             ->edit_column('gp_disc','$1','callback_format_amount(gp_disc)')
            ->add_column('edit','<a href="'.site_url('admin/editgradediscount/$1').'">Edit</a> | <a href="'.site_url('admin/deletegradediscount/$1').'" onClick="return confirm(\'Are you sure?\')">Delete</a>','gp_id');
        return $this->datatables->generate();
    }

    public function get_item_price(){
        $this->datatables->select('gi_id,type_name,gi_price,gi_type')
            ->from('itemprice')
            ->join('item_type','item_type.type_id=itemprice.gi_type')
            ->edit_column('gi_price','$1','callback_format_amount(gi_price)')
            ->add_column('edit','<a href="'.site_url('admin/editprice/$1').'">Edit</a> | <a href="'.site_url('admin/deleteprice/$1').'" onClick="return confirm(\'Are you sure?\')">Delete</a>','gi_id');
        return $this->datatables->generate();
   }

    public function get_item_types($gi_id=null)
    {
        $this->db->select('dtd_itemprice.gi_id,dtd_item_type.type_name,dtd_itemprice.gi_price');
        $this->db->from('dtd_item_type');
        $this->db->join('dtd_itemprice','dtd_itemprice.gi_type=dtd_item_type.type_id');
        $this->db->where('dtd_itemprice.gi_id',$gi_id);
        $query=$this->db->get();
        return $query->row_array();
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

    public function get_message($msgid){
        $this->db->select("DATE_FORMAT(msg_date,'%d/%m/%Y') as msg_date, msg_from, msg_desc,msg_title");
        $this->db->where('msg_id',$msgid);
        $query = $this->db->get('message');
        $message = $query->row_array();
        $message['msg_from'] = callback_message_from($message['msg_from']);
        $txtmessage = '<br/><br/>=============================<br/>';
        $txtmessage .= 'On ' . $message['msg_date'] . ', ' . $message['msg_from'] . ' wrote:<br/>' . $message['msg_desc'];
        return $txtmessage;
    }

    public function get_subject($msgid){
        $this->db->select("msg_title");
        $this->db->where('msg_id',$msgid);
        $query = $this->db->get('message');
        $message = $query->row_array();
        return $message['msg_title'];
    }

    public function get_from($msgid){
        $this->db->select("msg_from");
        $this->db->where('msg_id',$msgid);
        $query = $this->db->get('message');
        $message = $query->row_array();
        return $message['msg_from'];
    }

    public function delete_item($type_id){
        $this->db->where('type_id',$type_id);
        $this->db->delete('item_type');
        return $this->db->affected_rows();
    }

    public function delete_deposit($dep_id){
        $this->db->where('dep_id',$dep_id);
        $this->db->delete('custdep');
        return $this->db->affected_rows();
    }

    public function delete_payment($dep_id){
        $this->db->where('dep_id',$dep_id);
        $this->db->delete('vendorpay');
        return $this->db->affected_rows();
    }

    public function get_item_type(){
        //$type_ids = $this->general_model->get_single_val('GROUP_CONCAT(`gp_typeid`) as gi_type','vendorprice',array('gp_vendorid',$this->user_model->get_current_user_id()));
        $this->db->select('type_id,type_name');
        $this->db->from('item_type');
        //$this->db->where_not_in('type_id',explode(",",$type_ids));
        $query = $this->db->get();
        $itemids = array('');
        $itemnames = array('Select Item Type');
        foreach($query->result_array() as $item){
            $itemids[] = $item['type_id'];
            $itemnames[] = $item['type_name'];
        }
        return array_combine($itemids,$itemnames);
    }

    public function grade_price($data){
        $this->db->insert('gradeprice', $data);
        return $this->db->insert_id();
    }

    public function edit_grade_price($data=null,$gp_id=null)
    {
        $this->db->where('gp_id',$gp_id);
        $this->db->update('dtd_gradeprice',$data);
    }

    public function get_edit_grade_discount($gp_id=null)
    {
        $this->db->select('gp_id,DATE_FORMAT(gp_fromdt,\'%d/%m/%Y\') as gp_fromdt,DATE_FORMAT(gp_todt,\'%d/%m/%Y\') as gp_todt,gp_no_order,gp_disc');
        $this->db->from('dtd_gradeprice');
        $this->db->where('gp_id',$gp_id);
        $query=$this->db->get();
        return $query->row_array();

    }

    public function get_grade($gp_id=null)
    {
        $this->db->select('grade_name');
        $this->db->from('cust_grade');
        $this->db->join('dtd_gradeprice','dtd_gradeprice.gp_grade=cust_grade.grade_id');
        $this->db->where('dtd_gradeprice.gp_id',$gp_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    public function get_cust_grade(){
        $grade_ids = $this->general_model->get_single_val('GROUP_CONCAT(`gp_grade`) as gp_grade','gradeprice');
        $this->db->select('grade_id,grade_name');
        $this->db->from('cust_grade');
        $this->db->where_not_in('grade_id',explode(",",$grade_ids));
        $query = $this->db->get();
        $gradeids = array('');
        $gradenames = array('Select Grade');
        foreach($query->result_array() as $grade){
            $gradeids[] = $grade['grade_id'];
            $gradenames[] = $grade['grade_name'];
        }
        return array_combine($gradeids,$gradenames);
    }

    public function get_items(){
        $this->datatables->select('type_id,type_name')
             ->from('item_type')
            ->add_column('edit','$1','callback_edit_item(type_id,type_name)');
        return $this->datatables->generate();
    }

    public function add_grade($data){
        $this->db->insert('cust_grade', $data);
        return $this->db->insert_id();
    }

    public function edit_grade($data,$grade_id){
        $this->db->where('grade_id',$grade_id);
        $this->db->update('cust_grade', $data);
        return $this->db->affected_rows();
    }

    public function delete_grade($grade_id){
        $this->db->where('grade_id',$grade_id);
        $this->db->delete('cust_grade');
        return $this->db->affected_rows();
    }

    public function get_grades(){
        $this->datatables->select('grade_id,grade_name')
            ->from('cust_grade')
            ->add_column('edit','$1','callback_edit_grade(grade_id,grade_name)');
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
        $this->datatables->select("user_name, user_email, user_add, user_tel, user_comp, user_rep, user_site, user_staffname, user_stafftel, user_id")
            ->from("dtd_users")
            ->where("is_active",0)
            ->where("user_role","vendor")
            ->edit_column('user_id','$1','callback_approve_user(user_id)');
        return $this->datatables->generate();
    }

    //Created by Hardik Mehta
    public function get_pending_customers()
    {
        $this->datatables->select("user_name, user_email, user_add, user_tel, user_comp, user_rep, user_site, user_staffname, user_stafftel, dtd_users.user_id")
            ->from("dtd_users")
            ->join("dtd_cust", "dtd_cust.user_id = dtd_users.user_id")
            ->where("dtd_cust.vendor_id IS NOT NULL")
            ->where("is_active",0)
            ->where("user_role","customer")
            ->edit_column('user_id','$1','callback_approve_user(user_id)');
        return $this->datatables->generate();

    }
    public function get_pending_orders()
    {
        $this->db->select('order_id');
        $this->db->where_in('order_status',array('Created','Pending','Processing'));
        $this->db->from('dtd_order');
        return $this->db->count_all_results();
    }

    public function get_deposit($dep_id = null){
        if(is_null($dep_id)){
            $dep_id = $this->input->post('dep_id');
        }
        $this->db->select("*, DATE_FORMAT(dep_date,'%d/%m/%Y') as dep_date");
        $this->db->from('custdep');
        $this->db->join('users','users.user_id = custdep.dep_custid');
        $this->db->where('dep_id', $dep_id);
        return $this->db->get()->row_array();
    }

    public function get_payment($dep_id = null){
        if(is_null($dep_id)){
            $dep_id = $this->input->post('dep_id');
        }
        $this->db->select("*, DATE_FORMAT(pay_date,'%d/%m/%Y') as pay_date");
        $this->db->from('vendorpay');
        $this->db->join('users','users.user_id = vendorpay.pay_vendorid');
        $this->db->where('dep_id', $dep_id);
        return $this->db->get()->row_array();
    }

    public function get_customer_deposit()
    {
        $this->db->select_sum('dep_amount');
        $query = $this->db->get('dtd_custdep');
        return current($query->row_array());

    }
    public function get_vendor_payment()
    {
        $this->db->select_sum('pay_amount');
        $query = $this->db->get('dtd_vendorpay');
        return current($query->row_array());

    }
    public function get_created_orders()
    {
        $this->load->helper('Datatable');
        //$vendor_id = $this->user_model->get_current_user_id();
        $this->datatables->select("DATE_FORMAT(dtd_order.order_date,'%b-%d') as ord_date,dtd_order.order_id,dtd_users.user_name,dtd_order.order_recipient,dtd_order.order_telno,dtd_item_type.type_name,dtd_order.order_itemname,dtd_users.user_comp,dtd_users.user_rep,dtd_order.order_status")
            ->from('dtd_order')
            ->join('dtd_cust','dtd_cust.user_id=dtd_order.order_custid')
            ->join('dtd_users','dtd_users.user_id=dtd_cust.user_id')
            ->join('dtd_item_type','dtd_item_type.type_id=dtd_order.order_typeid')
            ->where('dtd_order.order_status','Created')
            ->edit_column('order_status','$1', 'callback_order_status_admin(order_status,order_id)');
        return $this->datatables->generate();
    }

    public function get_approved_orders()
    {
        $this->load->helper('Datatable');
        //$vendor_id = $this->user_model->get_current_user_id();
        $this->datatables->select("DATE_FORMAT(dtd_order.order_date,'%b-%d') as ord_date,dtd_order.order_id,dtd_users.user_name,dtd_order.order_recipient,dtd_order.order_telno,dtd_item_type.type_name,dtd_order.order_itemname,dtd_users.user_comp,dtd_users.user_rep,dtd_order.order_status")
            ->from('dtd_order')
            ->join('dtd_cust','dtd_cust.user_id=dtd_order.order_custid')
            ->join('dtd_users','dtd_users.user_id=dtd_cust.user_id')
            ->join('dtd_item_type','dtd_item_type.type_id=dtd_order.order_typeid')
            ->where('dtd_order.order_isapproved','1');
        return $this->datatables->generate();
    }

    public function set_user_balance($order_id=null)
    {
        $orderid=$order_id;
        $this->db->select('order_custid, order_amount');
        $this->db->where('order_id',$orderid);
        $result=$this->db->get('dtd_order');
        $res=$result->row_array();
        $this->Customer_Model->set_user_balance(-$res['order_amount'],$res['order_custid']);
    }
    //Created by Hardik Mehta
    public function get_all_customers()
    {
        $this->datatables->select("dtd_users.user_id, user_name, user_email, user_add, user_tel, user_comp, user_rep, user_site, user_staffname, user_stafftel, user_balance, user_areacode, grade_name, user_grade")
            ->from("dtd_users")
            ->join("dtd_cust", "dtd_cust.user_id=dtd_users.user_id")
            ->join("dtd_cust_grade", "dtd_cust_grade.grade_id=dtd_cust.user_grade", "left outer")
            ->where("is_active",1)
            ->where("user_role","customer")
            ->add_column('user_modify',"$1","callback_update_customer(user_id,user_areacode,user_grade)")
            ->add_column('user_vendor', "$1", "callback_get_vendor(user_id)");
        return $this->datatables->generate();
    }

    public function get_grade_drop(){
        $this->db->select('grade_id,grade_name');
        $this->db->from('cust_grade');
        $query = $this->db->get();
        $gradeids = array('');
        $gradenames = array('Select Grade');
        foreach($query->result_array() as $grade){
            $gradeids[] = $grade['grade_id'];
            $gradenames[] = $grade['grade_name'];
        }
        return array_combine($gradeids,$gradenames);
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

    public function get_pen_orders()
    {
        $this->load->helper('Datatable');

        $this->datatables->select("DATE_FORMAT(dtd_order.order_date,'%b-%d') as ord_date,dtd_order.order_id,dc.user_name as cust_name,dtd_order.order_recipient,dtd_order.order_telno,di.type_name,dtd_order.order_itemname,dv.user_email as vendor_name, dtd_order.order_status")
            ->from('dtd_order')
            ->join('dtd_users as dc','dc.user_id = dtd_order.order_custid')
            ->join('dtd_users as dv','dv.user_id = dtd_order.order_vendorid')
            ->join('dtd_item_type as di','di.type_id=dtd_order.order_typeid')
            ->where_in('order_status',array('Created','Pending','Processing'))
            ->edit_column('order_status','$1','callback_order_status_cust(order_status)');

        return $this->datatables->generate();
    }

    //Created by Hardik Mehta
    public function get_all_vendors()
    {
        $this->datatables->select("user_id, user_name, user_email, user_add, user_tel, user_comp, user_rep, user_site, user_staffname, user_stafftel, user_balance, user_areacode")
            ->from("dtd_users")
            ->where("is_active",1)
            ->where("user_role","vendor")
            ->edit_column('user_areacode',"$1","callback_update_area_code(user_id,user_areacode)");
        return $this->datatables->generate();
    }

    public function get_vendor_customers(){
        $this->datatables->select("vendor_id, user_name, user_email, user_add, user_tel, user_comp, user_rep, user_site, user_staffname, user_stafftel, user_balance")
            ->from("dtd_users")
            ->join("dtd_cust", "dtd_users.user_id = dtd_cust.user_id")
            ->where("is_active",1)
            ->where("user_role","customer");
        return $this->datatables->generate();
    }

    public function approve_user(){
        $user_id = $this->input->post('user_id');
        $this->db->where('user_id',$user_id);
        $this->db->set('is_active','1');
        $this->db->update('users');
        return $this->db->affected_rows();
    }

    public function get_money_paid(){
        $this->datatables->select("DATE_FORMAT(dtd_vendorpay.pay_date,'%b-%d') as pdate,dtd_users.user_name, dtd_vendorpay.pay_amount, dtd_vendorpay.pay_transno, dtd_vendorpay.pay_bankname")
            ->from("dtd_vendorpay")
            ->join("dtd_users", "dtd_users.user_id = dtd_vendorpay.pay_vendorid")
            ->edit_column('pay_amount','$1','callback_format_amount(pay_amount)');
        return $this->datatables->generate();
    }

    public function get_money_received(){
        $this->datatables->select("DATE_FORMAT(dtd_custdep.dep_date,'%b-%d') as ddate,dtd_users.user_name, dtd_custdep.dep_amount, dtd_custdep.dep_transno, dtd_custdep.dep_bankname")
            ->from("dtd_custdep")
            ->join("dtd_users", "dtd_users.user_id = dtd_custdep.dep_custid")
            ->edit_column('dep_amount','$1','callback_format_amount(dep_amount)');
        return $this->datatables->generate();
    }
    public function get_admin_account()
    {
        $result = array();
        $year = $this->input->post('year');
        if(empty($year)){
            $year = date("Y");
            $end = new DateTime();
        }else{
            $end = new DateTime("last day of december" . $year);
        }
        $start = new DateTime("first day of january" . $year);

        $dates = new DatePeriod($start,new DateInterval("P1M"),$end);
        foreach($dates as $date)
        {
            $data['date']=$date->format('M-Y');
            $query=$this->db->query("
                SELECT DATE_FORMAT(dep_date,'%Y-%M') as date, COUNT(dep_id) as num,SUM(dep_amount) as amount
                FROM dtd_custdep
                WHERE dep_date LIKE '".$date->format("Y-m")."%'
                GROUP BY date");
            $data['charge']= $query->row_array();


            $query=$this->db->query("
                SELECT DATE_FORMAT(pay_date,'%Y-%M') as date, COUNT(dep_id) as num, SUM(pay_amount) as amount
                FROM dtd_vendorpay
                WHERE pay_date LIKE '".$date->format("Y-m")."%'
                GROUP BY date");
            $data['recived'] = $query->row_array();

            $result[]=$data;
        }
        return $result;

    }

    public function get_admin_account_year()
    {
        $result = array();
        $start = new DateTime("first day of january 2015");
        $end = new DateTime();
        $dates = new DatePeriod($start,new DateInterval("P1Y"),$end);
        foreach($dates as $date)
        {
            $data['date']=$date->format('Y');
            $query=$this->db->query("
                SELECT DATE_FORMAT(dep_date,'%Y') as date, COUNT(dep_id) as num,SUM(dep_amount) as amount
                FROM dtd_custdep
                WHERE dep_date LIKE '".$date->format("Y")."%'
                GROUP BY date");
            $data['charge']= $query->row_array();


            $query=$this->db->query("
                SELECT DATE_FORMAT(pay_date,'%Y-%M') as date, COUNT(dep_id) as num, SUM(pay_amount) as amount
                FROM dtd_vendorpay
                WHERE pay_date LIKE '".$date->format("Y")."%'
                GROUP BY date");
            $data['recived'] = $query->row_array();

            $result[]=$data;
        }
        return $result;

    }
}
?>