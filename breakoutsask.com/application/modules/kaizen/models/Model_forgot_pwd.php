<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_forgot_pwd extends  MY_Model {

	public function __construct(){
		parent::__construct();
	}

public function is_temp_pass_valid($temp_pass){
    $this->db->where('reset_pass', $temp_pass);
    $query = $this->db->get(dbprefix('admin'));
    if($query->num_rows() == 1){
        return TRUE;
    }
    else return FALSE;
}
	
	
}