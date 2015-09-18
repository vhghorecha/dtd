<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    class Vendor_Model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->library('Datatables');
        $this->load->model('user_model');
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
        $vendor_id = $this->get_vendor_id($this->user_model->get_current_user_id());
        $this->datatables->select("DATE_FORMAT(dtd_order.order_date,'%b-%d')as order_date,dtd_order.order_id,dtd_users.user_name,dtd_order.order_recipient,dtd_order.order_telno,dtd_item_type.type_name,dtd_order.order_itemname,dtd_cust.user_sercomp,dtd_users.user_mob,dtd_order.order_status")
            ->from('dtd_order')
            ->join('dtd_cust','dtd_cust.cust_id=dtd_order.order_custid')
            ->join('dtd_users','dtd_users.user_id=dtd_cust.user_id')
            ->join('dtd_item_type','dtd_item_type.type_id=dtd_order.order_typeid')
            ->where('dtd_order.order_vendorid',$vendor_id)
            ->edit_column('order_status','$1', 'callback_order_status(order_status,order_id)');
        return $this->datatables->generate();
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
                SELECT DATE_FORMAT(order_date,'%M-%d') as date, COUNT(Order_id) as num,SUM(order_amount) as amount
                FROM dtd_order
                WHERE order_date = '".$date->format("Y-m-d")."%' AND order_vendorid = ".$this->user_model->get_current_user_id()."
                GROUP BY order_date");
                $data['charge']= $query->row_array();

                $query=$this->db->query("
                SELECT COUNT(dep_id) as num, SUM(pay_amount) as amount
                FROM dtd_vendorpay
                WHERE pay_date = '".$date->format("Y-m-d")."%' AND pay_vendorid = ".$this->user_model->get_current_user_id()."
                GROUP BY pay_date");
                $data['recived'] = $query->first_row('array');

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
}
?>