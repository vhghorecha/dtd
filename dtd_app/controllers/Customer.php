<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Customer_Model');
        $this->load->model('General_Model');
        $this->load->model('Admin_Model');

        if(!$this->user_model->is_cust()){
            redirect('/');
        }
    }

    public function index()
    {
        $data['all']=$this->Customer_Model->get_all_orders();
        $this->load->template('customer/index',$data);

    }
    public function book_order()
    {
        $data = array();
        $data['item_type'] = $this->Customer_Model->get_item_type();
        $is_order = $this->input->post('btnOrder');
        if($is_order == 'Book Order')
        {
            $config = $this->order_validation();
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE)
            {
                $data['error'] = validation_errors();
                $data['action'] = 'customer/book_order';
            }
            else {
                $data['action'] = 'customer/cnf_order';
                $data['today']=$this->Customer_Model->get_today();
                $data['month']=$this->Customer_Model->get_monthly();
                $data['balance']=$this->Customer_Model->get_user_balance();
                $data['charge']=$this->Customer_Model->get_item_price($this->input->post('item_type'));

            }
        }else{
            $data['action'] = 'customer/book_order';

        }
        $this->load->template('customer/book_order',$data);
    }

    public function order_validation(){
        $config = array(
            array(
                'field' => 'recname',
                'label' => 'Recipient Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s'
                )
            ),
            array(
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s'
                )
            ),
            array(
                'field' => 'telephone',
                'label' => 'Telephone Number',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s',
                )
            ),
            array(
                'field' => 'itemname',
                'label' => 'Item Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s'
                )
            ),
            array(
                'field' => 'item_type',
                'label' => 'Item Type',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must select a %s'
                )
            )
        );
        return $config;
    }

    public function cnf_order()
    {
        $is_order = $this->input->post('btnCnfOrder');
        if($is_order == 'Confirm Order')
        {
            $config = $this->order_validation();
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE)
            {
                //fail validation
                $error = validation_errors();
            }
            else
            {
                //pass validation
                $order_status="";

                $curbalance=$this->input->post('balance');
                $curcharge=$this->input->post('currentcharge');
                $newbalance=$curbalance - $curcharge;
                if($newbalance < 0)
                {
                    $order_status="Created";
                }
                else
                {
                    $order_status="Pending";
                }
                $typeid=$this->input->post('item_type');
                $vendor_id=$this->Customer_Model->get_user_vendor_id();
                $vendor_amount=$this->Customer_Model->set_vendor_price($typeid,$vendor_id);
                $data = array(
                    'order_custid' => $this->user_model->get_current_user_id(),
                    'order_vendorid' => $vendor_id,
                    'order_recipient' => $this->input->post('recname'),
                    'order_address' => $this->input->post('address'),
                    'order_zipcode' => '0',
                    'order_telp' => '0',
                    'order_telno' => $this->input->post('telephone'),
                    'order_mobp' => '0',
                    'order_mobno' => $this->input->post('mobile'),
                    'order_typeid' => $typeid,
                    'order_amount' => $curcharge,
                    'order_itemname' => $this->input->post('itemname'),
                    'order_desc' => $this->input->post('itemdesc'),
                    'order_memo' => $this->input->post('itemmemo'),
                    'order_status' => $order_status,
                    'vendor_amount' => $vendor_amount
                );

                //insert the form data into database
                $this->db->insert('dtd_order', $data);
                //$order_id=$this->db->insert_id();
                if($newbalance >= 0)
                {
                    $this->Customer_Model->set_user_balance(-$curcharge);
                }
                //display success message
                if($newbalance < 0)
                {

                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Your Order Successfully created but not processed due to insufficient balance!!!</div>');
                }
                else
                {

                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Your Order Successfully submitted!!!</div>');
                }

                redirect('customer/book_order');
            }
            $data['error'] = $error;
            $data['item_type'] = $this->Customer_Model->get_item_type();
            $this->load->template('customer/book_order',$data);
        }
        else
        {
            $data['item_type'] = $this->Customer_Model->get_item_type();
            $this->load->template('customer/book_order',$data);
        }
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
                $error = validation_errors();
            }
            else
            {
                //pass validation
                $curpwd=$this->Customer_Model->get_user_pwd();
                if($curpwd['pwd']==$this->input->post('oldpwd'))
                {
                    $data=array(
                        'user_pass'=>$this->input->post('newpwd')
                    );
                    $this->db->where('user_id',$this->user_model->get_current_user_id());
                    $this->db->update('dtd_users',$data);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Password Successfully Changed!!!</div>');
                }
                else
                {
                    $error="Old Password does not match";
                }
            }
            $data['error'] = $error;
            $this->load->template('customer/change_pwd',$data);
        }
        else
        {

            $this->load->template('customer/change_pwd');
        }

    }
    public function confirm_order()
    {
        $this->load->template('customer/cnf-order');
    }

    public function profile()
    {
        $is_profile=$this->input->post('btnEditProfile');
        if($is_profile=="Update Profile")
        {

            $config = array(
                array(
                    'field' => 'username',
                    'label' => 'User Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'usertel',
                    'label' => 'User telephone',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'usercomp',
                    'label' => 'User Company',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),

                array(
                    'field' => 'userrep',
                    'label' => 'User Representative',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),

                array(
                    'field' => 'sercomp',
                    'label' => 'Company Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),


                 array(
                     'field' => 'useradd',
                     'label' => 'Address',
                     'rules' => 'required',
                     'errors' => array(
                         'required' => 'You must provide a %s',
                     )
                 ),

                array(
                    'field' => 'userzip',
                    'label' => 'Zipcode',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),

                array(
                    'field' => 'oldpwd',
                    'label' => 'Old Password',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),

                array(
                    'field' => 'newpwd',
                    'label' => 'New Password',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                    )
                ),
                array(
                    'field' => 'confirmpwd',
                    'label' => 'Confirm Password',
                    'rules' => 'required|matches[newpwd]',
                    'errors' => array(
                        'required' => 'You must provide a %s',
                        'matches' => 'Password and Confirm password must same',
                    )
                ),

            );

            $this->form_validation->set_rules($config);

            if($this->form_validation->run()==true)
            {
                $data1=array(
                    'user_name'=>$this->input->post('username'),
                    'user_add'=>$this->input->post('useradd'),
                    'user_zipcode'=>$this->input->post('userzip'),
                    'user_comp'=>$this->input->post('usercomp'),
                    'user_rep'=>$this->input->post('userrep'),
                    'user_tel'=>$this->input->post('usertel'),
                    //entry of company name and representive name pending change profile
                    'user_site'=>$this->input->post('usersite'),
                    'user_staffname'=>$this->input->post('userstaff'),
                    'user_stafftel'=>$this->input->post('userstafftel'),
                    'user_memo'=>$this->input->post('usermemo'),
                );

                //pass validation
                if($this->input->post('newpwd') != ''){
                    $curpwd=$this->Customer_Model->get_user_pwd();
                    if($curpwd['pwd']==md5($this->input->post('oldpwd'))){
                        if($this->input->post('newpwd') == $this->input->post('confirmpwd')){
                            $data1['user_pass'] = md5($this->input->post('newpwd'));
                            $data['errorp'] = 'Password Updated Successfully';
                        }else{
                            $data['errorp'] = 'New Password & Confirm Password should be equal';
                        }
                    }else{
                        $data['errorp'] = 'Invalid Old Password';
                    }
                }

                $this->db->where('user_id',$this->user_model->get_current_user_id() );
                $this->db->update('users', $data1);

                $data['errorb'] = 'Basic Information Updated Successfully';

                $data2=array(
                    'user_sercomp'=>$this->input->post('sercomp'),
                    'user_lob'=>$this->input->post('lob'),
                    'user_regno'=>$this->input->post('regno'),
                );
                $this->db->where('user_id',$this->user_model->get_current_user_id() );
                $this->db->update('cust', $data2);
                $data['errorc'] = 'Company Information Updated Successfully';

               // $message = 'Customer profile has been updated successfully.';
            }

            else{
                $error = validation_errors();
            }

            if(!empty($error)){
                $data = $_POST;
                $data['error'] = $error;
            }
            if(!empty($message)){
                $data['message'] = $message;
            }


        }
        $data['profile']=$this->Customer_Model->get_user_profile();
        $this->load->template('customer/profile',$data);


    }
    public function orders()
    {
        $data['today']=$this->Customer_Model->get_today();
        $data['today_bi']=$this->Customer_Model->get_today_bi();
        $data['month']=$this->Customer_Model->get_monthly();
        $data['daily'] = $this->Customer_Model->get_daily_orders();
        $data['items'] = $this->Admin_Model->get_all_item_json();
        $data['item_types'] = $this->Customer_Model->get_item_types();
        $data['status_val'] = $this->Admin_Model->get_all_status_json();
        $this->load->template('customer/orders',$data);
    }

    public function orders_pending(){
        $data['items'] = $this->Admin_Model->get_all_item_json();
        $this->load->template('customer/orders_pending',$data);
    }

    public function orders_inprocess(){
        $data['items'] = $this->Admin_Model->get_all_item_json();
        $this->load->template('customer/orders_inprocess',$data);
    }

    public function orders_processed(){
        $data['items'] = $this->Admin_Model->get_all_item_json();
        $this->load->template('customer/orders_processed',$data);
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
                if($msg_to == 'admin')
                {
                    $msg_to = 0;
                }
                if($msg_to === 'vendor')
                {
                    $msg_to=$this->Customer_Model->get_user_vendor_id();
                }

                $filedata = $this->general_model->get_uploaded_file();
                $data['msg_file'] = $filedata['file_name'];

                $date = mdate('%Y-%m-%d %H:%i:%s');
                $data['msg_date'] = $date;
                $data['msg_from'] = $user_id = $this->user_model->get_current_user_id();;
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
            $this->load->template('customer/message',$data);
        }else{
            if(!is_null($msgid))
            {
                $data["txtmsg"] = $this->Admin_Model->get_message($msgid);
                $data["txtsub"] = "Re: " . $this->Admin_Model->get_subject($msgid);
                $data["txtreci"] = $this->Admin_Model->get_from($msgid);
            }
            $data['vendors'] = $this->Admin_Model->get_vendors();
            $data['customers'] = $this->Admin_Model->get_customers();
            $this->load->template('customer/message',$data);
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

            $this->load->template('customer/read_message',$data);
        }

    }
    public function deleteorder($order_id=null)
    {

        $deleteorder=$this->Customer_Model->get_delete_order($order_id);
        $oldbalance=$this->Customer_Model->get_user_balance();
        if($deleteorder['order_status']=="Pending")
        {
            $this->Customer_Model->set_user_balance($deleteorder['order_amount']);
        }
        $this->db->where('order_id',$order_id);
        $this->db->delete('dtd_order');
        redirect("customer/orders");
    }


    public function editorder($order_id=null)
    {
        $data=array();
        $is_order = $this->input->post('btnUpdateOrder');
        if($is_order == 'Update Order') {
            $config = $this->order_validation();
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                //fail validation
                $data['error'] = validation_errors();
            } else {
                $data = array(
                    'order_recipient' => $this->input->post('recname'),
                    'order_address' => $this->input->post('address'),
                    'order_mobno' => $this->input->post('mobile'),
                    'order_telno' => $this->input->post('telephone'),
                    'order_date' => $this->input->post('oda'),
                    'order_itemname' => $this->input->post('itemname'),
                    'order_desc' => $this->input->post('itemdesc'),
                    'order_memo' => $this->input->post('itemmemo'),

                );
                $this->db->where('order_id', $this->input->post('order_id'));
                $this->db->update('dtd_order', $data);
                $data['msg'] = "Order Updated Successfully!!";
            }
        }
        $data['order']=$this->Customer_Model->get_edit_order($order_id);
        $this->load->template('customer/editorder',$data);

    }
    public function updateorder()
    {
        $data=array();
        $is_order = $this->input->post('btnUpdateOrder');
        if($is_order == 'Update Order')
        {
            $config = $this->order_validation();
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE)
            {
                //fail validation
                $error = validation_errors();

            }
            else
            {
                $data=array(
                    'order_recipient'=>$this->input->post('recname'),
                    'order_address'=>$this->input->post('address'),
                    'order_mobno'=>$this->input->post('mobile'),
                    'order_telno'=>$this->input->post('telephone'),
                    'order_date'=>$this->input->post('oda'),
                    'order_itemname'=>$this->input->post('itemname'),
                    'order_desc'=>$this->input->post('itemdesc'),
                    'order_memo'=>$this->input->post('itemmemo'),

                );
                $this->db->where('order_id',$this->input->post('order_id'));
                $this->db->update('dtd_order',$data);

            }





        }
    }
    public function account()
    {
        $data['account'] = $this->Customer_Model->get_user_account();
        $data['yaccount'] = $this->Customer_Model->get_user_account_year();
        $this->load->template('customer/account',$data);
    }

    public function import_order()
    {
        $is_import = $this->input->post('btnImport');
        $data = array();
        $msg = '';
        //Insert Counter
        $totIns = 0;
        $totNotIns = 0;
        if ($is_import == "Import"){
            $config['upload_path']          = './tmp/';
            $config['allowed_types']        = 'xls|xlsx';
            $config['max_size']             = 10240;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload())
            {
                $data['msg'] = $this->upload->display_errors();
                $data['error'] = true;
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
                        $data = array();
                        $data['order_custid'] = $this->user_model->get_current_user_id();
                        $data['order_vendorid'] = $this->Customer_Model->get_user_vendor_id();

                        $data['order_recipient'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $row)->getValue();
                        $data['order_address'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $row)->getValue();
                        $data['order_zipcode'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $row)->getValue();
                        $data['order_telno'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $row)->getValue();
                        $data['order_mobno'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, $row)->getValue();

                        $o_type = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, $row)->getValue();
                        $data['order_typeid'] = $this->General_Model->get_item_id_from_type($o_type);
                        if(empty($data['order_typeid'])){
                            $msg .= "Row-$row Order Not Inserted==>Item Not Found<br/>";
                            $totNotIns++;
                            continue;
                        }
                        $balance = $this->Customer_Model->get_user_balance();
                        $charge = $this->Customer_Model->get_item_price($data['order_typeid']);
                        $newbalance = intval($balance) - intval($charge);
                        if($newbalance < 0)
                        {
                            $order_status="Created";
                        }
                        else
                        {
                            $order_status="Pending";
                        }

                        $data['order_itemname'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6, $row)->getValue();
                        $data['order_desc'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7, $row)->getValue();
                        $data['order_memo'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(8, $row)->getValue();
                        $data['order_status'] = $order_status;
                        $data['order_amount'] = $charge;
                        $data['vendor_amount'] = $this->Customer_Model->set_vendor_price($data['order_typeid'],$data['order_vendorid']);

                        //insert the form data into database
                        $this->db->insert('dtd_order', $data);
                        if($this->db->insert_id() > 0){
                            if($newbalance >= 0){
                                $this->Customer_Model->set_user_balance($charge);
                            }
                            $totIns++;
                        }
                        else
                        {
                            $totNotIns++;
                            $msg .= "Row-$row Order Not Inserted==>" . $this->db->_error_message() . "<br/>";
                        }
                    }
                    @unlink($filepath);
                } catch(Exception $e) {
                    die('Error loading file "'.pathinfo($filepath,PATHINFO_BASENAME).'": '.$e->getMessage());
                }
            }
        }
        $data['msg'] = "Total Order Imported: $totIns<br/>Order Not Imported: $totNotIns<br/>" . $msg;
        $this->load->template('customer/import_order',$data);
    }
}
