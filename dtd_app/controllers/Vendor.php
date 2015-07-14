<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {
	
	public function index()
	{
		$this->load->template('vendor/index');
	}
	public function orders_received()
	{
		$this->load->template('vendor/orders_received');
	}
	public function view_order()
	{
		$this->load->template('vendor/view_order');
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
	{
		$this->load->template('vendor/profile');
	}
	public function orders()
	{
		$this->load->template('vendor/orders');
	}
	public function account()
	{
		$this->load->template('vendor/account');
	}
}
