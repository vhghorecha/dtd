<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_Model extends CI_Model{

    function __construct(){
        parent::__construct();
        $this->load->library('Datatables');
    }

    public function get_item_type()
    {
        $this->db->select('type_id');
        $this->db->select('type_name');
        $this->db->from('dtd_item_type');
        $query = $this->db->get();
        $result = $query->result();

        $item_type_id=array('Select Item Type');
        $item_type_name=array('Select Item Type');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($item_type_id, $result[$i]->type_id);
            array_push($item_type_name, $result[$i]->type_name);
        }

        return $item_type=array_combine($item_type_id,$item_type_name);

    }
    public function get_single_val($select,$table,$where){
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		return current($this->db->get()->row_array());
    }

    public function get_user_orders()
    {
        $cust_id = $this->User_Model->get_current_user_id();
        $this->datatables->select("dtd_order.order_id, DATE_FORMAT(dtd_order.order_date,'%d-%m-%Y') as order_date, dtd_order.order_recipient, dtd_order.order_telno, dtd_item_type.type_name, dtd_order.order_status")
            ->from('dtd_order')
            ->join('dtd_item_type','dtd_item_type.type_id=dtd_order.order_typeid')
            ->where('dtd_order.order_custid',$cust_id);
        return $this->datatables->generate();

    }
    public function get_user_profile()
    {
        $this->db->select('user_name');
        $this->db->select('user_email');
        $this->db->select('user_add');
        $this->db->select('user_zipcode');
        $this->db->select('user_tel');
        $this->db->select('user_mobile');
        $this->db->select('user_staffname');
        $this->db->select('user_stafftel');
        $this->db->select('user_memo');
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
    public function get_today()
    {
        //counting today's total order
        $this->db->select('order_id');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->like('order_date', date('Y-m-d'));
        $today['count']=$this->db->count_all_results();

        //counting the total changes of today
        $this->db->select_sum('order_amount');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->like('order_date', date('Y-m-d'));
        $query = $this->db->get('dtd_order');
        $today['sum']=current($query->row_array());

        return $today;
    }
    public function get_monthly()
    {
        $this->db->select('order_id');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->like('order_date', date('Y-m'));
        $month['month-count']=$this->db->count_all_results();

        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->where('order_status','Deliver');
        $this->db->like('order_date', date('Y-m'));
        $month['deliver']=$this->db->count_all_results();

        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->where('order_status','Pending');
        $this->db->like('order_date', date('Y-m'));
        $month['pending']=$this->db->count_all_results();

        $this->db->select_sum('order_amount');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->like('order_date', date('Y-m'));
        $query = $this->db->get('dtd_order');
        $month['amount']=current($query->row_array());

        return $month;
    }

    public function get_user_charges()
    {
        $this->db->select_sum('order_amount');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->like('order_date', date('Y-m'));
        $query = $this->db->get('dtd_order');
        $month['amount']=current($query->row_array());
    }
    public function get_all_orders()
    {
        $this->db->select('order_id');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        //$this->db->like('order_date', date('Y-m-d'));
        $all['count'] = $this->db->count_all_results();

        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->where('order_status','Pending');
        $all['pending']=$this->db->count_all_results();

        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->where('order_status','Deliver');
        $all['deliver']=$this->db->count_all_results();


        return $all;
    }

    public function get_user_account()
    {
        $cust_id = $this->user_model->get_current_user_id();
        $this->datatables->select("SELECT * FROM (
SELECT cust_id, DATE_FORMAT( dtd_order.order_date, '%M-%Y' ) AS ord_date, COUNT( order_id ), SUM(order_amount), count(dep_id), sum(dep_amount)
FROM dtd_cust
LEFT OUTER JOIN dtd_order ON dtd_order.order_custid = dtd_cust.cust_id
LEFT OUTER JOIN dtd_custdep ON dtd_custdep.dep_custid = dtd_cust.cust_id  AND DATE_FORMAT(dtd_custdep.dep_date, '%M-%Y') = DATE_FORMAT( dtd_order.order_date, '%M-%Y' )
GROUP BY ord_date
HAVING dtd_cust.cust_id = 2
UNION
SELECT cust_id, DATE_FORMAT( dtd_custdep.dep_date, '%M-%Y' ) AS ord_date, COUNT( order_id ), SUM(order_amount), count(dep_id), sum(dep_amount)
FROM dtd_cust
LEFT OUTER JOIN dtd_custdep ON dtd_custdep.dep_custid = dtd_cust.cust_id
LEFT OUTER JOIN dtd_order ON dtd_order.order_custid = dtd_cust.cust_id AND DATE_FORMAT(dtd_custdep.dep_date, '%M-%Y') = DATE_FORMAT( dtd_order.order_date, '%M-%Y' )
GROUP BY ord_date
HAVING dtd_cust.cust_id = 2
)");
        return $this->datatables->generate();
    }
    }
?>