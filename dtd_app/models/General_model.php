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
        $result = $this->db->get()->row_array();
        if(!is_null($result)){
            return current($result);
        }
		return "";
    }

    public function get_item_id_from_type($type_name){
        return $this->get_single_val('type_id', 'item_type', array('type_name' => $type_name));
    }

    public function get_uploaded_file()
    {
        $config['upload_path'] = './dtd_asset/files/';
        $config['allowed_types'] = 'gif|jpg|png|doc|docx|xls|xlsx|pdf|txt|jpeg|swf|flv';
        $config['max_size']	= '10000';
        $config['max_width']  = '5000';
        $config['max_height']  = '5000';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            //$error = array('error' => $this->upload->display_errors());
            $filedata = null;

        }
        else
        {
            $filedata = $this->upload->data();
            return $filedata;
        }
    }
}
?>