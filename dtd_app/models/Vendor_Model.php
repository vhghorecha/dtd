<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    class Vendor_Model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->library('Datatables');
        $this->load->model('user_model');
        $this->load->model('general_model');
    }
	public function insert($data){
		$this->db->insert('vendor',$data);
		return $this->db->insert_id();
	}
    public function get_vendor_profile($user_id){
        $this->db->select('t1.user_name,t1.user_email,t1.user_tel,t1.user_comp,t1.user_rep,t1.user_add,t1.user_zipcode,t1.user_site,t1.user_memo,t2.vendor_comp,t2.vendor_hq1,t2.vendor_hq2,t2.vendor_hq3,t2.vendor_taxno,t2.pay_bankacno,t2.pay_bankname');
        $this->db->from('dtd_users t1');
        $this->db->join('dtd_vendor t2',' t1.user_id=t2.user_id');
        $this->db->where("t1.user_id=$user_id");
        return $this->db->get()->row_array();
    }
    public function get_user_pwd()
    {
        $this->db->select('user_pass');
        $this->db->from('dtd_users');
        $this->db->where('user_id', $this->user_model->get_current_user_id());
        $query=$this->db->get();
        $pwd['pwd']=current($query->row_array());
        return $pwd;
    }
        public function get_customer_combo($vendor_id=null)
        {
            $this->db->select('users.user_id,users.user_name');
            $this->db->from('users');
            $this->db->join('cust','users.user_id=cust.user_id');
            $this->db->where("cust.vendor_id=$vendor_id");
            $query = $this->db->get();
            $custids = array('');
            $custnames = array('Select Customer');
            foreach($query->result_array() as $cust){
                $custids[] = $cust['user_id'];
                $custnames[] = $cust['user_name'];
            }
            return array_combine($custids,$custnames);
        }
    public function get_vendor_id($user_id){
        $this->db->select('vendor_id');
        $this->db->from('dtd_vendor');
        $this->db->where('user_id',$user_id);
        return current($this->db->get()->row_array());
    }

    public function get_ord_rec(){
        $this->load->helper('Datatable');
        $vendor_id = $this->user_model->get_current_user_id();
        $this->datatables->select("DATE_FORMAT(dtd_order.order_date,'%b-%d') as ord_date,dtd_order.order_id,dtd_users.user_name,dtd_order.order_recipient,dtd_order.order_telno,dtd_item_type.type_name,dtd_order.order_itemname,dtd_users.user_comp,dtd_users.user_rep,dtd_order.order_status")
            ->from('dtd_order')
            ->join('dtd_cust','dtd_cust.user_id=dtd_order.order_custid')
            ->join('dtd_users','dtd_users.user_id=dtd_cust.user_id')
            ->join('dtd_item_type','dtd_item_type.type_id=dtd_order.order_typeid')
            ->where('dtd_order.order_vendorid',$vendor_id)
            ->where_in('dtd_order.order_status',array('Pending','Processing'))
            ->edit_column('order_status','$1', 'callback_order_status(order_status,order_id)');
        return $this->datatables->generate();
    }

    public function get_orders(){
        $this->load->helper('Datatable');
        $vendor_id = $this->user_model->get_current_user_id();
        $this->datatables->select("DATE_FORMAT(dtd_order.order_date,'%b-%d') as ord_date,dtd_order.order_id,dtd_users.user_name,dtd_order.order_recipient,dtd_order.order_telno,dtd_item_type.type_name,dtd_order.order_itemname,dtd_users.user_comp,dtd_users.user_rep,dtd_order.order_status")
            ->from('dtd_order')
            ->join('dtd_cust','dtd_cust.user_id=dtd_order.order_custid')
            ->join('dtd_users','dtd_users.user_id=dtd_cust.user_id')
            ->join('dtd_item_type','dtd_item_type.type_id=dtd_order.order_typeid')
            ->where('dtd_order.order_vendorid',$vendor_id)
            ->edit_column('order_status','$1', 'callback_order_status(order_status,order_id)');
        return $this->datatables->generate();
    }

    public function get_del_orders(){
        $this->load->helper('Datatable');
        $vendor_id = $this->user_model->get_current_user_id();
        $this->datatables->select("DATE_FORMAT(dtd_order.order_date,'%b-%d') as ord_date,dtd_order.order_id,dtd_users.user_name,dtd_order.order_recipient,dtd_order.order_telno,dtd_item_type.type_name,dtd_order.order_itemname,dtd_cust.user_sercomp,dtd_users.user_comp,dtd_users.user_rep,dtd_order.order_status")
            ->from('dtd_order')
            ->join('dtd_cust','dtd_cust.user_id=dtd_order.order_custid')
            ->join('dtd_users','dtd_users.user_id=dtd_cust.user_id')
            ->join('dtd_item_type','dtd_item_type.type_id=dtd_order.order_typeid')
            ->where('dtd_order.order_vendorid',$vendor_id)
            ->where_in('dtd_order.order_status','Delivered')
            ->edit_column('order_status','$1', 'callback_order_status(order_status,order_id)');
        return $this->datatables->generate();
    }
    public function get_day_orders(){
        $vendor_id = $this->user_model->get_current_user_id();
         $query = $this->db->query("
         SELECT user_name,COUNT(order_id) as num,SUM(vendor_amount) as amount
         FROM dtd_order JOIN dtd_users ON order_custid=user_id
         WHERE order_vendorid=$vendor_id AND order_date LIKE '".date('Y-m-d')."%' and order_status!='Created' GROUP BY user_name");
        $result = $query->result_array();
        return $result;
    }
    public function get_day_iorders(){
        $vendor_id = $this->user_model->get_current_user_id();
        $query = $this->db->query("
     SELECT type_name,COUNT(order_id) as num,SUM(vendor_amount) as amount
     FROM dtd_order JOIN dtd_item_type ON order_typeid=type_id
     WHERE order_vendorid=$vendor_id AND order_date LIKE '".date('Y-m-d')."%' and order_status!='Created' GROUP BY type_name");
        $result = $query->result_array();
        return $result;
    }
    public function get_daily_orders(){
        $vendor_id = $this->user_model->get_current_user_id();
        $qday = $this->input->post('day');
        if(empty($qday)){
            $qday = date('Y-m-d');
        }else{
            $qday = date_create_from_format("d/m/Y", $qday);
            $qday = $qday->format("Y-m-d");
        }
        $this->db->select("DATE_FORMAT(dto.order_date, '%b-%d') as date,du.user_name as cust_name,
        (SELECT count(do2.order_id)from dtd_order do2 where do2.order_status = 'Delivered'
        AND do2.order_custid = dc.user_id AND do2.order_date LIKE '{$qday}%') as delivered,
	    (SELECT count(do2.order_id) from dtd_order do2 where do2.order_status = 'Processing'
	    AND do2.order_custid = dc.user_id AND do2.order_date LIKE '{$qday}%') as processing,
	    (SELECT count(do2.order_id) from dtd_order do2 where do2.order_status = 'Pending'
	    AND do2.order_custid = dc.user_id AND do2.order_date LIKE '{$qday}%') as pending,
	    COUNT(dto.order_id) as subtotal");
        $this->db->from('dtd_order dto');
        $this->db->join('dtd_cust dc','dto.order_custid=dc.user_id');
        $this->db->join('dtd_users du','dc.user_id=du.user_id');
        $this->db->like("dto.order_date",$qday);
        $this->db->where('dto.order_vendorid', $vendor_id);
        $this->db->group_by('cust_name');
        $query = $this->db->get()->result_array();
        return $query;
    }


    public function get_monthly_orders(){
        $vendor_id = $this->user_model->get_current_user_id();
        $qmonth = $this->input->post('month');
        if(empty($qmonth)){
            $qmonth = date('Y-m');
        }
        $this->db->select("DATE_FORMAT(dto.order_date, '%Y-%m') as date,du.user_name as cust_name,
        (SELECT count(do2.order_id)from dtd_order do2 where do2.order_status = 'Delivered'
        AND do2.order_custid = dc.user_id AND do2.order_date LIKE '{$qmonth}%') as delivered,
	    (SELECT count(do2.order_id) from dtd_order do2 where do2.order_status = 'Processing'
	    AND do2.order_custid = dc.user_id AND do2.order_date LIKE '{$qmonth}%') as processing,
	    (SELECT count(do2.order_id) from dtd_order do2 where do2.order_status = 'Pending'
	    AND do2.order_custid = dc.user_id AND do2.order_date LIKE '{$qmonth}%') as pending,
	    COUNT(dto.order_id) as subtotal");
        $this->db->from('dtd_order dto');
        $this->db->join('dtd_cust dc','dto.order_custid=dc.user_id');
        $this->db->join('dtd_users du','dc.user_id=du.user_id');
        $this->db->like("dto.order_date", $qmonth);
        $this->db->where('dto.order_vendorid', $vendor_id);
        $this->db->group_by('cust_name');
        $query = $this->db->get()->result_array();
        return $query;
    }

        public function get_user_account(){
            $vendor_id = $this->user_model->get_current_user_id();
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
                SELECT DATE_FORMAT(order_date,'%Y-%M') as date, COUNT(order_id) as num,SUM(vendor_amount) as amount
                FROM dtd_order
                WHERE order_status='Delivered' and order_date LIKE '".$date->format("Y-m")."%' AND order_vendorid = " . $vendor_id . "
                GROUP BY date");
                $data['charge']= $query->row_array();


                $query=$this->db->query("
                SELECT DATE_FORMAT(pay_date,'%Y-%M') as date,COUNT(dep_id) as num, SUM(pay_amount) as amount
                FROM dtd_vendorpay
                WHERE pay_date LIKE '".$date->format("Y-m")."%' AND pay_vendorid = ". $vendor_id ."
                GROUP BY date");
                $data['recived'] = $query->row_array();

                $result[]=$data;
            }
            return $result;
        }

        public function get_user_account_year(){
            $vendor_id = $this->user_model->get_current_user_id();
            $result = array();
            $start = new DateTime("first day of january 2015");
            $end = new DateTime();
            $dates = new DatePeriod($start,new DateInterval("P1Y"),$end);
            foreach($dates as $date)
            {
                $data['date']=$date->format('Y');
                $query=$this->db->query("
                SELECT DATE_FORMAT(order_date,'%Y') as date, COUNT(order_id) as num,SUM(vendor_amount) as amount
                FROM dtd_order
                WHERE order_status='Delivered' and order_date LIKE '". $date->format("Y") . "%' AND order_vendorid = " . $vendor_id . "
                GROUP BY date");
                $data['charge']= $query->row_array();

                $query=$this->db->query("
                SELECT DATE_FORMAT(pay_date,'%Y') as date,COUNT(dep_id) as num, SUM(pay_amount) as amount
                FROM dtd_vendorpay
                WHERE pay_date LIKE '". $date->format("Y") . "%' AND pay_vendorid = ". $vendor_id ."
                GROUP BY date");
                $data['recived'] = $query->row_array();

                $result[]=$data;
            }
            return $result;
        }

        public function get_payment_history(){
            $vendor_id=$this->user_model->get_current_user_id();
            $query=$this->db->query("
            SELECT DATE_FORMAT(pay_date,'%d-%m-%Y') as pdate,pay_amount,pay_bankname
            FROM dtd_vendorpay WHERE pay_vendorid=$vendor_id GROUP BY pdate ORDER BY pay_date");
            $result = $query->result_array();
            return $result;
        }
        public function get_summary_info(){
            $vendor_id = $this->user_model->get_current_user_id();
            $this->db->select('order_id');
            $this->db->where('order_vendorid', $vendor_id);
            $this->db->where('order_status','Pending');
            $this->db->from('order');
            $data['count'] = $this->db->count_all_results();

            $this->db->select('order_id');
            $this->db->where('order_vendorid', $vendor_id);
            $this->db->where('order_status','Processing');
            $this->db->from('order');
            $data['pending'] = $this->db->count_all_results();

            $this->db->select('order_id');
            $this->db->where(array('order_vendorid' => $vendor_id, 'order_status' => 'Delivered'));
            $this->db->from('order');
            $data['deliver'] = $this->db->count_all_results();

            $data['balance'] = $this->general_model->get_single_val('user_balance', 'users', array('user_id' => $vendor_id));
            return $data;
        }

        public function update_order($data,$order_id){
            $this->db->where('order_id',$order_id);
            $this->db->update('order', $data);
            return $this->db->affected_rows();
        }

        public function get_customers()
        {
            $vendor_id = $this->user_model->get_current_user_id();


            $this->datatables->select("user_name, user_email, user_add, user_tel, user_comp, user_rep, user_site, user_staffname, user_stafftel")
                ->from("dtd_users")
                ->join('dtd_cust','dtd_cust.user_id=dtd_users.user_id')
                ->where('dtd_cust.vendor_id',$vendor_id)
                ->where("is_active",1)
                ->where("user_role","customer");

            return $this->datatables->generate();
        }

        public function set_user_balance($newbalance, $user_id = null)
        {
            if(is_null($user_id)){
                $user_id = $this->user_model->get_current_user_id();
            }
            $this->db->set('user_balance', 'user_balance + ' . $newbalance, false);
            $this->db->where('user_id', $user_id);
            $this->db->update('dtd_users');
        }

        public function get_vendor_amount($order_id=null)
        {
            $this->db->select('vendor_amount');
            $this->db->from('dtd_order');
            $this->db->where('order_id', $order_id);
            $query = $this->db->get();
            $vendor_amount = current($query->row_array());
            return $vendor_amount;
        }

        public function get_ven_orders($vendor_id = ''){
            $this->load->helper('Datatable');
            $this->datatables->select("dtd_order.order_id,DATE_FORMAT(dtd_order.order_date,'%b-%d') as ord_date,dtd_order.vendor_amount,dtd_users.user_name,dtd_order.order_recipient,dtd_order.order_telno,dtd_item_type.type_name,dtd_order.order_itemname")
                ->from('dtd_order')
                ->join('dtd_cust','dtd_cust.user_id=dtd_order.order_custid')
                ->join('dtd_users','dtd_users.user_id=dtd_cust.user_id')
                ->join('dtd_item_type','dtd_item_type.type_id=dtd_order.order_typeid')
                ->where('dtd_order.order_vendorid',$vendor_id)
                ->where('dtd_order.order_status','Delivered')
                ->where('dtd_order.vendor_paid', '0')
                ->edit_column('order_id','$1', 'callback_vendor_pay_order(order_id,vendor_amount)');
            return $this->datatables->generate();
        }
        public function get_rec_message(){
            $cust_id = $this->User_Model->get_current_user_id();
            //$vendor_id = $this->get_user_vendor_id();
            $msg_to = array($cust_id, 'all', 'allv');
            $this->datatables->select("msg_id, msg_from, msg_title, msg_desc, DATE_FORMAT(msg_date,'%b-%d') as msg_date")
                ->from('dtd_message')
                ->edit_column('msg_from','$1', 'callback_message_from(msg_from)')
                ->edit_column('msg_id','$1', 'callback_edit_message(msg_id,vendor)')
                ->edit_column('msg_desc','$1','strip_tags(msg_desc)')
                ->where_in('msg_to', $msg_to);
            return $this->datatables->generate();
        }
        public function get_sent_message(){
            $cust_id = $this->User_Model->get_current_user_id();
            $this->datatables->select("msg_id, DATE_FORMAT(msg_date,'%b-%d') as msg_date, msg_title, msg_desc, msg_to")
                ->from('dtd_message')
                ->edit_column('msg_to','$1', 'callback_message_to(msg_to)')
                ->where('msg_from', $cust_id);
            return $this->datatables->generate();
        }
}
?>