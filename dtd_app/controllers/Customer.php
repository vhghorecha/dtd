<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	function __construct(){
        parent::__construct();
		$this->load->model('user_model');
		if(!$this->user_model->is_cust()){
			redirect('/');
		}
    }
	
	public function index()
	{
		$this->load->template('customer/index');
 
	}
	public function book_order()
	{
		$this->load->template('customer/book_order');              
	}
	public function change_pwd()
	{
		$this->load->template('customer/change_pwd');
	}
	public function confirm_order()
	{
		$this->load->template('customer/cnf-order');              
	}
	
	public function profile()
	{
		$this->load->template('customer/profile');              
	}
	public function orders()
	{
		$this->load->template('customer/orders');              
	}
	public function account()
	{
		$this->load->template('customer/account');              
	}
}
