<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('customer_model');
		$this->load->model('vendor_model');
		$this->load->library('encryption');
	}
	
	public function register()
	{
		$is_reg = $this->input->post('btnRegister');

		if($is_reg == 'Register'){
			$config = array(
				array(
					'field' => 'txtname',
					'label' => 'User Name',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				),
				array(
					'field' => 'txtusername',
					'label' => 'E-mail',
					'rules' => 'required|valid_email|is_unique[users.user_email]',
					'errors' => array(
						'required' => 'You must provide a %s',
						'valid_email' => 'You must provide a valid %s',
						'is_unique' => 'Email address already registered...',
					)
				),
				array(
					'field' => 'txtpass',
					'label' => 'Password',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				),
				array(
					'field' => 'txtcpass',
					'label' => 'Password',
					'rules' => 'required|matches[txtpass]',
					'errors' => array(
						'required' => 'You must provide a %s',
						'matches' => 'Password and Confirm password must same',
					)
				),
				array(
					'field' => 'txtzip',
					'label' => 'Zipcode',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				),
				array(
					'field' => 'txtrepname',
					'label' => 'Representive Name',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				),
				array(
					'field' => 'txtname',
					'label' => 'Company Name',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				),
				array(
					'field' => 'txtaddress',
					'label' => 'Address',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				),
				array(
					'field' => 'txttel',
					'label' => 'Telephone Number',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == true) {
				$data['user_name'] = $this->input->post('txtname');
				$data['user_email'] = $this->input->post('txtusername');
				$data['user_pass'] = md5($this->input->post('txtpass'));
				$data['user_add'] = $this->input->post('txtaddress');
				$data['user_zipcode'] = $this->input->post('txtzip');
				$data['user_tel'] = $this->input->post('txttel');
				$data['user_comp'] = $this->input->post('txtname');
				$data['user_rep'] = $this->input->post('txtrepname');
				$data['user_site'] = $this->input->post('txtsite');
				$data['user_staffname'] = $this->input->post('txtperson');
				$data['user_stafftel'] = $this->input->post('txtpmob');
				$data['user_role'] = $this->input->post('user_type');
				$user_id = $this->user_model->user_insert($data);
				if($user_id > 0){
					$user_data = array(
						'userid' => $user_id,
						'username' => $data['user_name'],
						'userrole' => $data['user_role'],
						'validated' => true
					);
					$this->session->set_userdata('userinfo', $user_data);
					$ins_data['user_id'] = $user_id;

					if($data['user_role'] == 'vendor')
					{
						$ins_data['pay_bankacno']=$this->input->post('txtbank');
						$this->vendor_model->insert($ins_data);
					}else{
						$data['user_grade'] = $this->general_model->get_single_val('grade_id','cust_grade');
						$this->customer_model->insert($ins_data);
					}
					$message = "Register successfully. Admin will activate your account.";
				}
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
			$this->load->template('registration',$data);
		}else{
			$this->load->template('registration');
		}
	}

	public function lostpwd(){
		$data = array();
		$getpass = $this->input->post('btnReset');
		if($getpass == 'Get New Password'){
			$this->load->library('Escaptcha', array('id' => 'lostpwd'));
			$answer = $this->security->xss_clean($this->input->post('txtcaptcha'));
			$captcha = $this->escaptcha->check_captcha($answer);
			if($captcha) {
				$config = array(
					array(
						'field' => 'txtemail',
						'label' => 'E-mail',
						'rules' => 'required|valid_email',
						'errors' => array(
							'required' => 'You must provide a %s',
							'valid_email' => 'You must provide a valid %s',
						)
					),
				);
				$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == true) {
					$email = $this->input->post('txtemail');
					$is_changed = $this->user_model->reset_user_pwd($email);
					if ($is_changed) {
						$this->load->library('email');

						$this->email->from('admin@dtd.com', 'Admin');
						$this->email->to($email);

						$this->email->subject('You New Password for DTD');
						$this->email->message('You New Password : ' . $is_changed);

						$this->email->send();
						$message = 'New password sent on your email address';
					} else {
						$error = 'Email address not registered...';
					}
				} else {
					$error = validation_errors();
				}
			}else{
				$error = 'Invalid Captcha...';
			}
		}
		if(!empty($error)){
			$data['error'] = $error;
		}
		if(!empty($message)){
			$data['message'] = $message;
		}
		$this->load->template('lostpwd',$data);
	}

	public function logout(){
		$this->session->unset_userdata('userinfo');
		redirect("/");
	}
}
