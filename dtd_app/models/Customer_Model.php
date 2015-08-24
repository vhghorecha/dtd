<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_Model extends CI_Model{

    function __construct(){
        parent::__construct();
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
        $this->db->select('order_id');
        $this->db->select('order_date');
        $this->db->select('order_recipient');
        $this->db->select('order_mobno');
        $this->db->select('order_typeid');
        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());

        $query = $this->db->get();
        $result = $query->result();
        return $result;

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
    }
?>