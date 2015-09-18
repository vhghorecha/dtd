<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
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
					'field' => 'txtmobile',
					'label' => 'Zipcode',
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
				$data['user_pass'] = $this->input->post('txtpass');
				$data['user_add'] = $this->input->post('txtaddress');
				$data['user_zipcode'] = $this->input->post('txtzip');
				$data['user_tel'] = $this->input->post('txttel');
				$data['user_mob'] = $this->input->post('txtmobile');
				$data['user_site'] = $this->input->post('txtsite');
				$data['user_staffname'] = $this->input->post('txtperson');
				$data['user_stafftel'] = $this->input->post('txtpmob');
				$data['user_role'] = $this->input->post('user_type');
				$user_id = $this->user_model->user_insert($data);
				$user_data = array(
					'userid' => $user_id,
					'username' => $data['user_name'],
					'userrole' => $data['user_role'],
					'validated' => true
				);
				$this->session->set_userdata('userinfo', $user_data);
				if($data['user_role'] == 'vendor')
				{
					redirect('vendor');
				}else{
					redirect('customer');
				}
				
			}else{
				$error = validation_errors();
			}
			$data = $_POST;
			$data['error'] = $error;
			$this->load->template('registration',$data);
		}else{
			$this->load->template('registration');
		}
	}
}
