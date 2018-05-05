<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
  protected $table_prefix = '';
  public function __construct(){ 
    parent::__construct();
  }
  
	public function dolist_common($tablename,$viewname){
		if(empty($tablename) || empty($viewname))
			return false;

		$data = array();
		$update_where = array();
		$data_row = $this->select_row($tablename,$update_where);
		$data['records']= $data_row;
		$this->load->view($viewname,$data);		
	}

	public function doedit_common($tablename,$viewname,$where){
		$data = array();
		$q = $this->custom_m->select_row($tablename,$where);

		$data['details']= $q['0'];

		$this->load->view($viewname,$data);		
	}

	public function getDetailsById($tablename,$idname,$idvalue,$statusname="",$statusvalue=""){
    $idwhere = '';
    $statuswhere = '';
    if(!empty($statusname) && !empty($statusvalue)){
      $statuswhere = " AND ".$statusname."=".$statusvalue;
    }
    
    if(!empty($idname) && !empty($idvalue)){
      $idwhere = $idname."=".$idvalue;
    }
    else{
      return false;
      echo "error";
    }
    
    if(!empty($idwhere)){
		  $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix($tablename)." WHERE ".$idwhere.$statuswhere);
  		if ($query->num_rows()) {
        return $query->row();
      }
      else{ 
        return false;
      }
    }
    else{
      return false;
      echo "error 1";
    }

	}
	function getAllDataByField($table_name,$update_where,$extra_cond=''){
	 $where_cond = array();
			$where_cond = implode(' AND ', array_map(function ($value, $key) {  return $key . " ='" . $value . "'"; }, $update_where, array_keys($update_where)));
			if(!empty($extra_cond)){
				$where_cond .= " ".$extra_cond;
				}
		$query = $this->db->get_where($table_name, $where_cond);
		//echo $this->db->last_query(); exit;
		 if($query->row()){
			return $query->result();
		}else{
			return false;
		}
	}
	function getAllDataByField_distinct($table_name,$update_where,$distinctField=''){
	 $this->db->distinct();
 $this->db->select($distinctField);
			//$where_cond = implode(' AND ', array_map(function ($value, $key) {  return $key . " ='" . $value . "'"; }, $update_where, array_keys($update_where)));
			
			if(!empty($update_where)){
    $where_cond = implode(' AND ', array_map(function ($value, $key) { 
      return $key . " ='" . $value . "'"; }, $update_where, array_keys($update_where))
    ); // do not change anything in this string.
    }else{
        $where_cond = array();
    }
			
		$query = $this->db->get_where($table_name, $where_cond);
		//echo $this->db->last_query(); exit;
		 if($query->row()){
			return $query->result();
		}else{
			return false;
		}
	}
  
  /*
      $this->load->model('base_model','custom_m');
			$insert_data=array(
				'prg_id'=>$prg_id,
				'cat_id'=>$category_ids,
				'status'=>$status,
				'create_on'=>$cur_date,
				'create_by'=>$this->updated_by
			);
			$id=$this->custom_m->insert_row('case',$insert_data);  
  */
	function insert_row($table_name,$insert_data){
		$this->db->insert($this->db->dbprefix($table_name), $insert_data);
		return 	$this->db->insert_id();
	}
  /*
      $this->load->model('base_model','custom_m');
			$update_data=array(
				'prg_id'=>$prg_id,
				'cat_id'=>$category_ids,
				'status'=>$status,
				'create_on'=>$cur_date,
				'create_by'=>$this->updated_by
			);
			$update_where=array(
				'prg_id'=>$prg_id,
				'cat_id'=>$category_ids
			);
			$id=$this->custom_m->update_row('case',$update_data,$update_where);  
  */
  
	function update_row($table_name,$update_data,$update_where){
		$where_cond = '';
    if(empty($update_where))
      return false;

    $where_cond = implode(' AND ', array_map(function ($value, $key) { 
      return $key . " ='" . $value . "'"; }, $update_where, array_keys($update_where))
    ); // do not change anything in this string.
    
    $this->db->where($where_cond);
    if($this->db->update($table_name,$update_data)){
			return true;
		}else{
			return false;
		}
	}
  /*
      $this->load->model('base_model','custom_m');
			$update_data=array(
				'prg_id'=>$prg_id,
				'cat_id'=>$category_ids,
				'status'=>$status,
				'create_on'=>$cur_date,
				'create_by'=>$this->updated_by
			);
			$update_where=array(
				'prg_id'=>$prg_id,
				'cat_id'=>$category_ids
			);
			$id=$this->custom_m->update_row('case',$update_data,$update_where);  
  */
  
	function delete_row($table_name,$update_where){
		$where_cond = '';
    if(empty($update_where))
      return false;
    
    $where_cond = implode(' AND ', array_map(function ($value, $key) { 
      return $key . " ='" . $value . "'"; }, $update_where, array_keys($update_where))
    ); // do not change anything in this string.
    
    $this->db->where($where_cond);
    if($this->db->delete($table_name)){
			return true;
		}else{
			return false;
		}
	}
  function getCountAll($table_name,$update_where){
		$where_cond = implode(' AND ', array_map(function ($value, $key) { 
      return $key . " ='" . $value . "'"; }, $update_where, array_keys($update_where))
    );
    $query = $this->db->get_where($table_name, $where_cond);
    
    return $query->num_rows();
}
        
	function select_row($table_name,$update_where=array(),$order_by =  array()){
		$where_cond = '';
    /*if(empty($update_where)){
        $where_cond = array(
                            'deleted' => 0
                        );
    $query = $this->db->get_where($table_name, $where_cond);
    if($query->row()){
			return $query->result();
		}else{
			return false;
		}
    }*/
    if(!empty($update_where)){
    /* Commented By Bishweswar Start*/
    /*$where_cond = implode(' AND ', array_map(function ($value, $key) { 
      return $key . " ='" . $value . "'"; }, $update_where, array_keys($update_where))
    ); */// do not change anything in this string.
        /* Commented By Bishweswar End*/
        /* Added By Bishweswar Start*/
      foreach($update_where as $key => $val){
          $this->db->where($key, $val);
      }
      /* Added By Bishweswar End*/
    }else{
        $where_cond = array();
    }
    if(!empty($order_by)){
        foreach($order_by as $key => $val){
            $this->db->order_by($key, $val);
        }
    }
    //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
    /* Commented By Bishweswar Start*/
   // $query = $this->db->get_where($table_name, $where_cond);
    /* Commented By Bishweswar End*/
    /* Added By Bishweswar Start*/
    $query = $this->db->get($table_name);
    /* Added By Bishweswar End*/
    
    
    //$this->db->where($where_cond);
    //echo $this->db->last_query();
    if($query->row()){
			return $query->result();
		}else{
			return false;
		}
	}
    
  
 	public function performaction($action,$tablename,$data,$update_where)	{
    
    if(empty($action))
      return false;
    
    if($action == 'Insert'){
      $id=$this->insert_row($tablename,$data);
      return $id;
    }
    else if($action == 'Update'){
      $id=$this->update_row($tablename,$data,$update_where);
      return $id;
    }
    else if($action == 'Delete'){
      $id=$this->delete_row($tablename,$update_where); 	  
      return $id;
    }
    else{
      return "Something is wrong.";
    }    
 	}
  
  public function uploadImage($foldername,$field='',$orglogo_photo1){	
		$upload_dir=$foldername;
		$field_name=$field;
  
    if(is_uploaded_file($_FILES[$field_name]['tmp_name'])){ // if image file upload at the updating
			if(!empty($orglogo_photo1) && is_file(file_upload_absolute_path().$upload_dir.$orglogo_photo1)){
				unlink(file_upload_absolute_path().$upload_dir.$orglogo_photo1);
			}
    }
    
      
    
    	
  				
		
  		if(!is_dir(file_upload_absolute_path().$upload_dir)){			
  			$oldumask = umask(0); 
  			mkdir(file_upload_absolute_path().$upload_dir, 0777); // or even 01777 so you get the sticky bit set 
  			umask($oldumask);			
  		}
		 	$config['upload_path'] = file_upload_absolute_path().$upload_dir;
  		$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|ppt|pptx|xls|xlsx';
      $config['max_size'] = '5000';
      $config['max_width'] = '2500';
      $config['max_height'] = '2500'; 

      $this->load->library('upload', $config); // LOAD FILE UPLOAD LIBRARY
  		$this->upload->initialize($config);

  		$data['upload_data'] = '';
      
      if($this->upload->do_upload($field_name)){ // CREATE ORIGINAL IMAGE  								
  			$fInfo = $this->upload->data();					
  			$data['uploadInfo'] = $fInfo;
  			return $fInfo['file_name']; // RETURN ORIGINAL IMAGE NAME
  		}
      else{ // IF ORIGINAL IMAGE NOT UPLOADED
        //echo $this->upload->display_errors(); die();	
  			return false; // RETURN ORIGINAL IMAGE NAME              
      }
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */