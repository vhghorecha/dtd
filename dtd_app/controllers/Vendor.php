<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Vendor_Model');
        $this->load->model('Customer_Model');
        $this->load->model('Admin_Model');

        if(!$this->user_model->is_vendor()){
            redirect('/');
        }
    }
    public function index()
    {
        $data['all']=$this->Vendor_Model->get_summary_info();
        $this->load->template('vendor/index',$data);
    }
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
                $msg = validation_errors();
                $data['error'] = true;
            }
            else
            {
                //pass validation
                $curpwd=$this->Vendor_Model->get_user_pwd();
                if($curpwd['pwd']==$this->input->post('oldpwd'))
                {
                    $data=array(
                        'user_pass'=>$this->input->post('newpwd')
                    );
                    $this->user_model->update_pwd($data);
                    $msg = 'Password Successfully Changed!!!';
                }
                else
                {
                    $msg = 'Old Password does not match!!!';
                    $data['error'] = true;
                }
            }
            $data['msg'] = $msg;
            $this->load->template('vendor/change_pwd',$data);
        }
        else
        {
            $this->load->template('vendor/change_pwd');
        }

    }
    public function orders_received()
    {
        $data['orders'] = $this->Vendor_Model->get_orders();
        $data['dorders'] = $this->Vendor_Model->get_day_orders();
        $data['iorders'] = $this->Vendor_Model->get_day_iorders();
        $this->load->template('vendor/orders_received',$data);
    }
    public function update_order()
    {
        $this->load->template('vendor/update_order');
    }
    public function orders_processed()
    {
        $this->load->template('vendor/orders_processed');
    }
    public function profile()
    {	$user_id = $this->user_model->get_current_user_id();
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
                $msg = validation_errors();

            }
            else
            {
                //pass validation
                $curpwd=$this->Vendor_Model->get_user_pwd();
                $oldpwd=md5($this->input->post('oldpwd'));
                $newpwd=md5($this->input->post('newpwd'));
                if($curpwd['pwd']==$oldpwd)
                {
                    $data=array(
                        'user_pass'=>$newpwd
                    );
                    $this->user_model->update_pwd($data);
                    $msg = 'Password Successfully Changed!!!';
                }
                else
                {
                    $msg = 'Old Password does not match!!!';

                }
            }
            $data['msg'] = $msg;
            $data['profile']=$this->Vendor_Model->get_vendor_profile($user_id);

            $this->load->template('vendor/profile',$data);
        }
        elseif($this->input->post('btnEditProfile')=="Update Profile")
        {
            $data1=array(
                'user_name'=>$this->input->post('username'),
                //company name and representive name pending , check profile page
                'user_add'=>$this->input->post('useradd'),
                'user_zipcode'=>$this->input->post('userzip'),
                'user_site'=>$this->input->post('usersite'),
                'user_memo'=>$this->input->post('umemo')
            );
            $this->db->where('user_id',$user_id);
            $this->db->update('dtd_users', $data1);
            $data2=array(
                'vendor_comp'=>$this->input->post('compname'),
                'vendor_hq1'=>$this->input->post('hq1'),
                'vendor_hq2'=>$this->input->post('hq2'),
                'vendor_hq3'=>$this->input->post('hq3'),
                'vendor_taxno'=>$this->input->post('taxrno'),
                'pay_bankacno'=>$this->input->post('bankacno'),
                'pay_bankname'=>$this->input->post('bankname'),

            );
            $this->db->where('user_id',$user_id);
            $this->db->update('dtd_vendor', $data2);
            $data['profile']=$this->Vendor_Model->get_vendor_profile($user_id);
            $this->load->template('vendor/profile',$data);
        }
        else
        {
            $data['profile']=$this->Vendor_Model->get_vendor_profile($user_id);
            $this->load->template('vendor/profile',$data);
        }
    }
    public function orders()
    {
        $orders['daily'] = $this->Vendor_Model->get_daily_orders();
        $orders['monthly'] = $this->Vendor_Model->get_monthly_orders();
        $this->load->template('vendor/orders',$orders);
    }
    public function rec_message(){
        $this->load->template('rec_message');
    }

    public function sent_message(){
        $this->load->template('sent_message');
    }
    public function message($msgid)
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
                if($msg_to == 'customer')
                {
                    $msg_to =$this->input->post('custname');;
                }

                $date = mdate('%Y-%m-%d %H:%i:%s');
                $data['msg_date'] = $date;
                $data['msg_from'] = $this->user_model->get_current_user_id();;
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

            $vendor_id=$this->user_model->get_current_user_id();
            $data['customers'] = $this->Vendor_Model->get_customer_combo($vendor_id);
            $this->load->template('vendor/message',$data);
        }else{

            if(!is_null($msgid))
            {
                $data["txtmsg"]= $this->Admin_Model->get_message($msgid);
            }

            $vendor_id=$this->user_model->get_current_user_id();
            $data['customers'] = $this->Vendor_Model->get_customer_combo($vendor_id);
            $this->load->template('vendor/message',$data);
        }
    }
    public function account()
    {
        $data['account'] = $this->Vendor_Model->get_user_account();
        $data['payhist'] = $this->Vendor_Model->get_payment_history();
        $this->load->template('vendor/account',$data);
    }

    public function customers()
    {
        $this->load->template('vendor/customers');
    }

    public function download(){
        $this->load->dbutil();
        $vendor_id = $this->user_model->get_current_user_id();
        $this->db->select("DATE_FORMAT(dtd_order.order_date,'%b-%d') as ord_date,dtd_order.order_id,dtd_users.user_name,dtd_order.order_recipient,dtd_order.order_telno,dtd_item_type.type_name,dtd_order.order_itemname,dtd_cust.user_sercomp,dtd_users.user_comp,dtd_users.user_rep,dtd_order.order_status")
            ->from('dtd_order')
            ->join('dtd_cust','dtd_cust.user_id=dtd_order.order_custid')
            ->join('dtd_users','dtd_users.user_id=dtd_cust.user_id')
            ->join('dtd_item_type','dtd_item_type.type_id=dtd_order.order_typeid')
            ->where('dtd_order.order_vendorid',$vendor_id)
            ->where_in('dtd_order.order_status','Pending');
        $query = $this->db->get();
        $csv_string = $this->dbutil->csv_from_result($query);
        $csv_string = chr(239) . chr(187) . chr(191) . $csv_string;
        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('order_received.csv', $csv_string);
    }

    public function upload_code()
    {
        $is_import = $this->input->post('btnUpload');
        $data = array();
        $msg = '';
        $error = false;
        if ($is_import == "Upload"){
            $config['upload_path']          = './tmp/';
            $config['allowed_types']        = 'xls|xlsx';
            $config['max_size']             = 10240;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload())
            {
                $msg = $this->upload->display_errors();
                $error = true;
            }
            else
            {
                $upload_data = $this->upload->data();
                $filepath = $upload_data['full_path'];

                //load the excel library
                $this->load->library('excel');

                //  Read your Excel workbook
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($filepath);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($filepath);
                    //  Get worksheet dimensions
                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $sheet->getHighestColumn();
                    //  Loop through each row of the worksheet in turn
                    for ($row = 2; $row <= $highestRow; $row++){

                        $order_id = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $row)->getValue();
                        $order_updatecode = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $row)->getValue();

                        //update the form data into database
                        $this->db->set('order_updatecode', $order_updatecode);
                        $this->db->where('order_id', $order_id);
                        $this->db->where('order_status', 'Pending');
                        $update = $this->db->update('dtd_order', $data);
                        if($this->db->affected_rows() > 0){
                            $msg .= "Row-$row Order Updated<br/>";
                        }
                        else
                        {
                            $msg .= "Row-$row Order Not Updated<br/>";
                        }
                    }
                } catch(Exception $e) {
                    die('Error loading file "'.pathinfo($filepath,PATHINFO_BASENAME).'": '.$e->getMessage());
                }
            }
        }
        $data['msg'] = $msg;
        $this->load->template('vendor/upload_code',$data);
    }
}
