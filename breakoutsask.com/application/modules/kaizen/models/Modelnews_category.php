<?php
class Modelnews_category extends CI_Model{

	var $id='';	
	var $contentdata=array();
	var $news_category_title='';
	var $is_active='';
	var $display_order='';
	var	$content='';
	public function __construct()
    {
        parent::__construct();	
		$this->site_id=$this->session->userdata('SITE_ID');		
    }
	
	
	/**
	 * FIND ALL NO OF RECORDS	 	 
	 *
	 * @access	public	
	 * @return	int
	 */
	
	function getCountAll($curtable,$searchstring="",$pos=0,$cat_id=''){
		if(!empty($searchstring)){
			$this->db->like('parent_id', $searchstring); 
		}
		if(!empty($cat_id)){
			$this->db->where('parent_id', $cat_id); 	
		}
		$this->db->select('id')->from($this->db->dbprefix($curtable));
		$q = $this->db->get();
		$no_record=$q->num_rows();
		#echo $this->db->last_query();exit;	
		if($no_record){				
			return $no_record;	
		}
		else
		{
			#log_message('error',": ".$this->db->_error_message() );
			return false;
		}
	
	}
		// --------------------------------------------------------------------

	/**
	 * FIND ALL THE RECORDS	 	 
	 *
	 * @access	public	
	 * @return	array
	 */
	
	function getSingleRecord($id){
		$sel_query = $this->db->get_where($this->db->dbprefix('news_category'), array('id' => $id));
		if($sel_query)
		{		
			#$res=$sel_query->result();		
			return true;
		}
		else
		{
			#log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
		
	}	
        
   public function getRecordByParentId($curtable,$parent_id){
		$conds = "";
		//if($this->session->userdata('web_admin_user_level')!=1)
		//{
			//$conds = " and `center_id` ='".$this->session->userdata('CENTER_ID')."'";
		//}
		$sel_query = $this->db->query("SELECT id,title,parent_id FROM ".$this->db->dbprefix($curtable)." where `parent_id`='".$parent_id."' and `is_active`='1' ".$conds);	
		
		#echo $this->db->last_query();
		if($sel_query)
		{		
			$res=$sel_query->result();
				
			return $res;	
		}
		else
		{
			#log_message('error',": ".$this->db->_error_message() );
			return false;
		}
	}     
   function getSingleData($id){
		$sel_query = $this->db->get_where($this->db->dbprefix('news_category'), array('id' => $id));
		if($sel_query)
		{		
                        $res=$sel_query->result();		
			return $res;
		}
		else
		{
			#log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
		
	}	
	
	
	function getAllDetails($curtable,$limit = NULL, $offset = NULL, $searchstring="",$pos=0,$cat_id=""){
		#$this->db->where('parent_id',0);
		if(!empty($searchstring)){
			$this->db->where('parent_id', $searchstring); 
		}
		if(!empty($cat_id)){
			$this->db->where('parent_id', $cat_id); 	
		}
		#$this->db->order_by('display_order > 0 desc,display_order asc');
		$this->db->order_by('display_order asc');
		if(!empty($limit)){
			$sel_query = $this->db->get($this->db->dbprefix($curtable),$limit,$offset);	
		}
		else{
			$sel_query = $this->db->get($this->db->dbprefix($curtable));	
		}
		
		#echo $this->db->last_query();exit;
		if($sel_query)
		{		
			$res=$sel_query->result();		
			return $res;	
		}
		else
		{
			#log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
		
	}	
	
function getAllChildDetails($curtable,$limit = NULL, $offset = NULL, $searchstring="",$pos=0){
		$this->db->where('parent_id',0);
		if(!empty($searchstring)){
			$this->db->like('title', $searchstring); 
		}
		#$this->db->order_by('display_order > 0 desc,display_order asc');
		$this->db->order_by('display_order asc');
		if(!empty($limit)){
			$sel_query = $this->db->get($this->db->dbprefix($curtable),$limit,$offset);	
		}
		else{
			$sel_query = $this->db->get($this->db->dbprefix($curtable));	
		}
		
		#echo $this->db->last_query();exit;
		if($sel_query)
		{		
			$res=$sel_query->result();		
			return $res;	
		}
		else
		{
			#log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
		
	}	
	
	function addDetails()
	{
		
		$data=$this->contentdata;	
		$this->news_category_title	= $this->input->post('news_category_title',TRUE);
       # $this->parent_id			= $this->input->post('parent_id',TRUE);	
		$this->is_active			= $this->input->post('is_active','');		
		$this->display_order		= $this->input->post('display_order',TRUE);
		#$this->content				= $this->input->post('content','');
		
		$add_data = array(
   					'title' 			=> $this->news_category_title,
                    #'parent_id'         => $this->parent_id,
					'display_order' 	=> $this->display_order,
					#'content' 			=> $this->content,
					'page_link' 		=> $this->name_replaceCat($this->news_category_title),
					'is_active ' 		=> $this->is_active  					
					);

		if($this->db->insert($this->db->dbprefix('news_category'), $add_data))
		{
			$cmsid=$this->db->insert_id();
			
						 
			return $cmsid;
		
		}else{
			#log_message('error',": ".$this->db->_error_message() );
			
			return false;
		}
	}
	
	
	
	function editDetail($editid)
	{
		if($edit_query = $this->db->get_where($this->db->dbprefix('news_category'), array('id' => $editid)))
		{
			$edit_res=$edit_query->row();		
			return $edit_res;
		}
		else
		{
			#log_message('error',": ".$this->db->_error_message() );
			return false;
		}
		
	}
	

	
	function updateDetais($curid)
	{
		$data=$this->contentdata;	
		
		$this->news_category_title		= $this->input->post('news_category_title',TRUE);
        $this->parent_id		= $this->input->post('parent_id',TRUE);	
		$this->is_active		= $this->input->post('is_active','');		
		$this->display_order	= $this->input->post('display_order',TRUE);
		$this->content			= $this->input->post('content','');
		$upd_data = array(
   					'title' 			=> $this->news_category_title,
                    'parent_id'         => $this->parent_id,
					'display_order' 	=> $this->display_order,
					'content' 			=> $this->content,
					'is_active ' 		=> $this->is_active  					
					);
		
		$where_cond=$this->db->where('id', $curid);
		
		if($this->db->update($this->db->dbprefix('news_category'), $upd_data))
		{
			return true;
		}else{
			#log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
		
	}
	
	
	function delSingleRecord($id='',$curtable='',$curidname='')
	{
		$where_cond=$this->db->where($curidname,$id);
		if($this->db->delete($this->db->dbprefix($curtable))) // RECORD DELETED
		{				
			return true;
		} 
		else{
			return false;
		}		
	}	 	
	
	
	// --------------------------------------------------------------------
	/**
	 * CHANGE STATUS OF RECORD WITH THIS ID
	 *
	 * Can be passed as an int param
	 *
	 * @access	public
	 * @param	int
	 * @return	boolean
	 */	
	function changeStatus($id)
	{		
		
		$sel_field=$this->db->select('is_active');		
		$status_query = $this->db->get_where($this->db->dbprefix('news_category'), array('id' => $id));
		if($status_query)
		{
			$data=array();		
			$res=$status_query->result();
			if($res[0]->is_active==1)
			{
				$data = array(
              				 'is_active' =>0
            				);
				$this->db->where('id', $id);
				if($this->db->update($this->db->dbprefix('news_category'), $data))
				{
					return true; 
				}
				else
				{
					#log_message('error',": ".$this->db->_error_message() );
					return false;
				} 			
			}
			else
			{
				$data = array(
              				 'is_active' =>1
            				);
				$this->db->where('id', $id);
				if($this->db->update($this->db->dbprefix('news_category'), $data))
				{
					return true; 
				}
				else
				{
					#log_message('error',": ".$this->db->_error_message() );
					return false;
				}
			}			
		}
		else
		{
			#log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
	}
	
	

	function name_replaceCat($string)
	{    
		$string = strip_tags(outputEscapeString($string));
		$string = preg_replace('/[^A-Za-z0-9\s\s]/', '', $string);
		$cat_replace = str_replace(" ","_",$string);
		$query = $this->db->query("SELECT `id` FROM `".$this->db->dbprefix('news_category')."` WHERE page_link like '%".$cat_replace."'");
		$count=$query->num_rows();
		if($query){
			$cat_replace=$cat_replace.($count+1);
		}
		return strtolower($cat_replace);
	}
	
	
}
?>