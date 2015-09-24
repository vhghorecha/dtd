<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function index()
	{
		$is_login = $this->input->post('btnLogin');

		if($is_login == 'Login')
		{
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
			if ($this->form_validation->run() == true)
			{
				$data = $this->user_model->validate();
				if($data['validated']){
					if($data['is_active'])
					{
						$this->session->set_userdata('userinfo', $data);
						if($data['userrole'] == 'vendor')
						{
							redirect('vendor');
						}else{
							redirect('customer');
						}
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
			$this->load->template('login',$data);
		}
		else
		{
			$this->load->template('login');
		}
	}
}
