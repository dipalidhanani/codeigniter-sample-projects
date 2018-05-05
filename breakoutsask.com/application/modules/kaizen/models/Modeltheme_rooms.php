<?php
class Modeltheme_rooms extends MY_Model{
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
		$sel_query = $this->db->get_where($this->db->dbprefix('theme_rooms'), array('id' => $id));
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
	
	
	function getAllDetails($curtable){
				
		if(!empty($searchstring)){
			$this->db->like('title', $searchstring); 
		}
		
		
		
		$this->db->order_by('display_order','asc'); 
		
		
			$sel_query = $this->db->get($this->db->dbprefix($curtable));
		
		
		
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
			$this->theme_button_link = 	$this->input->post('theme_button_link');				
		$this->display_order		= $this->input->post('display_order');	
		$this->status		= $this->input->post('status');	
		

		$add_data = array(
   					'title' 			=> $this->title,
					'description'		=> $this->description,
					'theme_image'		=> $uplod_img,
					'theme_background_image'		=> $back_uplod_img,	
					'theme_button_link'  => $this->theme_button_link,					
					'display_order' => $this->display_order,
					'status' => $this->status
					);
		
		if($this->db->insert($this->db->dbprefix('theme_rooms'), $add_data))
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
		if($edit_query = $this->db->get_where($this->db->dbprefix('theme_rooms'), array('id' => $editid)))
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
		$this->theme_button_link = 	$this->input->post('theme_button_link');	
		$this->display_order		= $this->input->post('display_order');	
		$this->status		= $this->input->post('status');
		
		$upd_data = array(
				'title' 			=> $this->title,
					'description'		=> $this->description,									
					'theme_image'		=> $updateDetais,
					'theme_background_image'		=> $back_uplod_img,	
					'theme_button_link'  => $this->theme_button_link,				
					'display_order' => $this->display_order,
					'status' => $this->status
		);
		//if( !empty($this->is_featured)){
                    
         // $this->setfeaturednotfeatured();
       // }
		$where_cond=$this->db->where('id', $curid);
	
		if($this->db->update($this->db->dbprefix('theme_rooms'), $upd_data))
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
		$status_query = $this->db->get_where($this->db->dbprefix('theme_rooms'), array('id' => $id));
				
		
		if($status_query->num_rows()>0)
		{
			$res=$status_query->result();
			if($res[0]->theme_image)
			{
				$orgimgpath = $res[0]->theme_image;
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'theme_image/'.$orgimgpath)){
						unlink(file_upload_absolute_path().'theme_image/'.$orgimgpath);
				}
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'theme_image/thumb_'.$orgimgpath)){
					unlink(file_upload_absolute_path().'theme_image/thumb_'.$orgimgpath);
				}
				
							
			}
			
			if($res[0]->theme_background_image)
			{
				$orgimgpath = $res[0]->theme_background_image;
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'theme_background_image/'.$orgimgpath)){
						unlink(file_upload_absolute_path().'theme_background_image/'.$orgimgpath);
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
		
		$sel_field=$this->db->select('status');		
		$status_query = $this->db->get_where($this->db->dbprefix($curtable), array('id' => $id));
		if($status_query->num_rows()>0)
		{
			$data=array();		
			$res=$status_query->result();
			if($res[0]->status=='Active')
			{//echo "active";
				$data = array(
              				 'status' =>'Inactive'
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
              				 'status' =>'Active'
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
		$status_query = $this->db->get_where($this->db->dbprefix('theme_rooms'), array('id' => $id));
		if($status_query->num_rows()>0)
		{
			$res=$status_query->result();
			
			if($res[0]->$field)
			{
				$orgimgpath = $res[0]->$field;
				
				if($field == 'theme_image'){		
					if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'theme_image/'.$orgimgpath)){
							unlink(file_upload_absolute_path().'theme_image/'.$orgimgpath);
					}
					if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'theme_image/thumb_'.$orgimgpath)){
						unlink(file_upload_absolute_path().'theme_image/thumb_'.$orgimgpath);
					}
				}else if($field == 'theme_background_image'){					
					if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'theme_background_image/'.$orgimgpath)){
							unlink(file_upload_absolute_path().'theme_background_image/'.$orgimgpath);
					}
				}
								
				
				$data = array(
              				 $field =>''
            				);
				$this->db->where('id', $id);
				if($this->db->update($this->db->dbprefix('theme_rooms'), $data))
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
	

	
	
}
?>