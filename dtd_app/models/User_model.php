<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_Model extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->library('encryption');
    }
    
    public function validate(){
        // grab user input
        $email = $this->security->xss_clean($this->input->post('txtemail'));
        $password = $this->security->xss_clean($this->input->post('txtpass'));
        // Prep the query
        $this->db->where('user_email', $email);
        $this->db->where('user_pass', $password);
        
        // Run the query
        $query = $this->db->get('users');
		
        // Let's check if there are any results
        if($query->num_rows() > 0)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
				'userid' => $row->user_id,
				'username' => $row->user_name,
				'userrole' => $row->user_role,
				'validated' => true
			);
            return $data;
        }
        // If the previous process did not validate
        // then return false.
        return array('validated' => false);
    }
	
	public function is_logged(){
		$user_data = $this->session->userdata('userinfo');
		return $user_data['validated'];
    }
	
	public function is_cust(){
		$user_data = $this->session->userdata('userinfo');
		return $user_data['userrole'] == 'customer';
	}
	
	public function is_vendor(){
		$user_data = $this->session->userdata('userinfo');
		return $user_data['userrole'] == 'vendor';
	}
	
	public function is_admin(){
		$user_data = $this->session->userdata('userinfo');
		return $user_data['userrole'] == 'admin';
	}

	public function get_current_user(){
		$user_data = $this->session->userdata('userinfo');
		return $user_data;
	}
	
	public function get_current_user_id(){
		$user_data = $this->session->userdata('userinfo');
		return $user_data['userid'];
	}
	
	public function user_insert($data){
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}

    public function update_pwd($data){
        $this->db->where('user_id',$this->get_current_user_id());
        $this->db->update('dtd_users',$data);
    }
}
?>