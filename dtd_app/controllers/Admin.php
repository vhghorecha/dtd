<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Admin_Model');
        //Created By Hardik Mehta
        $this->load->model('user_model');
        $this->load->model('General_Model');
        if(!$this->user_model->is_admin() && $this->uri->segment(2) != 'login'){
            redirect('admin/login');
            die();
        }
    }

    //Modified By Hardik Mehta
    public function index()
    {
        redirect('admin/login');
    }

    //Cretaed By Hardik Mehta
    public function dashboard()
    {
        $data['pending']=$this->Admin_Model->get_pending_orders();
        $data['cdeposit']=$this->Admin_Model->get_customer_deposit();
        $data['vpay']=$this->Admin_Model->get_vendor_payment();
        $data['balance'] = $data['cdeposit'] - $data['vpay'];
        $this->load->template("admin/index",$data);
    }

    public function app_order()
    {
        $data["customers"] = $this->Admin_Model->get_customer_json();
        $data["items"] = $this->Admin_Model->get_all_item_json();
        $this->load->template('admin/app_order',$data);
    }
    //Created By Hardik Mehta
    public function login()
    {
        $is_login = $this->input->post('btnLogin');

        if($is_login == 'Login')
        {
            $config = array(
                array(
                    'field' => 'txtemail',
                    'label' => 'E-mail',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',

                    )
                ),
                array(
                    'field' => 'txtpass',
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true)
            {
                $data = $this->user_model->adminvalidate();
                if($data['validated']){
                    if($data['is_active'])
                    {
                        $this->session->set_userdata('userinfo', $data);
                        redirect('admin/dashboard');
                    }
                    else
                    {
                        $error = "Your account not activated by Admin";
                    }
                }else{
                    $error = "Invalid Email or Password";
                }
            }
            else
            {
                $error = validation_errors();
            }
            $data['error'] = $error;
            $this->load->template('admin/login',$data);
        }
        else
        {
            $this->load->template('admin/login');
        }
    }

    public function deposit()
    {
        $is_dep = $this->input->post('btnDeposit');
        if($is_dep=='Deposit'){
            $config = array(
                array(
                    'field' => 'custname',
                    'label' => 'Customer Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'depositdate',
                    'label' => 'Date of Deposit',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'depamount',
                    'label' => 'Amount',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                        'numeric' => 'Only Numbers are allowed in Amount',
                    )
                ),
                /* array(
                    'field' => 'depreference',
                    'label' => 'Transaction Reference',
                    'rules' => 'required|alpha_numeric|is_unique[custdep.dep_transno]',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                        'alpha_numeric' => 'Only alpha numeric values are allowed in Transaction Reference',
                        'is_unique' => 'Transaction Reference already registered...',
                    )
                ),
                array(
                    'field' => 'depbank',
                    'label' => 'Bank Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),*/
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                //$custid = $this->Admin_Model->get_customerid($this->input->post('custname'));
                $data['dep_custid'] = $this->input->post('custname');
                $date = DateTime::createFromFormat('d/m/Y',$this->input->post('depositdate'));
                $data['dep_date'] = $date->format('Y-m-d');
                $data['dep_amount'] = $this->input->post('depamount');
                $data['dep_transno'] = $this->input->post('depreference');
                $data['dep_bankname'] = $this->input->post('depbank');
                $this->Admin_Model->customer_deposit($data);

                $this->Customer_Model->set_user_balance($data['dep_amount'],$data['dep_custid']);

                $message = "Customer deposit successfully done.";
            }else{
                $error = validation_errors();
            }

            if(!empty($error)){
                $data = $_POST;
                $data['error'] = $error;
            }
            if(!empty($message)){
                $data['message'] = $message;
            }
            $data['customers'] = $this->Admin_Model->get_customers();
            $this->load->template('admin/deposit',$data);
        }else{
            $data['customers'] = $this->Admin_Model->get_customers();
            $this->load->template('admin/deposit',$data);
        }
    }

    public function editdeposit($dep_id){
        $is_dep = $this->input->post('btnDeposit');
        if($is_dep=='Update'){
            $config = array(
                array(
                    'field' => 'depositdate',
                    'label' => 'Date of Deposit',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                $date = DateTime::createFromFormat('d/m/Y',$this->input->post('depositdate'));
                $data['dep_date'] = $date->format('Y-m-d');
                $data['dep_transno'] = $this->input->post('depreference');
                $data['dep_bankname'] = $this->input->post('depbank');
                $this->Admin_Model->update_deposit($data, $dep_id);

                $message = "Deposit updated successfully.";
            }else{
                $error = validation_errors();
            }
        }
        $data = $this->Admin_Model->get_deposit($dep_id);
        if(!empty($error)){
            $data = $_POST;
            $data['error'] = $error;
        }
        if(!empty($message)){
            $data['message'] = $message;
        }
        $this->load->template('admin/editdeposit',$data);
    }

    public function editpayment($dep_id){
        $is_dep = $this->input->post('btnPayment');
        if($is_dep=='Update'){
            $config = array(
                array(
                    'field' => 'paymentdate',
                    'label' => 'Date of Payment',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                $date = DateTime::createFromFormat('d/m/Y',$this->input->post('paymentdate'));
                $data['pay_date'] = $date->format('Y-m-d');
                $data['pay_transno'] = $this->input->post('depreference');
                $data['pay_bankname'] = $this->input->post('depbank');
                $this->Admin_Model->update_payment($data, $dep_id);

                $message = "Payment updated successfully.";
            }else{
                $error = validation_errors();
            }
        }
        $data = $this->Admin_Model->get_payment($dep_id);
        if(!empty($error)){
            $data = $_POST;
            $data['error'] = $error;
        }
        if(!empty($message)){
            $data['message'] = $message;
        }
        $this->load->template('admin/editpayment',$data);
    }

    //Created by Hardik Mehta
    public function app_vendor(){
        $this->load->template('admin/appvendor');
    }

    public function app_customer(){
        $this->load->template('admin/appcustomer');
    }

    //Created by Hardik Mehta
    public function change_pwd()
    {
        $is_change = $this->input->post('btnChange');
        if($is_change == 'Change')
        {
            $config = array
            (
                array(
                    'field' => 'oldpwd',
                    'label' => 'Old Password',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s'
                    )
                ),
                array(
                    'field' => 'newpwd',
                    'label' => 'New Password',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s'
                    )
                ),
                array(
                    'field' => 'confirmpwd',
                    'label' => 'Confirm Password',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s'

                    )
                )

            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE)
            {
                //fail validation
                $error = validation_errors();
            }
            else
            {
                //pass validation
                $curpwd=$this->Admin_Model->get_adm_pwd();

                if($curpwd['pwd']==$this->input->post('oldpwd'))
                {
                    $data=array(
                        'admin_pass'=>$this->input->post('newpwd')
                    );
                    $this->db->where('admin_id',$this->user_model->get_admin_id());
                    $this->db->update('dtd_admin',$data);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Password Successfully Changed!!!</div>');
                }
                else
                {
                    $error="Old Password does not match";
                    $data['error'] = $error;
                }
            }
            $this->load->template('admin/change_pwd',$data);
        }
        else
        {
            $this->load->template('admin/change_pwd');
        }
    }

    public function payment()
    {
        $is_save = $this->input->post('btnfilter');
        if($is_save=='Generate'){
            $config = array(
                array(
                    'field' => 'vendname[]',
                    'label' => 'Vendor Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'fromdate',
                    'label' => 'From Date',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'todate',
                    'label' => 'To Date',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                $vendors = $this->input->post('vendname');
                $fromdate = DateTime::createFromFormat('d/m/Y',$this->input->post('fromdate'));
                $todate = DateTime::createFromFormat('d/m/Y',$this->input->post('todate'));
                foreach($vendors as $vendor){
                    $this->db->select('GROUP_CONCAT(dtd_order.order_id) as order_ids, SUM(vendor_amount) as payamount')
                        ->from('dtd_order')
                        ->where('dtd_order.order_vendorid', $vendor)
                        ->where('dtd_order.order_status', 'Delivered')
                        ->where('dtd_order.order_date >= ', $fromdate->format('Y-m-d'))
                        ->where('dtd_order.order_date <= ', $todate->format('Y-m-d'))
                        ->where('dtd_order.vendor_paid', 'Unpaid');

                    $resord = $this->db->get()->row_array();
                    if(!empty($resord['order_ids'])){
                        $data['pay_orderids'] = $resord['order_ids'];
                        $data['pay_vendorid'] = $vendor;
                        $data['pay_date'] = date('Y-m-d');
                        $data['pay_amount'] = $resord['payamount'];
                        $data['pay_code'] = time();
                        $this->Admin_Model->vendor_pay($data);

                        $this->db->reset_query();
                        $this->db->where_in('order_id', explode(",",$data['pay_orderids']));
                        $this->db->update('order', array('vendor_paid' => 'Prepaid'));
                    }

                }
                $message = "Generated Successfully...";
            }else{
                $error = validation_errors();
            }

            if(!empty($error)){
                $data = $_POST;
                $data['error'] = $error;
            }
            if(!empty($message)){
                $data['message'] = $message;
            }
            $data['vendors'] = $this->Admin_Model->get_vendors();
            $this->load->template('admin/payment',$data);
        }else{
            $data['vendors'] = $this->Admin_Model->get_vendors();
            $this->load->template('admin/payment',$data);
        }
    }

    public function download_orders($paycode)
    {
        if (!empty($paycode)) {
            $this->load->dbutil();
            $this->db->select('pay_code as "Pay Code", user_name as "Vendor Name", DATE_FORMAT(pay_date, "%d-%m-%Y") as "Payment Date", pay_amount as "Amount", pay_transno as "Transaction No", pay_bankacno as "Account No", pay_bankname as "Bank Name", pay_orderids as "Paid For"')
                ->from("vendorpay as v")
                ->join("users as u", "u.user_id = v.pay_vendorid")
                ->where("pay_code",$paycode);

            $query = $this->db->get();
            $csv_string = $this->dbutil->csv_from_result($query);
            $csv_string = chr(239) . chr(187) . chr(191) . $csv_string;
            // Load the download helper and send the file to your desktop
            $this->load->helper('download');

            force_download('order_prepaid.csv', $csv_string);
        }
    }

    public function allocation()
    {
        $is_reg = $this->input->post('btnAllocate');
        if($is_reg=='Allocate'){
            $config = array(
                array(
                    'field' => 'custname',
                    'label' => 'Customer Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'vendname',
                    'label' => 'Vendor Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                $userid = $this->input->post('custname');
                $vendid = $this->input->post('vendname');
                $this->Admin_Model->vendor_allocate($vendid,$userid);
                $message = "Customer to Vendor allocation successfully done.";
            }else{
                $error = validation_errors();
            }

            if(!empty($error)){
                $data = $_POST;
                $data['error'] = $error;
            }
            if(!empty($message)){
                $data['message'] = $message;
            }
            $data['vendors'] = $this->Admin_Model->get_vendors();
            $data['customers'] = $this->Admin_Model->get_unallocated_customers();
            $this->load->template('admin/allocation',$data);
        }else{
            $data['vendors'] = $this->Admin_Model->get_vendors();
            $data['customers'] = $this->Admin_Model->get_unallocated_customers();
            $this->load->template('admin/allocation',$data);
        }
    }
    public function grade()
    {
        $is_save = $this->input->post('btnSave');
        if($is_save=='save'){
            $config = array(
                array(
                    'field' => 'gradename',
                    'label' => 'Grade Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                $data['grade_name'] = $this->input->post('gradename');
                $this->Admin_Model->add_grade($data);
                $message = "New Customer Grade inserted successfully done.";
            }else{
                $error = validation_errors();
            }
            if(!empty($error)){
                $data = $_POST;
                $data['error'] = $error;
            }
            if(!empty($message)){
                $data['message'] = $message;
            }
            $this->load->template('admin/grade', $data);
        }else {
            $this->load->template('admin/grade');
        }
    }
    public function customers()
    {
        $data['grades'] = $this->Admin_Model->get_grade_drop();
        $this->load->template('admin/customers', $data);
    }
    public function vendors()
    {
        $this->load->template('admin/vendors');
    }
    public function vendor_customer()
    {
        $data['vendors'] = $this->Admin_Model->get_vendor_json();
        $this->load->template('admin/vendor_cust',$data);
    }
    public function price()
    {
        $this->load->template('admin/price');
    }
    public function editgradediscount($gp_id=null)
    {
        $is_save = $this->input->post('btnUpdate');
        if($is_save=='Update'){
            $config = array(
                array(
                    'field' => 'frmdate',
                    'label' => 'From Date',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'todate',
                    'label' => 'To Date',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'nooforders',
                    'label' => 'No. of Orders',
                    'rules' => 'required|numeric',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                        'numeric' => 'Only Numbers are allowed in %s',
                    )
                ),
                array(
                    'field' => 'gradename',
                    'label' => 'Grade Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'discount',
                    'label' => 'Discount',
                    'rules' => 'required|numeric',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                        'numeric' => 'Only Numbers are allowed in %s',
                    )
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                $date = DateTime::createFromFormat('d/m/Y',$this->input->post('frmdate'));
                $data['gp_fromdt'] = $date->format('Y-m-d');
                $date = DateTime::createFromFormat('d/m/Y',$this->input->post('todate'));
                $data['gp_todt'] = $date->format('Y-m-d');
                $data['gp_no_order'] = $this->input->post('nooforders');
                $data['gp_disc'] = $this->input->post('discount');
                $this->Admin_Model->edit_grade_price($data,$this->input->post('id'));
                $message = "Grade Price updated successfully";
            }else{
                $error = validation_errors();
            }
            if(!empty($error)){
                $data = $_POST;
                $data['error'] = $error;
            }
            if(!empty($message)){
                $data['message'] = $message;
            }
            $data['edit']=$this->Admin_Model->get_edit_grade_discount($gp_id);
            $data['grade'] = $this->Admin_Model->get_grade($gp_id);
            $this->load->template('admin/editgradediscount',$data);
        }else {
            $data['edit']=$this->Admin_Model->get_edit_grade_discount($gp_id);
            $data['grade'] = $this->Admin_Model->get_grade($gp_id);
            $this->load->template('admin/editgradediscount',$data);
        }


    }
    public function deletegradediscount($gp_id=null)
    {
        $this->db->where('gp_id',$gp_id);
        $this->db->delete('dtd_gradeprice');
        redirect("admin/price");
    }
    public function deleteprice($gi_id=null)
    {
        $this->db->where('gi_id',$gi_id);
        $this->db->delete('dtd_itemprice');
        redirect("admin/price");
    }
    public function editprice($gi_id=null)
    {
        $is_save = $this->input->post('btnUpdate');
        if($is_save=='Update'){
            $config = array(
                array(
                    'field' => 'price',
                    'label' => 'Price',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),

            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                $data=array(
                    'gi_price'=>$this->input->post('price')
                );
                $this->db->where('gi_id',$this->input->post('giid'));
                $this->db->update('dtd_itemprice',$data);
                $message = "Item Price updated successfully";
            }else{
                $error = validation_errors();
            }
            $typename=$this->Admin_Model->get_item_types($gi_id);
            if(!empty($error)){
                $typename = $_POST;
                $typename['error'] = $error;
            }
            if(!empty($message)){
                $typename['message'] = $message;
            }

            $this->load->template('admin/editprice',$typename);
        }else {
            $typename=$this->Admin_Model->get_item_types($gi_id);
            $this->load->template('admin/editprice',$typename);
        }
    }
    public function newgradediscount(){
        $is_save = $this->input->post('btnSave');
        if($is_save=='save'){
            $config = array(
                array(
                    'field' => 'frmdate',
                    'label' => 'From Date',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'todate',
                    'label' => 'To Date',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'nooforders',
                    'label' => 'No. of Orders',
                    'rules' => 'required|numeric',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                        'numeric' => 'Only Numbers are allowed in %s',
                    )
                ),
                array(
                    'field' => 'gradename',
                    'label' => 'Grade Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'discount',
                    'label' => 'Discount',
                    'rules' => 'required|numeric',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                        'numeric' => 'Only Numbers are allowed in %s',
                    )
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                $date = DateTime::createFromFormat('d/m/Y',$this->input->post('frmdate'));
                $data['gp_fromdt'] = $date->format('Y-m-d');
                $date = DateTime::createFromFormat('d/m/Y',$this->input->post('todate'));
                $data['gp_todt'] = $date->format('Y-m-d');
                $data['gp_no_order'] = $this->input->post('nooforders');
                $data['gp_grade'] = $this->input->post('gradename');
                $data['gp_disc'] = $this->input->post('discount');
                $this->Admin_Model->grade_price($data);
                $message = "Grade Price inserted successfully done.";
            }else{
                $error = validation_errors();
            }
            if(!empty($error)){
                $data = $_POST;
                $data['error'] = $error;
            }
            if(!empty($message)){
                $data['message'] = $message;
            }
            $data['grades'] = $this->Admin_Model->get_cust_grade();
            $this->load->template('admin/newgradediscount',$data);
        }else {
            $data['grades'] = $this->Admin_Model->get_cust_grade();
            $this->load->template('admin/newgradediscount',$data);
        }
    }
    public function newitemprice()
    {
        $is_save = $this->input->post('btnSave');
        if($is_save=='save'){
            $config = array(
                array(
                    'field' => 'itemtype',
                    'label' => 'Item Type',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'itemprice',
                    'label' => 'Price',
                    'rules' => 'required|numeric',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                        'numeric' => 'Only Numbers are allowed in Price',
                    )
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                $data['gi_type'] = $this->input->post('itemtype');
                $data['gi_price'] = $this->input->post('itemprice');
                $this->Admin_Model->item_price($data);
                $message = "Item Price inserted successfully done.";
            }else{
                $error = validation_errors();
            }
            if(!empty($error)){
                $data = $_POST;
                $data['error'] = $error;
            }
            if(!empty($message)){
                $data['message'] = $message;
            }
            $data['itemtypes'] = $this->Admin_Model->get_item_type();
            $this->load->template('admin/newitemprice',$data);
        }else {
            $data['itemtypes'] = $this->Admin_Model->get_item_type();
            $this->load->template('admin/newitemprice',$data);
        }
    }
    public function item(){
        $is_save = $this->input->post('btnSave');
        if($is_save=='save'){
            $config = array(
                array(
                    'field' => 'typename',
                    'label' => 'Item Type Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                $data['type_name'] = $this->input->post('typename');
                $this->Admin_Model->add_item($data);
                $message = "New Item Type inserted successfully done.";
            }else{
                $error = validation_errors();
            }
            if(!empty($error)){
                $data = $_POST;
                $data['error'] = $error;
            }
            if(!empty($message)){
                $data['message'] = $message;
            }
            $this->load->template('admin/item', $data);
        }else {
            $this->load->template('admin/item');
        }
    }
    public function editvendorprice($vp_id=null)
    {
        $is_save = $this->input->post('btnUpdate');
        if($is_save=='Update'){
            $config = array(
                array(
                    'field' => 'price',
                    'label' => 'Price',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                $data=array(
                    'gp_price'=>$this->input->post('price')
                );
                $this->db->where('vp_id',$this->input->post('vpid'));
                $this->db->update('dtd_vendorprice',$data);
                $message = "Vendor Price updated successfully";
            }else{
                $error = validation_errors();
            }
            if(!empty($error)){
                $data = $_POST;
                $data['error'] = $error;
            }
            if(!empty($message)){
                $data['message'] = $message;
            }
            $data['edit']=$this->Admin_Model->get_edit_vendor($vp_id);
            $this->load->template('admin/editvendorprice',$data);
        }else {
            $data['edit']=$this->Admin_Model->get_edit_vendor($vp_id);
            $this->load->template('admin/editvendorprice',$data);
        }

    }
    public function deletevendorprice($vp_id=null)
    {
        $this->db->where('vp_id',$vp_id);
        $this->db->delete('dtd_vendorprice');
        redirect("admin/price");
    }
    public function vendorprice()
    {
        $is_save = $this->input->post('btnSave');
        if($is_save=='save'){
            $config = array(
                array(
                    'field' => 'vendname',
                    'label' => 'Vendor Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'itemtype',
                    'label' => 'Item Type',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'price',
                    'label' => 'Price',
                    'rules' => 'required|numeric',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                        'numeric' => 'Only Numbers are allowed in Price',
                    )
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                $data['gp_vendorid'] = $this->input->post('vendname');
                $data['gp_typeid'] = $this->input->post('itemtype');
                $data['gp_price'] = $this->input->post('price');
                $this->Admin_Model->vendor_price($data);
                $message = "Vendor price inserted successfully done.";
            }else{
                $error = validation_errors();
            }

            if(!empty($error)){
                $data = $_POST;
                $data['error'] = $error;
            }
            if(!empty($message)){
                $data['message'] = $message;
            }
            $data['itemtypes'] = $this->Admin_Model->get_item_type();
            $data['vendors'] = $this->Admin_Model->get_vendors();
            $this->load->template('admin/vendorprice',$data);
        }else{
            $data['itemtypes'] = $this->Admin_Model->get_item_type();
            $data['vendors'] = $this->Admin_Model->get_vendors();
            $this->load->template('admin/vendorprice', $data);
        }
    }
    public function money_received()
    {
        $this->load->template('admin/money_received');
    }
    public function money_paid()
    {
        $this->load->template('admin/money_paid');
    }
    public function account()
    {
        $data['today']=$this->Admin_Model->get_admin_account_weekly();
        $data['daccount']=$this->Admin_Model->get_admin_account_daily();
        $data['account']=$this->Admin_Model->get_admin_account();
        $data['yaccount']=$this->Admin_Model->get_admin_account_year();
        $this->load->template('admin/account',$data);
    }
    public function orders_pending()
    {
        $data["status_val"] = $this->Admin_Model->get_all_status_json();
        $data["items"] = $this->Admin_Model->get_all_item_json();
        $data["customers"] = $this->Admin_Model->get_customer_json();
        $data["vendors"] = $this->Admin_Model->get_vendor_json();
        $this->load->template('admin/orders_pending',$data);
    }
    public function rec_message(){
        $this->load->template('rec_message');
    }

    public function sent_message(){
        $this->load->template('sent_message');
    }
    public function message($msgid = null)
    {
        $is_send = $this->input->post('btnSend');
        if($is_send=='Send'){
            $config = array(
                array(
                    'field' => 'reci',
                    'label' => 'Receipients',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'txtsub',
                    'label' => 'Message Subject',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {
                $msg_to=$this->input->post('reci');
                if($msg_to=='customer')
                {
                    $msg_to=$this->input->post('custname');
                }
                if($msg_to=='vendor')
                {
                    $msg_to=$this->input->post('vendname');
                }

                $filedata = $this->general_model->get_uploaded_file();
                $data['msg_file'] = $filedata['file_name'];

                $date = mdate('%Y-%m-%d %H:%i:%s');
                $data['msg_date'] = $date;
                $data['msg_from'] = 0;
                $data['msg_to'] = $msg_to;
                $data['msg_title'] = $this->input->post('txtsub');
                $data['msg_desc'] = $this->input->post('txtmsg');
                $this->Admin_Model->message_insert($data);
                $message = "Message successfully sent.";
            }else{
                $error = validation_errors();
            }

            if(!empty($error)){
                $data = $_POST;
                $data['error'] = $error;
            }
            if(!empty($message)){
                $data['message'] = $message;
            }
            $data['vendors'] = $this->Admin_Model->get_vendors();
            $data['customers'] = $this->Admin_Model->get_customers();
            $this->load->template('admin/message',$data);
        }else{
            if(!is_null($msgid))
            {
                $data["txtmsg"]= $this->Admin_Model->get_message($msgid);
                $data["txtsub"] = "Re: " . $this->Admin_Model->get_subject($msgid);
                $data["txtreci"] = $this->Admin_Model->get_from($msgid);
            }

            $data['vendors'] = $this->Admin_Model->get_vendors();
            $data['customers'] = $this->Admin_Model->get_customers();
            $this->load->template('admin/message',$data);
        }

    }

    public function read_message($msg_id)
    {
        if(!empty($msg_id))
        {
            $data["txtmsg"] = $this->Admin_Model->get_message($msg_id);
            $data["txtsub"] = $this->Admin_Model->get_subject($msg_id);
            $data["txtreci"] = $this->Admin_Model->get_from($msg_id);
            $data["attachment"] = $this->Admin_Model->get_message_file($msg_id);
            $updated_data = array('msg_read'=>'1');
            $this->Admin_Model->update_read_status($msg_id,$updated_data);

            $this->load->template('admin/read_message',$data);
        }

    }

    public function fullbackup1(){
        // Load the DB utility class
        $this->load->dbutil();

        // Backup your entire database and assign it to a variable
        $backup =& $this->dbutil->backup();

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('dtd_schema_backup' . time() . '.sql.gz', $backup);
    }

    public function fullbackup(){
        // Load the DB utility class
        $this->load->dbutil();
        $prefs = array(
            'format'      => 'sql',
            'filename'    => 'dtd_schema_backup'.time().'.sql'
        );
        $backup =& $this->dbutil->backup($prefs);
        $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.sql';
        $save = $db_name;
        $this->load->helper('file');
        write_file($save, $backup);
        $this->load->helper('download');
        force_download($db_name, $backup);
    }

    public function backup(){
        $this->load->template('admin/backup');
    }

    public function orderbackup(){
        $ordbackup = $this->input->post('btnBackup');

        if($ordbackup == 'Backup'){
            $config = array(
                array(
                    'field' => 'startdate',
                    'label' => 'Start date',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'enddate',
                    'label' => 'End date',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == true) {

                $start_date =  DateTime::createFromFormat('d/m/Y',$this->input->post('startdate'));
                $end_date = DateTime::createFromFormat('d/m/Y',$this->input->post('enddate'));

                $this->db->where("order_date >=", $start_date->format('Y-m-d'));
                $this->db->where("order_date <=", $end_date->format('Y-m-d'));
                $query = $this->db->get("order");
                if($query->num_rows() > 0)
                {
                    //$result = $query->result();
                    $this->load->dbutil();
                    $csv_string = $this->dbutil->csv_from_result($query);
                    $csv_string = chr(239) . chr(187) . chr(191) . $csv_string;
                    // Load the download helper and send the file to your desktop
                    $this->load->helper('download');
                    force_download('orders.csv', $csv_string);
                }
                else
                {
                    $message = "No record found in the table.";
                }

             }
            else{
                validation_errors();
            }

        }
        if(!empty($error)){
            $data = $_POST;
            $data['error'] = $error;
        }
        if(!empty($message)){
            $data['message'] = $message;
        }
        $this->load->template('admin/backup',$data);
    }

    public function customer_orders()
    {
        $data['today']=$this->Admin_Model->get_cust_today();
        $data['month']=$this->Admin_Model->get_cust_monthly();
        $data['today_cust']=$this->Admin_Model->get_cust_today_by_cust();
        $data['item_types'] = $this->Customer_Model->get_item_types();
        $this->load->template('admin/customer_orders',$data);
    }

    public function customer_charges()
    {
        $data['today']=$this->Admin_Model->get_cust_charges();
        $data['month']=$this->Admin_Model->get_cust_charges_monthly();
        $data['today_cust']=$this->Admin_Model->get_cust_charges_by_cust();
        $data['outstanding'] = $this->Admin_Model->get_cust_outstanding();
        $data['item_types'] = $this->Customer_Model->get_item_types();
        $this->load->template('admin/customer_charges',$data);
    }

    public function vendor_orders()
    {
        $data['today']=$this->Admin_Model->get_ven_today();
        $data['month']=$this->Admin_Model->get_ven_monthly();
        $data['today_ven']=$this->Admin_Model->get_ven_today_by_ven();
        $data['item_types'] = $this->Customer_Model->get_item_types();
        $this->load->template('admin/vendor_orders',$data);
    }

    public function vendor_balance()
    {
        $data['today']=$this->Admin_Model->get_ven_charges();
        $data['today_ven']=$this->Admin_Model->get_ven_charges_by_ven();
        $this->load->template('admin/vendor_balance',$data);
    }

    public function restore(){
        $this->load->template('admin/restore');
    }

    public function dbrestore(){
        $restore = $this->input->post('btnRestore');

        if($restore=='Restore'){
            $config['upload_path']          = './sqlbackup/';
            $config['allowed_types']        = 'sql|txt|text';
            $config['max_size']             = 10240;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload())
            {
                $data['error'] = $this->upload->display_errors();
                $this->load->template('admin/restore', $data);
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());


                $file_restore = $this->load->file($data["upload_data"]["full_path"], true);
                $this->db->query($file_restore);
                /*$file_array = explode(';', $file_restore);

                foreach ($file_array as $query)
                {
                    $this->db->query("SET FOREIGN_KEY_CHECKS = 0");
                    $this->db->query($query);
                    $this->db->query("SET FOREIGN_KEY_CHECKS = 1");
                    //$query="";
                }*/
                $data['message'] = "Database restore successfully.";
                $this->load->template('admin/restore', $data);
            }
        }
    }
}
