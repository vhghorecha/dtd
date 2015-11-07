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
        $this->db->select('t1.user_name,t1.user_email,t1.user_mob,t1.user_add,t1.user_zipcode,t1.user_site,t1.user_memo,t2.vendor_comp,t2.vendor_hq1,t2.vendor_hq2,t2.vendor_hq3,t2.vendor_taxno,t2.pay_bankacno,t2.pay_bankname');
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
    public function get_vendor_id($user_id){
        $this->db->select('vendor_id');
        $this->db->from('dtd_vendor');
        $this->db->where('user_id',$user_id);
        return current($this->db->get()->row_array());
    }

    public function get_orders(){
        $this->load->helper('Datatable');
        $vendor_id = $this->user_model->get_current_user_id();
        $this->datatables->select("DATE_FORMAT(dtd_order.order_date,'%b-%d') as ord_date,dtd_order.order_id,dtd_users.user_name,dtd_order.order_recipient,dtd_order.order_telno,dtd_item_type.type_name,dtd_order.order_itemname,dtd_cust.user_sercomp,dtd_users.user_mob,dtd_order.order_status")
            ->from('dtd_order')
            ->join('dtd_cust','dtd_cust.user_id=dtd_order.order_custid')
            ->join('dtd_users','dtd_users.user_id=dtd_cust.user_id')
            ->join('dtd_item_type','dtd_item_type.type_id=dtd_order.order_typeid')
            ->where('dtd_order.order_vendorid',$vendor_id)
            ->where_in('dtd_order.order_status','Pending')
            ->edit_column('order_status','$1', 'callback_order_status(order_status,order_id)');
        return $this->datatables->generate();
    }
        public function get_del_orders(){
            $this->load->helper('Datatable');
            $vendor_id = $this->user_model->get_current_user_id();
            $this->datatables->select("DATE_FORMAT(dtd_order.order_date,'%b-%d') as ord_date,dtd_order.order_id,dtd_users.user_name,dtd_order.order_recipient,dtd_order.order_telno,dtd_item_type.type_name,dtd_order.order_itemname,dtd_cust.user_sercomp,dtd_users.user_mob,dtd_order.order_status")
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
         WHERE order_vendorid=$vendor_id AND order_date LIKE '".date('Y-m-d')."%' GROUP BY user_name");
        $result = $query->result_array();
        return $result;
    }
    public function get_daily_orders(){
        $this->db->select("DATE_FORMAT(dto.order_date, '%M-%d') as date,du.user_name as cust_name,
        (SELECT count(dto.order_id)from dtd_order do2 where do2.order_status = 'Delivered'
        AND do2.order_custid = dc.cust_id AND dto.order_id = do2.order_id) as delivered,
	    (SELECT count(dto.order_id) from dtd_order do2 where do2.order_status = 'Pending'
	    AND do2.order_custid = dc.cust_id AND dto.order_id = do2.order_id) as pending,
	    COUNT(dto.order_id) as subtotal");
        $this->db->from('dtd_order dto');
        $this->db->join('dtd_cust dc','dto.order_custid=dc.cust_id');
        $this->db->join('dtd_users du','dc.user_id=du.user_id');
        $this->db->where('dto.order_date >= LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH
  AND dto.order_date < LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY');
        $this->db->group_by('dto.order_custid, date');
        $query = $this->db->get()->result_array();
        return $query;
    }


    public function get_monthly_orders(){
        $this->db->select("DATE_FORMAT(dto.order_date, '%M') as date,du.user_name as cust_name,
        (SELECT count(dto.order_id)from dtd_order do2 where do2.order_status = 'Delivered'
        AND do2.order_custid = dc.cust_id AND dto.order_id = do2.order_id) as delivered,
	    (SELECT count(dto.order_id) from dtd_order do2 where do2.order_status = 'Pending'
	    AND do2.order_custid = dc.cust_id AND dto.order_id = do2.order_id) as pending,
	    COUNT(dto.order_id) as subtotal");
        $this->db->from('dtd_order dto');
        $this->db->join('dtd_cust dc','dto.order_custid=dc.cust_id');
        $this->db->join('dtd_users du','dc.user_id=du.user_id');
        $this->db->where('YEAR(dto.order_date)=YEAR(CURDATE())');
        $this->db->group_by('dto.order_custid, MONTH(dto.order_date)');
        $query = $this->db->get()->result_array();
        return $query;
    }

        public function get_user_account(){
            $result = array();
            $start = new DateTime("first day of this month");
            $end = new DateTime();
            $end = $end->modify("+1 day");
            $dates = new DatePeriod($start,new DateInterval("P1D"),$end);
            foreach($dates as $date){
                $data['date']=$date->format('M d');
                $query=$this->db->query("
                SELECT DATE_FORMAT(order_date,'%M-%d') as date, COUNT(order_id) as num,SUM(vendor_amount) as amount
                FROM dtd_order
                WHERE order_date LIKE '".$date->format("Y-m-d")."%' AND order_vendorid = ".$this->user_model->get_current_user_id()."
                GROUP BY order_date");
                $data['charge']= $query->row_array();

                $query=$this->db->query("
                SELECT COUNT(dep_id) as num, SUM(pay_amount) as amount
                FROM dtd_vendorpay
                WHERE pay_date LIKE '".$date->format("Y-m-d")."%' AND pay_vendorid = ".$this->user_model->get_current_user_id()."
                GROUP BY pay_date");
                $data['recived'] = $query->row_array();

                $result[]=$data;
            }
            return $result;
        }
        public function get_payment_history(){
            $query=$this->db->query("
            SELECT DATE_FORMAT(pay_date,'%d-%m-%Y') as pdate,pay_amount,pay_bankname
            FROM dtd_vendorpay WHERE pay_vendorid=3 GROUP BY pdate ORDER BY pay_date");
            $result = $query->result_array();
            return $result;
        }
        public function get_summary_info(){
            $vendor_id = $this->user_model->get_current_user_id();
            $this->db->select('order_id');
            $this->db->where('order_vendorid', $vendor_id);
            $this->db->where_in('order_status',array('Delivered','Pending'));
            $this->db->from('order');
            $data['count'] = $this->db->count_all_results();

            $this->db->select('order_id');
            $this->db->where(array('order_vendorid' => $vendor_id, 'order_status' => 'Pending'));
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

            $this->datatables->select("user_name, user_email, user_add, user_tel, user_mob, user_site, user_staffname, user_stafftel, user_balance")
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
}
?>