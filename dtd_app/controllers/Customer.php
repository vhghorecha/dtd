<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	function __construct(){
        parent::__construct();
		$this->load->model('user_model');
		$this->load->model('Customer_Model');
		$this->load->model('General_Model');

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
				'field' => 'mobile',
				'label' => 'Mobile Number',
				'rules' => 'required|numeric',
				'errors' => array(
					'required' => 'You must provide a %s',
					'numeric' => '%s must be numeric'
				)
			),
			array(
				'field' => 'telephone',
				'label' => 'Telephone Number',
				'rules' => 'required|numeric',
				'errors' => array(
					'required' => 'You must provide a %s',
					'numeric' => '%s must be numeric'
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
				'field' => 'itemdesc',
				'label' => 'Item Description',
				'rules' => 'required',
				'errors' => array(
					'required' => 'You must provide a %s'
				)
			),
			array(
				'field' => 'itemmemo',
				'label' => 'Item Memo',
				'rules' => 'required',
				'errors' => array(
					'required' => 'You must provide a %s'
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
				$data = array(
					'order_custid' => $this->user_model->get_current_user_id(),
					'order_vendorid' => $this->Customer_Model->get_user_vendor_id(),
					'order_recipient' => $this->input->post('recname'),
					'order_address' => $this->input->post('address'),
					'order_zipcode' => '0',
					'order_telp' => '0',
					'order_telno' => $this->input->post('telephone'),
					'order_mobp' => '0',
					'order_mobno' => $this->input->post('mobile'),
					'order_typeid' => $this->input->post('item_type'),
					'order_amount' => $curcharge,
					'order_itemname' => $this->input->post('itemname'),
					'order_desc' => $this->input->post('itemdesc'),
					'order_memo' => $this->input->post('itemmemo'),
					'order_status' => $order_status
				);

				//insert the form data into database
				$this->db->insert('dtd_order', $data);
				$this->Customer_Model->set_user_balance($newbalance);
				//display success message
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Your Order Successfully submitted!!!</div>');
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
			$data1=array(
				'user_name'=>$this->input->post('username'),
				'user_add'=>$this->input->post('useradd'),
				'user_zipcode'=>$this->input->post('userzip'),
				'user_tel'=>$this->input->post('usertel'),
				'user_mob'=>$this->input->post('usermob'),
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
		}
		$data['profile']=$this->Customer_Model->get_user_profile();
		$this->load->template('customer/profile',$data);


	}
	public function orders()
	{
		$data['today']=$this->Customer_Model->get_today();
		$data['month']=$this->Customer_Model->get_monthly();
		$data['daily'] = $this->Customer_Model->get_daily_orders();
		$this->load->template('customer/orders',$data);
	}
	public function account()
	{
		$data['account'] = $this->Customer_Model->get_user_account();
		$this->load->template('customer/account',$data);
	}

	public function import_order()
	{
		$is_import = $this->input->post('btnImport');
		$data = array();
		$data['msg'] = '';
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
						$c_email = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $row)->getValue();
						$data['order_custid'] = $this->Customer_Model->get_user_id_by_email($c_email);

						$v_email = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $row)->getValue();
						$data['order_vendorid'] = $this->Customer_Model->get_user_id_by_email($v_email);

						$data['order_recipient'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $row)->getValue();
						$data['order_address'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $row)->getValue();
						$data['order_zipcode'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, $row)->getValue();
						$data['order_telno'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, $row)->getValue();
						$data['order_mobno'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6, $row)->getValue();

						$o_type = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7, $row)->getValue();
						$data['order_typeid'] = $this->General_Model->get_item_id_from_type($o_type);
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

						$data['order_itemname'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(8, $row)->getValue();
						$data['order_desc'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(9, $row)->getValue();
						$data['order_memo'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(10, $row)->getValue();
						$data['order_status'] = $order_status;
						$data['order_amount'] = $charge;

						//insert the form data into database
						$this->db->insert('dtd_order', $data);
						if($this->db->insert_id() > 0){
							$this->Customer_Model->set_user_balance($newbalance);
							@$data['msg'] .= "Row-$row Order Inserted<br/>";
						}
						else
						{
							$data['msg'] .= "Row-$row Order Not Inserted==>" . $this->db->_error_message() . "<br/>";
						}
					}
				} catch(Exception $e) {
					die('Error loading file "'.pathinfo($filepath,PATHINFO_BASENAME).'": '.$e->getMessage());
				}
			}
		}
		$this->load->template('customer/import_order',$data);
	}
}
