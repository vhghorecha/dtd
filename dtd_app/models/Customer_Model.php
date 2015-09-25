<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('Datatables');
        $this->load->model('general_model');
    }

    public function insert($data)
    {
        $this->db->insert('cust', $data);
        return $this->db->insert_id();
    }

    public function get_item_type()
    {
        $this->db->select('type_id');
        $this->db->select('type_name');
        $this->db->from('dtd_item_type');
        $query = $this->db->get();
        $result = $query->result();

        $item_type_id = array('Select Item Type');
        $item_type_name = array('Select Item Type');

        for ($i = 0; $i < count($result); $i++) {
            array_push($item_type_id, $result[$i]->type_id);
            array_push($item_type_name, $result[$i]->type_name);
        }

        return $item_type = array_combine($item_type_id, $item_type_name);

    }

    public function get_single_val($select, $table, $where)
    {
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
            ->join('dtd_item_type', 'dtd_item_type.type_id=dtd_order.order_typeid')
            ->where('dtd_order.order_custid', $cust_id);
        return $this->datatables->generate();

    }



    public function get_user_profile()
    {
        $this->db->select('t1.user_name,t1.user_email,t1.user_add,t1.user_zipcode,t1.user_tel,t1.user_mob,t1.user_site,t1.user_staffname,t1.user_stafftel,t1.user_memo,t2.user_regno,t2.user_lob,t2.user_sercomp');
        $this->db->from('dtd_users t1');
        $this->db->join('dtd_cust t2', ' t1.user_id=t2.user_id');
        $this->db->where("t1.user_id", $this->user_model->get_current_user_id());
        return $this->db->get()->row_array();
    }

    public function get_user_pwd()
    {
        $this->db->select('user_pass');
        $this->db->from('dtd_users');
        $this->db->where('user_id', $this->user_model->get_current_user_id());
        $query = $this->db->get();
        $pwd['pwd'] = current($query->row_array());
        return $pwd;
    }

    public function get_user_balance()
    {
        $user_id = $this->user_model->get_current_user_id();
        $this->db->select('user_balance');
        $this->db->from('dtd_users');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $balance['bal'] = current($query->row_array());
        return $balance;
    }

    public function get_item_price($item_id)
    {
        $user_grade = $this->get_user_grade();
        $this->db->select('gi_price');
        $this->db->from('dtd_itemprice');
        $this->db->where('gi_type', $item_id);
        $query = $this->db->get();
        $item_price = current($query->row_array());

        $this->db->select('gp_disc');
        $this->db->from('dtd_gradeprice');
        $this->db->where('gp_id', $user_grade['grade']);
        $query = $this->db->get();
        $item_discount = current($query->row_array());

        $charges['charge'] = $item_price - (($item_price * $item_discount) / 100);
        return $charges;
    }

    public function set_user_balance($newbalance)
    {
        $user_id = $this->user_model->get_current_user_id();
        $data = array(
            'user_balance' => $newbalance
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('dtd_users', $data);
    }
    public function get_user_vendor_id()
    {
        $user_id = $this->user_model->get_current_user_id();
        $this->db->select('vendor_id');
        $this->db->from('dtd_cust');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $vendor_id= current($query->row_array());
        return $vendor_id;
    }

    public function get_user_grade()
    {
        $user_id = $this->user_model->get_current_user_id();
        $this->db->select('user_grade');
        $this->db->from('dtd_cust');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $user_grade['grade'] = current($query->row_array());
        return $user_grade;
    }

    public function get_today()
    {
        //counting today's total order
        $this->db->select('order_id');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->like('order_date', date('Y-m-d'));
        $today['count'] = $this->db->count_all_results();

        //counting the total changes of today
        $this->db->select_sum('order_amount');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->like('order_date', date('Y-m-d'));
        $query = $this->db->get('dtd_order');
        $today['sum'] = current($query->row_array());

        return $today;
    }

    public function get_monthly()
    {
        $this->db->select('order_id');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->like('order_date', date('Y-m'));
        $month['month-count'] = $this->db->count_all_results();

        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->where('order_status', 'Delivered');
        $this->db->like('order_date', date('Y-m'));
        $month['deliver'] = $this->db->count_all_results();

        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->where('order_status', 'Pending');
        $this->db->like('order_date', date('Y-m'));
        $month['pending'] = $this->db->count_all_results();

        $this->db->select_sum('order_amount');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->like('order_date', date('Y-m'));
        $query = $this->db->get('dtd_order');
        $month['amount'] = current($query->row_array());

        return $month;
    }

    public function get_user_charges()
    {
        $this->db->select_sum('order_amount');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->like('order_date', date('Y-m'));
        $query = $this->db->get('dtd_order');
        $month['amount'] = current($query->row_array());
    }

    public function get_all_orders()
    {
        $user_id = $this->user_model->get_current_user_id();
        $this->db->select('order_id');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $user_id);
        //$this->db->like('order_date', date('Y-m-d'));
        $all['count'] = $this->db->count_all_results();

        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $user_id);
        $this->db->where('order_status', 'Pending');
        $all['pending'] = $this->db->count_all_results();

        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $user_id);
        $this->db->where('order_status', 'Delivered');
        $all['deliver'] = $this->db->count_all_results();

        $all['balance'] = $this->general_model->get_single_val('user_balance', 'users', array('user_id' => $user_id));
        return $all;
    }

    public function get_user_account()
    {
        $cust_id = $this->user_model->get_current_user_id();
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
			WHERE order_date LIKE '".$date->format("Y-m-d")."%' AND order_custid = ". $cust_id ."
			GROUP BY order_date");
			$data['charge']= $query->row_array();

			$query=$this->db->query("
			SELECT COUNT(dep_id) as num, SUM(dep_amount) as amount
			FROM dtd_custdep
			WHERE dep_date LIKE '".$date->format("Y-m-d")."%' AND dep_custid = ". $cust_id ."
			GROUP BY dep_date");
			$data['recived'] = $query->row_array();

			$result[]=$data;
		}
		return $result;
    }
}

?>