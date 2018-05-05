<?php
class Modelcontact extends MY_Model{
	public function __construct()
    {
        parent::__construct();	
		$this->site_id=$this->session->userdata('SITE_ID');		
    }
	
	function getSingleRecordPageName($id){
		
		$sel_query=$this->db->where('site_id', 1); 
		$sel_query=$this->db->where_in('id', $id); 
		$sel_query=$this->db->select('*')->from('cms_pages');
		$sel_query = $this->db->get();
		
		//$sel_query = $this->db->get_where($this->db->dbprefix('cms_pages'), array('id' => $id,'site_id'=>$this->site_id));
		if($sel_query->num_rows()>0)
		{		
			$res=$sel_query->result();		
			return $res;
		}
		else
		{
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
		
	}	
}
?>