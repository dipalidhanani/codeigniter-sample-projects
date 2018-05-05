<?php
class Modelhomepage_slider extends MY_Model{
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
		
		$sel_field=$this->db->select('slider_status');		
		$status_query = $this->db->get_where($this->db->dbprefix($curtable), array('id' => $id));
		if($status_query->num_rows()>0)
		{
			$data=array();		
			$res=$status_query->result();
			if($res[0]->slider_status=='Active')
			{//echo "active";
				$data = array(
              				 'slider_status' =>'Inactive'
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
              				 'slider_status' =>'Active'
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
		$sel_query = $this->db->get_where($this->db->dbprefix('homepage_slider'), array('id' => $id));
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
		
		$this->db->order_by('sequence', 'DESC'); 
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
		$this->heading_line1		= $this->input->post('heading_line1');
		$this->heading_line2		= $this->input->post('heading_line2');
		$this->url_link		= $this->input->post('url_link');
		$this->button_text		= $this->input->post('button_text');
		$this->select_image_or_video		= $this->input->post('select_image_or_video');
		$this->slider_video_url		= $this->input->post('slider_video_url');	
		$this->sequence     = 	$this->input->post('sequence');
		$this->slider_status     = 	$this->input->post('slider_status');		
		
		

		$add_data = array(
   					'title' 			=> $this->title,
					'heading_line1'		=> $this->heading_line1,
					'heading_line2'		=> $this->heading_line2,
					'url_link'		=> $this->url_link,
					'button_text'		=> $this->button_text,
					'select_image_or_video'		=> $this->select_image_or_video,
					'slider_video_url'		=> $this->slider_video_url,						
					'slider_image'		=> $uplod_img,
					'sequence' => $this->sequence,
					'slider_status' => $this->slider_status
					);
		
		if($this->db->insert($this->db->dbprefix('homepage_slider'), $add_data))
		{
			$post_id=$this->db->insert_id();			
					 
			return $post_id;
		
		}else{
			log_message('error',": ".$this->db->_error_message() );
			
			return false;
		}
	}
	

	
	function editDetail($editid)
	{
		if($edit_query = $this->db->get_where($this->db->dbprefix('homepage_slider'), array('id' => $editid)))
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
	
	
	function updateDetais($curid,$uplod_img = "")
	{
		$data=$this->contentdata;
	
		
		$this->title			= $this->input->post('title',TRUE);
		$this->heading_line1		= $this->input->post('heading_line1');
		$this->heading_line2		= $this->input->post('heading_line2');
		$this->url_link		= $this->input->post('url_link');
		$this->button_text		= $this->input->post('button_text');
		$this->select_image_or_video		= $this->input->post('select_image_or_video');
		$this->slider_video_url		= $this->input->post('slider_video_url');	
		$this->sequence     = 	$this->input->post('sequence');
		$this->slider_status     = 	$this->input->post('slider_status');		
		
		$upd_data = array(
				'title' 			=> $this->title,
					'heading_line1'		=> $this->heading_line1,
					'heading_line2'		=> $this->heading_line2,
					'url_link'		=> $this->url_link,
					'button_text'		=> $this->button_text,
					'select_image_or_video'		=> $this->select_image_or_video,
					'slider_video_url'		=> $this->slider_video_url,						
					'slider_image'		=> $uplod_img,
					'sequence' => $this->sequence,
					'slider_status' => $this->slider_status
		);
		//if( !empty($this->is_featured)){
                    
         // $this->setfeaturednotfeatured();
       // }
		$where_cond=$this->db->where('id', $curid);
	
		if($this->db->update($this->db->dbprefix('homepage_slider'), $upd_data))
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
		$status_query = $this->db->get_where($this->db->dbprefix('homepage_slider'), array('id' => $id));
				
		
		if($status_query->num_rows()>0)
		{
			$res=$status_query->result();
			if($res[0]->slider_image)
			{
				$orgimgpath = $res[0]->slider_image;
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'slider_image/'.$orgimgpath)){
						unlink(file_upload_absolute_path().'slider_image/'.$orgimgpath);
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
		$status_query = $this->db->get_where($this->db->dbprefix('homepage_slider'), array('id' => $id));
		if($status_query->num_rows()>0)
		{
			$res=$status_query->result();
			
			if($res[0]->$field)
			{
				$orgimgpath = $res[0]->$field;
						
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'slider_image/'.$orgimgpath)){
						unlink(file_upload_absolute_path().'slider_image/'.$orgimgpath);
				}
				
				
				$data = array(
              				 $field =>''
            				);
				$this->db->where('id', $id);
				if($this->db->update($this->db->dbprefix('homepage_slider'), $data))
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
		$query = $this->db->query("SELECT `id` FROM `".$this->db->dbprefix('homepage_slider')."` WHERE post_url = '".$cat_replace."'");
		$count=$query->num_rows();
		if($query->num_rows()>0){
			$cat_replace=$cat_replace.($count+1);
		}
		return strtolower($cat_replace);
	}
	
}
?>