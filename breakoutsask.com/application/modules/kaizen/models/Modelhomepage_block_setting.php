<?php
class Modelhomepage_block_setting extends MY_Model{
	var $id='';	
	var $contentdata=array();
	var $title='';
	var $summary='';
	var $is_active='';
	var $description='';
    var $createdate = '';
	var $video_url = '';
	public function __construct()
    {
        parent::__construct();	
    }
	
	
	/**
	 * FIND ALL NO OF RECORDS	 	 
	 *
	 * @access	public	
	 * @return	int
	 */
	
	function getCountAll($curtable,$searchstring="",$pos=1){

		if(!empty($searchstring)){
			$this->db->like('title', $searchstring); 
		}
		
		$this->db->select('id')->from($this->db->dbprefix($curtable));
		$q = $this->db->get();
		$no_record=$q->num_rows();
		#echo $this->db->last_query();exit;	
		if($no_record){				
			return $no_record;	
		}
		/*else
		{
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}*/
	
	}
		// --------------------------------------------------------------------
	function changeStatus($curtable,$id)
	{		
		
		$sel_field=$this->db->select('block_status');		
		$status_query = $this->db->get_where($this->db->dbprefix($curtable), array('id' => $id));
		if($status_query->num_rows()>0)
		{
			$data=array();		
			$res=$status_query->result();
			if($res[0]->block_status=='Active')
			{//echo "active";
				$data = array(
              				 'block_status' =>'Inactive'
            				);
				$this->db->where('id', $id);
				if($this->db->update($this->db->dbprefix($curtable), $data))
				{
					return true; 
				}
				else
				{
					log_message('error',": ".$this->db->_error_message() );
					return false;
				} 			
			}
			else
			{//echo "inactive";
			
				//// Inactive status if section already exist
				$q = $this->db->get_where($this->db->dbprefix($curtable), array('id' => $id));
					
					$res=$q->result();
			
				$qu = $this->db->get_where($this->db->dbprefix($curtable), array('block_section_no' => $res[0]->block_section_no,'block_status' =>'Active'));
				
				$no_record=$qu->num_rows();
				
				if($no_record > 0){
					$this->db->where('block_section_no', $res[0]->block_section_no);
					$this->db->update($this->db->dbprefix($curtable), array('block_status' =>'Inactive'));
					
					}
					
					//// Inactive status if section already exist
			
			
				$data = array(
              				 'block_status' =>'Active'
            				);
				$this->db->where('id', $id);
				if($this->db->update($this->db->dbprefix($curtable), $data))
				{
					
					
					return true; 
				}
				else
				{
					log_message('error',": ".$this->db->_error_message() );
					return false;
				}
			}			
		}
		else
		{
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
	}

	function getSectiontotal($curtable,$section){
		$q = $this->db->get_where($this->db->dbprefix($curtable), array('block_section_no' => $section,'block_status' =>'Active'));
			//$q = $this->db->get();
		$no_record=$q->num_rows();
		#echo $this->db->last_query();exit;	
		if($no_record){				
			return $no_record;	
		}
	}	
	
	function getSingleRecord($id){
		$sel_query = $this->db->get_where($this->db->dbprefix('homepage_block_setting'), array('id' => $id));
		if($sel_query->num_rows()>0)
		{		
			#$res=$sel_query->result();		
			return true;
		}
		/*else
		{
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}*/	
		
	}	
	
	
	function getAllDetails($curtable,$limit = NULL, $offset = NULL, $searchstring="",$pos=1){
				
		if(!empty($searchstring)){
			$this->db->like('title', $searchstring); 
		}
		
		//$this->db->order_by('sequence', 'DESC'); 
		if(!empty($limit)){
			$sel_query = $this->db->get($this->db->dbprefix($curtable),$limit,$offset);	
		}
		else{
			$sel_query = $this->db->get($this->db->dbprefix($curtable));	
		}
		
		#echo $this->db->last_query();exit;
		if($sel_query->num_rows()>0)
		{		
			$res=$sel_query->result();		
			return $res;	
		}
		/*else
		{
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}*/	
		
	}	
	
	
	function addDetails($uplod_img="")
	{		
		$data=$this->contentdata;	
		
	
	
		
		$this->title			= $this->input->post('title',TRUE);
		$this->description		= $this->input->post('description');
		$this->block_section_no		= $this->input->post('block_section_no');	
		$this->block_status     = 	$this->input->post('block_status');		
		$this->about_read_more_link = $this->input->post('about_read_more_link');	
		

		$add_data = array(
   					'title' 			=> $this->title,
					'description'		=> $this->description,
					'block_section_no'		=> $this->block_section_no,	
					'about_read_more_link' 		=> $this->about_read_more_link,						
					'block_background_image'		=> $uplod_img,
					'block_status' => $this->block_status
					);
		
		if($this->db->insert($this->db->dbprefix('homepage_block_setting'), $add_data))
		{
			$post_id=$this->db->insert_id();			
					 
			return $post_id;
		
		}else{
			log_message('error',": ".$this->db->_error_message() );
			
			return false;
		}
	}
	
	public function getallposts(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('homepage_block_setting')."` WHERE `is_featured`='1'"))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	
	function editDetail($editid)
	{
		if($edit_query = $this->db->get_where($this->db->dbprefix('homepage_block_setting'), array('id' => $editid)))
		{
			$edit_res=$edit_query->row();		
				
			return $edit_res;
		}
		else
		{
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}
		
	}
	
	
	function updateDetais($curid,$updateDetais = "")
	{
		$data=$this->contentdata;
	$curtable = 'homepage_block_setting';
		
		$this->title			= $this->input->post('title',TRUE);
		$this->description		= $this->input->post('description');
		$this->block_section_no		= $this->input->post('block_section_no');
		$this->block_status     = 	$this->input->post('block_status');	
		$this->about_read_more_link = $this->input->post('about_read_more_link');	
		
		if($this->block_status == 'Active'){
		$q = $this->db->get_where($this->db->dbprefix($curtable), array('id' => $curid));
					
					$res=$q->result();
			
				$qu = $this->db->get_where($this->db->dbprefix($curtable), array('block_section_no' => $res[0]->block_section_no,'block_status' =>'Active'));
				
				$no_record=$qu->num_rows();
				
				if($no_record > 0){
					$this->db->where('block_section_no', $res[0]->block_section_no);
					$this->db->update($this->db->dbprefix($curtable), array('block_status' =>'Inactive'));
					
					}
					
		}
		
		$upd_data = array(
				'title' 			=> $this->title,
				'description'		=> $this->description,	
				'block_section_no'		=> $this->block_section_no,	
				'about_read_more_link' 		=> $this->about_read_more_link,			
				'block_background_image'		=> $updateDetais,
				'block_status' => $this->block_status
		);
		//if( !empty($this->is_featured)){
                    
         // $this->setfeaturednotfeatured();
       // }
		$where_cond=$this->db->where('id', $curid);
	
		if($this->db->update($this->db->dbprefix('homepage_block_setting'), $upd_data))
		{
			
			return true;
		}else{
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
		
	}
	
	
	function delSingleRecord($id='',$curtable='',$curidname='')
	{			
			
		$sel_field=$this->db->select('*');		
		$status_query = $this->db->get_where($this->db->dbprefix('homepage_block_setting'), array('id' => $id));
				
		
		if($status_query->num_rows()>0)
		{
			$res=$status_query->result();
			if($res[0]->block_background_image)
			{
				$orgimgpath = $res[0]->block_background_image;
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'homepage_background_image/'.$orgimgpath)){
						unlink(file_upload_absolute_path().'homepage_background_image/'.$orgimgpath);
				}
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'homepage_background_image/bg_'.$orgimgpath)){
					unlink(file_upload_absolute_path().'homepage_background_image/thumb_'.$orgimgpath);
				}
			
							
			}
		 }				
		$where_cond=$this->db->where($curidname,$id);
		if($this->db->delete($this->db->dbprefix($curtable))) // RECORD DELETED
		{				
		
			//$where_cond=$this->db->where('post_id',$id);
			//$this->db->delete($this->db->dbprefix('blog_comment'));
			//$where_cond=$this->db->where('post_id',$id);
			//$this->db->delete($this->db->dbprefix('news_post_cat'));
			return true;
		} 
		else{
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
	 
	 
	 	
	function deleteImg($id,$field)
	{		
		
		$sel_field=$this->db->select($field);		
		$status_query = $this->db->get_where($this->db->dbprefix('homepage_block_setting'), array('id' => $id));
		if($status_query->num_rows()>0)
		{
			$res=$status_query->result();
			
			if($res[0]->$field)
			{
				$orgimgpath = $res[0]->$field;
						
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'homepage_background_image/'.$orgimgpath)){
						unlink(file_upload_absolute_path().'homepage_background_image/'.$orgimgpath);
				}
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'homepage_background_image/bg_'.$orgimgpath)){
					unlink(file_upload_absolute_path().'homepage_background_image/thumb_'.$orgimgpath);
				}
				
				$data = array(
              				 $field =>''
            				);
				$this->db->where('id', $id);
				if($this->db->update($this->db->dbprefix('homepage_block_setting'), $data))
				{
					return true; 
				}
				else
				{
					log_message('error',": ".$this->db->_error_message() );
					return false;
				} 			
			}
						
		}
		else
		{
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
	}
	

	function name_replaceCat($string)
	{    
		$string = strip_tags(outputEscapeString($string));
		$string = preg_replace('/[^A-Za-z0-9\s\s]/', '', $string);
		$cat_replace = str_replace(" ","-",$string);
		$query = $this->db->query("SELECT `id` FROM `".$this->db->dbprefix('homepage_block_setting')."` WHERE post_url = '".$cat_replace."'");
		$count=$query->num_rows();
		if($query->num_rows()>0){
			$cat_replace=$cat_replace.($count+1);
		}
		return strtolower($cat_replace);
	}
	
}
?>