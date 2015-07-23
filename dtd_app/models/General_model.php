<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_Model extends CI_Model{

    function __construct(){
        parent::__construct();
    }
    
    public function get_single_val($select,$table,$where){
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		return current($this->db->get()->row_array());
    }
}
?>