<?php
class Modelfaq extends MY_Model{

	var $id='';	
	var $contentdata=array();
	var $language_title='';
	var $language_url='';
	var $image_url='';
	var $language_photo='';
	var $is_active='';
	var $display_order='';
	var	$site_id='';
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
	
	function getCountAll($curtable,$searchstring="",$pos=0){//
		if(!empty($searchstring)){
			$this->db->like('title', $searchstring); 
		}

		
		$this->db->select('id')->from($this->db->dbprefix($curtable));
		$q = $this->db->get();
		$no_record=$q->num_rows();
		//$no_record=1;
		if($no_record){//print_r($no_record);exit;				
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
		$sel_query = $this->db->get_where($this->db->dbprefix('faq'), array('id' => $id));//print_r($sel_query->row_array());exit;
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
	
	function getAllActivedata(){
		$sel_query = $this->db->get_where($this->db->dbprefix('language'), array('site_id'=>$this->site_id,'is_active'=>1));
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
	
	
	function getAllDetails($curtable,$limit = NULL, $offset = NULL, $searchstring="",$pos=0){
		/*$this->db->where('site_id', $this->site_id); */
		if(!empty($searchstring)){
			$this->db->like('title', $searchstring); 
		}
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
		
		$this->title		= $this->input->post('title',TRUE);
		$this->is_active		= $this->input->post('is_active','');		
		$this->content		= $this->input->post('content','');		
		$this->display_order	= $this->input->post('display_order',TRUE);
		$this->cat_id	= $this->input->post('cat_id',TRUE);
		
		$add_data = array(
   					'title' 			=> $this->title,
					'display_order' 	=> $this->display_order,
					'content' 	=> $this->content,
					'cat_id' 	=> $this->cat_id,
					'is_active ' 		=> $this->is_active  					
					);

		if($this->db->insert($this->db->dbprefix('faq'), $add_data))
		{
			$cmsid=$this->db->insert_id();
			
						 
			return $cmsid;
		
		}else{
			#log_message('error',": ".$this->db->_error_message() );
			
			return false;
		}
	}
	
	function activeinactive($id){
			$count = 1;
			$activedata = $this->getAllActivedata();
			foreach($activedata as $data){
				if($data->id != $id){
					if($count > 2){
						$updata_data = array('is_active'=>0);
						$this->db->where('id', $data->id);
						$this->db->update($this->db->dbprefix('language'), $updata_data);
					}
					$count++;
				}
			}
			
	}
	
	function editDetail($editid)
	{
		if($edit_query = $this->db->get_where($this->db->dbprefix('faq'), array('id' => $editid)))
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
	

	
	function updateDetais($curid,$uplod_img='')
	{
		$data=$this->contentdata;	
		$this->is_active		= $this->input->post('is_active',TRUE);
		$this->title		= $this->input->post('title',TRUE);
		$this->display_order	= $this->input->post('display_order',TRUE);
		$this->content	= $this->input->post('content','');
		$this->cat_id	= $this->input->post('cat_id',TRUE);
	//	print_r($this->is_active);exit;
		$upd_data = array(
   					'title' 			=> $this->title,
					'display_order' 	=> $this->display_order,
					'content' 	=> $this->content,
					'cat_id' 	=> $this->cat_id,
					'is_active ' 		=> $this->is_active  					
					);
		$where_cond=$this->db->where('id', $curid);
		
		if($this->db->update($this->db->dbprefix('faq'), $upd_data))
		{
			if(!empty($this->is_active)){
				//$this->activeinactive($curid);
			}
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
		$status_query = $this->db->get_where($this->db->dbprefix('faq'), array('id' => $id));
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
				if($this->db->update($this->db->dbprefix('faq'), $data))
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
				if($this->db->update($this->db->dbprefix('faq'), $data))
				{
					
						//$this->activeinactive($id);
					
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
	
		// --------------------------------------------------------------------
	/**
	 * Dlete Image WITH THIS ID
	 *
	 * Can be passed as an int param
	 *
	 * @access	public
	 * @param	int
	 * @return	boolean
	 */
	 
	 
	 	
	
	
	// --------------------------------------------------------------------
	/**
	 * CHANGE POSITION OF RECORD WITH THIS ID
	 *
	 * Can be passed as an int param
	 *
	 * @access	public
	 * @param	array	 
	 */	
	
	function changepos($updateRecordsArray)
	{
	
		$listingCounter = 1;
		
		foreach ($updateRecordsArray as $recordIDValue) {		
			
			$data = array(
              				'listing_pos' =>$listingCounter
            			);
				$this->db->where('id', $recordIDValue);
				
				if($this->db->update($this->db->dbprefix('category_master'), $data))
				{
					$listingCounter = $listingCounter + 1;		
					
				}
				else
				{
					#log_message('error',": ".$this->db->_error_message() );
					
					return false;
				}
		
		}		
		
	}
	
}
?>