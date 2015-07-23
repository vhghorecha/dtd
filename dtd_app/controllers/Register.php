<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('encryption');
	}
	
	public function index()
	{
		$this->load->template("registration");
	}
	public function validate()
	{
		$data = array(
			'user_name' => 'Vimal Ghorecha',
			'user_email' => 'vimal14569@gmail.com',
			'user_pass' => $this->encryption->encrypt('vigour'),
			'user_zipcode' => 360004,
			'user_mob' => '7405100630',
			'user_regno' => '123',
			'user_ser_comp' => 'Eryushion',
			'user_grade' => 1,
			'user_role' => 'customer'
		);
		$this->user_model->user_insert($data);
		die();
		$is_reg = $this->input->post('btnRegister');

		if($is_reg == 'Register'){
			$config = array(
				array(
					'field' => 'txtemail',
					'label' => 'E-mail',
					'rules' => 'required|valid_email',
					'errors' => array(
						'required' => 'You must provide a %s',
						'valid_email' => 'You must provide a valid %s'
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
			if ($this->form_validation->run() == true) {
				$data = $this->user_model->validate();
				if($data['validated']){
					$this->session->set_data('userinfo', $data);
					if($data['userrole'] == 'vendor'){
						redirect('vendor');
					}else{
						redirect('customer');
					}
				}else{
					$error = "Invalid Email or Password";
				}
			}else{
				$error = validation_errors();
			}
			$data['error'] = $error;
			$this->load->template('register',$data);
		}else{
			$this->load->template('register');
		}
	}
}
