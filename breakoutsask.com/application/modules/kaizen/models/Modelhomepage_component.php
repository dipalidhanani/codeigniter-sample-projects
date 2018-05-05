<?php
class Modelhomepage_component extends MY_Model{
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
	

	function getSingleRecord1($curtable,$id){
		$sel_query = $this->db->get_where($this->db->dbprefix($curtable), array('id' => $id));
		if($sel_query->num_rows()>0)
		{		
			#$res=$sel_query->result();		
			return true;
		}
		else
		{
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
		
	}	
	
	function getSingleRecord($id){
		$sel_query = $this->db->get_where($this->db->dbprefix('featured_blocks'), array('id' => $id));
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
	
	
	function getAllDetails($curtable,$section_type){
				
		if(!empty($searchstring)){
			$this->db->like('title', $searchstring); 
		}
		
		
		
		$this->db->order_by('display_order','asc'); 
		if($section_type != ''){
		$sel_query = $this->db->get_where($this->db->dbprefix($curtable), array('block_section_type' => $section_type));
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
	
	
	function addDetails($uplod_img="",$back_uplod_img="")
	{		
		$data=$this->contentdata;	
		
	
	
		
		$this->title			= $this->input->post('title',TRUE);
		$this->description		= $this->input->post('description');
		$this->featured_excerpt		= $this->input->post('featured_excerpt');
		$this->featured_image_type		= $this->input->post('rdofeatured_image');	
		$this->block_section_type		= $this->input->post('block_section_type');		
		$this->block_button_text		= $this->input->post('block_button_text');	
		$this->block_url_link		= $this->input->post('block_url_link');	
		$this->display_order		= $this->input->post('display_order');	
		$this->featured_block_status		= $this->input->post('featured_block_status');	
		

		$add_data = array(
   					'title' 			=> $this->title,
					'description'		=> $this->description,
					'featured_excerpt'		=> $this->featured_excerpt,
					'featured_image_type'		=> $this->featured_image_type,						
					'featured_block_image'		=> $uplod_img,
					'featured_block_background_image'		=> $back_uplod_img,
					'block_section_type' => $this->block_section_type,
					'block_button_text' => $this->block_button_text,
					'block_url_link' => $this->block_url_link,
					'display_order' => $this->display_order,
					'featured_block_status' => $this->featured_block_status
					);
		
		if($this->db->insert($this->db->dbprefix('featured_blocks'), $add_data))
		{
			$post_id=$this->db->insert_id();			
					 
			return $post_id;
		
		}else{
			log_message('error',": ".$this->db->_error_message() );
			
			return false;
		}
	}
	
	public function getallposts(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('featured_blocks')."` WHERE `is_featured`='1'"))
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
		if($edit_query = $this->db->get_where($this->db->dbprefix('featured_blocks'), array('id' => $editid)))
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
	
	
	function updateDetais($curid,$updateDetais = "",$back_uplod_img="")
	{
		$data=$this->contentdata;
	
		
		$this->title			= $this->input->post('title',TRUE);
		$this->description		= $this->input->post('description');
		$this->featured_excerpt		= $this->input->post('featured_excerpt');
		$this->featured_image_type		= $this->input->post('rdofeatured_image');	
		$this->block_section_type		= $this->input->post('block_section_type');		
		$this->block_button_text		= $this->input->post('block_button_text');	
		$this->block_url_link		= $this->input->post('block_url_link');		
		$this->display_order		= $this->input->post('display_order');	
		$this->featured_block_status		= $this->input->post('featured_block_status');
		
		$upd_data = array(
				'title' 			=> $this->title,
				'description'		=> $this->description,	
				'featured_excerpt'		=> $this->featured_excerpt,
				'featured_image_type'		=> $this->featured_image_type,					
				'featured_block_image'		=> $updateDetais,
				'featured_block_background_image'		=> $back_uplod_img,
				'block_section_type' => $this->block_section_type,
				'block_button_text' => $this->block_button_text,
				'block_url_link' => $this->block_url_link,
				'display_order' => $this->display_order,
				'featured_block_status' => $this->featured_block_status
		);
		//if( !empty($this->is_featured)){
                    
         // $this->setfeaturednotfeatured();
       // }
		$where_cond=$this->db->where('id', $curid);
	
		if($this->db->update($this->db->dbprefix('featured_blocks'), $upd_data))
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
		$status_query = $this->db->get_where($this->db->dbprefix('featured_blocks'), array('id' => $id));
				
		
		if($status_query->num_rows()>0)
		{
			$res=$status_query->result();
			if($res[0]->featured_block_image)
			{
				$orgimgpath = $res[0]->featured_block_image;
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'featured_block_image/'.$orgimgpath)){
						unlink(file_upload_absolute_path().'featured_block_image/'.$orgimgpath);
				}
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'featured_block_image/thumb_'.$orgimgpath)){
					unlink(file_upload_absolute_path().'featured_block_image/thumb_'.$orgimgpath);
				}
				
							
			}
			
			if($res[0]->featured_block_background_image)
			{
				$orgimgpath = $res[0]->featured_block_background_image;
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'featured_block_background_image/'.$orgimgpath)){
						unlink(file_upload_absolute_path().'featured_block_background_image/'.$orgimgpath);
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
	
	function changeStatus($curtable,$id)
	{		
		
		$sel_field=$this->db->select('featured_block_status');		
		$status_query = $this->db->get_where($this->db->dbprefix($curtable), array('id' => $id));
		if($status_query->num_rows()>0)
		{
			$data=array();		
			$res=$status_query->result();
			if($res[0]->featured_block_status=='Active')
			{//echo "active";
				$data = array(
              				 'featured_block_status' =>'Inactive'
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
			
							
			
				$data = array(
              				 'featured_block_status' =>'Active'
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
		$status_query = $this->db->get_where($this->db->dbprefix('featured_blocks'), array('id' => $id));
		if($status_query->num_rows()>0)
		{
			$res=$status_query->result();
			
			if($res[0]->$field)
			{
				$orgimgpath = $res[0]->$field;
				
				if($field == 'featured_block_image'){		
					if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'featured_block_image/'.$orgimgpath)){
							unlink(file_upload_absolute_path().'featured_block_image/'.$orgimgpath);
					}
					if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'featured_block_image/thumb_'.$orgimgpath)){
						unlink(file_upload_absolute_path().'featured_block_image/thumb_'.$orgimgpath);
					}
				}else if($field == 'featured_block_background_image'){					
					if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'featured_block_background_image/'.$orgimgpath)){
							unlink(file_upload_absolute_path().'featured_block_background_image/'.$orgimgpath);
					}
				}
								
				
				$data = array(
              				 $field =>''
            				);
				$this->db->where('id', $id);
				if($this->db->update($this->db->dbprefix('featured_blocks'), $data))
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
		$query = $this->db->query("SELECT `id` FROM `".$this->db->dbprefix('featured_blocks')."` WHERE post_url = '".$cat_replace."'");
		$count=$query->num_rows();
		if($query->num_rows()>0){
			$cat_replace=$cat_replace.($count+1);
		}
		return strtolower($cat_replace);
	}
	
}
?>