<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_Model extends CI_Model{

    function __construct(){
        parent::__construct();
    }
    
    public function get_single_val($select,$table,$where = null){
		$this->db->select($select);
		$this->db->from($table);
        if(!is_null($where)){
            $this->db->where($where);
        }
        $row_array = $this->db->get()->row_array();
        if(!is_null($row_array)){
            return current($row_array);
        }
		return '';
    }

    public function get_item_id_from_type($type_name){
        return $this->get_single_val('type_id', 'item_type', array('type_name' => $type_name));
    }
}
?>