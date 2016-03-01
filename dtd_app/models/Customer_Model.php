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

        $item_type_id = array('');
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
        $row = $this->db->get()->row_array();
        if (!is_null($row)) {
            return current($row);
        }
        return null;
    }

    public function get_user_orders()
    {
        $cust_id = $this->User_Model->get_current_user_id();
        $this->datatables->select("dtd_order.order_id, DATE_FORMAT(dtd_order.order_date,'%b-%d') as order_date, dtd_order.order_recipient, dtd_order.order_telno, dtd_item_type.type_name, dtd_order.order_status, dtd_order.order_updatecode, dtd_order.vendor_reason")
            ->from('dtd_order')
            ->join('dtd_item_type', 'dtd_item_type.type_id=dtd_order.order_typeid')
            ->add_column('modify','$1','callback_edit_order(order_status,order_id)')
            ->edit_column('order_status', '$1', 'callback_order_status_cust(order_status)')
            ->where('dtd_order.order_custid', $cust_id);
        return $this->datatables->generate();

    }

    public function get_user_orders_pen()
    {
        $cust_id = $this->User_Model->get_current_user_id();
        $this->datatables->select("dtd_order.order_id, DATE_FORMAT(dtd_order.order_date,'%b-%d') as order_date, dtd_order.order_recipient, dtd_order.order_telno, dtd_item_type.type_name, dtd_order.order_status, dtd_order.order_updatecode, dtd_order.vendor_reason")
            ->from('dtd_order')
            ->join('dtd_item_type', 'dtd_item_type.type_id=dtd_order.order_typeid')
            ->add_column('modify','$1','callback_edit_order(order_status,order_id)')
            ->edit_column('order_status', '$1', 'callback_order_status_cust(order_status)')
            ->where_in('dtd_order.order_status', array('Created', 'Pending'))
            ->where('dtd_order.order_custid', $cust_id);
        return $this->datatables->generate();

    }

    public function get_user_orders_pro()
    {
        $cust_id = $this->User_Model->get_current_user_id();
        $this->datatables->select("dtd_order.order_id, DATE_FORMAT(dtd_order.order_date,'%b-%d') as order_date, dtd_order.order_recipient, dtd_order.order_telno, dtd_item_type.type_name, dtd_order.order_status, dtd_order.order_updatecode, dtd_order.vendor_reason")
            ->from('dtd_order')
            ->join('dtd_item_type', 'dtd_item_type.type_id=dtd_order.order_typeid')
            ->add_column('modify','$1','callback_edit_order(order_status,order_id)')
            ->edit_column('order_status', '$1', 'callback_order_status_cust(order_status)')
            ->where('dtd_order.order_status', 'Processing')
            ->where('dtd_order.order_custid', $cust_id);
        return $this->datatables->generate();

    }

    public function get_user_orders_del()
    {
        $cust_id = $this->User_Model->get_current_user_id();
        $this->datatables->select("dtd_order.order_id, DATE_FORMAT(dtd_order.order_date,'%b-%d') as order_date, dtd_order.order_recipient, dtd_order.order_telno, dtd_item_type.type_name, dtd_order.order_status, dtd_order.order_updatecode, dtd_order.vendor_reason")
            ->from('dtd_order')
            ->join('dtd_item_type', 'dtd_item_type.type_id=dtd_order.order_typeid')
            ->add_column('modify','$1','callback_edit_order(order_status,order_id)')
            ->edit_column('order_status', '$1', 'callback_order_status_cust(order_status)')
            ->where_in('dtd_order.order_status', array('Delivered', 'Returned', 'Cancelled'))
            ->where('dtd_order.order_custid', $cust_id);
        return $this->datatables->generate();

    }
    public function get_edit_order($order_id)
    {
        $this->db->select('order_id, order_recipient, order_address, order_telno, order_mobno, order_date, order_itemname, order_desc, order_memo,type_name')
            ->from('dtd_order')
            ->join('dtd_item_type','dtd_order.order_typeid=dtd_item_type.type_id')
            ->where('order_id',$order_id)
            ->where_in('order_status',array('Created','Pending'));
        return $this->db->get()->row_array();
    }

    public function get_user_profile()
    {
        $this->db->select('t1.user_name,t1.user_email,t1.user_add,t1.user_zipcode,t1.user_tel,t1.user_comp,t1.user_rep,t1.user_site,t1.user_staffname,t1.user_stafftel,t1.user_memo,t2.user_regno,t2.user_lob,t2.user_sercomp,t3.user_name as "vendor_name",t3.user_email as "vendor_email", t3.user_tel as "vendor_tel", t3.user_rep as "vendor_rep", t3.user_add as "vendor_add", t3.user_zipcode as "vendor_zipcode"');
        $this->db->from('dtd_users t1');
        $this->db->join('dtd_cust t2', ' t1.user_id=t2.user_id');
        $this->db->join('dtd_users t3',' t3.user_id = t2.vendor_id');
        $this->db->where("t1.user_id", $this->user_model->get_current_user_id());
        return $this->db->get()->row_array();
    }

    public function get_user_vendor($user_id){
        $this->db->select('t3.*');
        $this->db->from('dtd_users t1');
        $this->db->join('dtd_cust t2', ' t1.user_id=t2.user_id');
        $this->db->join('dtd_users t3',' t3.user_id = t2.vendor_id');
        $this->db->where("t1.user_id", $user_id);
        return $this->db->get()->row_array();
    }

    public function set_vendor_price($typeid=null,$vendor_id=null)
    {
        $this->db->select('gp_price');
        $this->db->from('dtd_vendorprice');
        $this->db->where('gp_vendorid',$vendor_id);
        $this->db->where_in('gp_typeid',$typeid);
        $query=$this->db->get();
        $result = $query->row_array();
        if(!is_null($result)){
            return current($result);
        }
        return 0;
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
        $balance = current($query->row_array());
        return $balance;
    }

    public function get_item_price($item_id)
    {
        $user_grade = $this->get_user_grade();
        $this->db->select('gi_price');
        $this->db->from('dtd_itemprice');
        $this->db->where('gi_type', $item_id);
        $query = $this->db->get();
        //$row_price = current($query->row_array());
        $row_price = $query->row_array();
        if(!is_null($row_price))
        {
            $item_price= current($row_price);
        }
        else
        {
            $item_price = 0;
        }
        //$item_price = current($query->row_array());

        $this->db->select('gp_disc');
        $this->db->from('dtd_gradeprice');
        $this->db->where('gp_id', $user_grade['grade']);
        $query = $this->db->get();
        $rows_item = $query->row_array();
        if(!is_null($rows_item))
        {
            $item_discount = current($rows_item);
        }
        else
        {
            $item_discount = 0;
        }
        //$item_discount = current($query->row_array());
        $charges = $item_price - (($item_price * $item_discount) / 100);
        return $charges;
    }

    public function set_user_balance($newbalance, $user_id = null)
    {
        if(is_null($user_id)){
            $user_id = $this->user_model->get_current_user_id();
        }

        $this->db->flush_cache();
        $this->db->set("user_balance", "user_balance+$newbalance", false);
        $this->db->where('user_id', $user_id);
        $this->db->update('dtd_users');

    }

    public function get_user_id_by_email($email){
        return $this->get_single_val('user_id','users',array('user_email' => $email));
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
        $qday = $this->input->post('day');
        if(empty($qday)){
            $qday = date('Y-m-d');
        }else{
            $qday = date_create_from_format("d/m/Y", $qday);
            $qday = $qday->format("Y-m-d");
        }
        //counting today's total order
        $this->db->select('order_id');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->like('order_date', $qday);

        $today['count'] = $this->db->count_all_results();

        //counting the total changes of today
        $this->db->select_sum('order_amount');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->like('order_date', $qday);
        $query = $this->db->get('dtd_order');
        $today['sum'] = callback_format_amount(current($query->row_array()));

        return $today;
    }

    public function get_monthly()
    {
        $qmonth = $this->input->post('month');
        if(empty($qmonth)){
            $qmonth = date('Y-m');
        }
        $this->db->select('order_id');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->like('order_date', $qmonth);
        $month['monthcount'] = $this->db->count_all_results();

        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->where_in('order_status', array('Delivered','Returned'));
        $this->db->like('order_date', $qmonth);
        $month['deliver'] = $this->db->count_all_results();

        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->where('order_status', 'Processing');
        $this->db->like('order_date', $qmonth);
        $month['pending'] = $this->db->count_all_results();

        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->where('order_status', 'Processing');
        $this->db->like('order_date', $qmonth);
        $month['pending'] = $this->db->count_all_results();

       /* $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->where('order_status', 'Created');
        $this->db->like('order_date', date('Y-m'));
        $month['created'] = $this->db->count_all_results(); */

        $this->db->select_sum('order_amount');
        $this->db->where('order_custid', $this->user_model->get_current_user_id());
        $this->db->where('order_status<>', "Created");
        $this->db->like('order_date', $qmonth);
        $query = $this->db->get('dtd_order');

        $month['amount'] = callback_format_amount(current($query->row_array()));
        $month['success'] = true;
        return $month;
    }

    public function get_order($order_id){
        $this->db->select('order_custid, order_amount');
        $this->db->where('order_id', $order_id);
        return $this->db->get('order')->row_array();
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
        $this->db->where_in('order_status', array('Pending', 'Created'));
        //$this->db->like('order_date', date('Y-m-d'));
        $all['count'] = $this->db->count_all_results();

        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $user_id);
        $this->db->where_in('order_status', array('Processing'));
        $all['pending'] = $this->db->count_all_results();

        $this->db->select('order_status');
        $this->db->from('dtd_order');
        $this->db->where('order_custid', $user_id);
        $this->db->where_in('order_status', array('Delivered','Returned'));
        $all['deliver'] = $this->db->count_all_results();

        $all['balance'] = $this->general_model->get_single_val('user_balance', 'users', array('user_id' => $user_id));
        return $all;
    }

    public function get_delete_order($order_id=null)
    {
        $this->db->select('order_status, order_amount');
        $this->db->from('dtd_order');
        $this->db->where('order_id',$order_id);
        return $this->db->get()->row_array();




    }
    public function get_user_account()
    {
        $cust_id = $this->user_model->get_current_user_id();
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
		foreach($dates as $date){
			$data['date']=$date->format('M-Y');
			$query=$this->db->query("
			SELECT DATE_FORMAT(order_date,'%Y-%M') as date, COUNT(order_id) as num,SUM(order_amount) as amount
			FROM dtd_order
			WHERE order_status IN('Delivered','Processing','Pending') AND order_date LIKE '".$date->format("Y-m")."%' AND order_custid = ". $cust_id ."
			GROUP BY date");
			$data['charge']= $query->row_array();


			$query=$this->db->query("
			SELECT DATE_FORMAT(dep_date,'%Y-%M') as date, COUNT(dep_id) as num, SUM(dep_amount) as amount
			FROM dtd_custdep
			WHERE dep_date LIKE '".$date->format("Y-m")."%' AND dep_custid = ". $cust_id ."
			GROUP BY date");
			$data['recived'] = $query->row_array();

			$result[]=$data;
		}
		return $result;
    }

    public function get_user_account_year(){
        $cust_id = $this->user_model->get_current_user_id();
        $result = array();
        $start = new DateTime("first day of january 2015");
        $end = new DateTime();
        $dates = new DatePeriod($start,new DateInterval("P1Y"),$end);
        foreach($dates as $date){
            $data['date']=$date->format('Y');
            $query=$this->db->query("
			SELECT DATE_FORMAT(order_date,'%Y') as date, COUNT(order_id) as num,SUM(order_amount) as amount
			FROM dtd_order
			WHERE order_status IN('Delivered','Processing','Pending') AND order_date LIKE '".$date->format("Y")."%' AND order_custid = ". $cust_id ."
			GROUP BY date");
            $data['charge']= $query->row_array();


            $query=$this->db->query("
			SELECT DATE_FORMAT(dep_date,'%Y-%M') as date, COUNT(dep_id) as num, SUM(dep_amount) as amount
			FROM dtd_custdep
			WHERE dep_date LIKE '".$date->format("Y")."%' AND dep_custid = ". $cust_id ."
			GROUP BY date");
            $data['recived'] = $query->row_array();

            $result[]=$data;
        }
        return $result;
    }

    public function get_daily_orders(){
        $this->db->select("DATE_FORMAT(dto.order_date, '%M-%d') as date,di.type_name,COUNT(dto.order_id) as subtotal, SUM(order_amount) as subamount");
        $this->db->from('dtd_order dto');
        $this->db->join('dtd_item_type di','di.type_id=dto.order_typeid');
        $this->db->where('dto.order_date >= LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH
  AND dto.order_date < LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY');
        $this->db->where('order_status<>', "Created");
        $this->db->group_by('dto.order_custid, date, type_name');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_rec_message(){
        $cust_id = $this->User_Model->get_current_user_id();
        $vendor_id = $this->get_user_vendor_id();
        $msg_to = array($cust_id, 'all', 'allc');
        $this->datatables->select("msg_id, msg_from, msg_title, msg_desc, DATE_FORMAT(msg_date,'%b-%d') as m_date")
            ->from('dtd_message')
            ->edit_column('msg_from','$1', 'callback_message_from(msg_from)')
            ->edit_column('msg_id','$1', 'callback_edit_message(msg_id,customer)')
            ->edit_column('msg_desc','$1','strip_tags(msg_desc)')
            ->where_in('msg_to', $msg_to)
            ->or_where('msg_to', 'allvc')
            ->where('msg_from', $vendor_id);
        return $this->datatables->generate();
    }

    public function get_sent_message(){
        $cust_id = $this->User_Model->get_current_user_id();
        $this->datatables->select("msg_to, msg_title, msg_desc, DATE_FORMAT(msg_date,'%b-%d') as msg_date, msg_id")
            ->from('dtd_message')
            ->edit_column('msg_to','$1', 'callback_message_to(msg_to)')
            ->edit_column('msg_id','$1', 'callback_send_message_delete(msg_id)')
            ->where('msg_from', $cust_id);
        return $this->datatables->generate();
    }
}

?>