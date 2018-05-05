<?php
class Modelnews_posts extends MY_Model{
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
		else
		{
			log_message('error',": ".$this->db->_error_message() );
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
	function changeFeatured($curtable,$id)
	{		
		
		$sel_field=$this->db->select('is_featured');		
		$status_query = $this->db->get_where($this->db->dbprefix($curtable), array('id' => $id));
		if($status_query->num_rows()>0)
		{
			$data=array();		
			$res=$status_query->result();
			if($res[0]->is_featured==1)
			{
				$data = array(
              				 'is_featured' =>0
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
			{
				$this->setfeaturednotfeatured();
				$data = array(
              				 'is_featured' =>1
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
	function changeStatus($curtable,$id)
	{		
		
		$sel_field=$this->db->select('is_active');		
		$status_query = $this->db->get_where($this->db->dbprefix($curtable), array('id' => $id));
		if($status_query->num_rows()>0)
		{
			$data=array();		
			$res=$status_query->result();
			if($res[0]->is_active==1)
			{
				$data = array(
              				 'is_active' =>0
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
			{
				$data = array(
              				 'is_active' =>1
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
		$sel_query = $this->db->get_where($this->db->dbprefix('news_post'), array('id' => $id));
		if($sel_query->num_rows()>0)
		{		
			#$res=$sel_query->result();		
			return true;
		}
		else
		{
			//log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
		
	}	
	
	
	function getAllDetails($curtable,$limit = NULL, $offset = NULL, $searchstring="",$pos=1){
				
		if(!empty($searchstring)){
			$this->db->like('title', $searchstring); 
		}
		
		$this->db->order_by('create_dt', 'DESC'); 
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
		else
		{
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
		
	}	
	
	
	function addDetails($uplod_img="")
	{		
		$data=$this->contentdata;	
		
		$this->posted_by = $this->input->post('posted_by',TRUE);
		if($this->posted_by==''){
			$this->posted_by ='anonymous';
		}
		
		$this->title			= $this->input->post('title',TRUE);
		$this->description		= $this->input->post('description');		
		$this->is_active		= $this->input->post('is_active','');
		//$this->is_featured		= $this->input->post('is_featured',TRUE);	
		/*$this->meta_title		= $this->input->post('meta_title',TRUE);
		$this->meta_desc		= $this->input->post('meta_desc',TRUE);		*/		
		$category				= $this->input->post('selected_cat_id',TRUE);
 	    $this->createdate		= $this->input->post('createdate',TRUE);	
		
		
		if($this->is_active===false)
		{
		$this->is_active='1';
		}
		$add_data = array(
   					'title' 			=> $this->title,
					'description'		=> $this->description,	
					/*'meta_title'		=> $this->meta_title,
					'meta_description' 	=> $this->meta_desc,	*/
					'post_url' 			=> $this->name_replaceCat($this->title),
					'video_url'			=> $this->video_url,
					'create_dt'   		=> $this->createdate,
					'edit_dt'    		=> $this->createdate,
					'is_active' 		=> $this->is_active,
					//'is_featured'  		=>$this->is_featured,
					'posted_by ' 		=> $this->posted_by,
					'banner_photo'		=> $uplod_img
					);
		if( !empty($this->is_featured)){
                    
          $this->setfeaturednotfeatured();
        }		
		if($this->db->insert($this->db->dbprefix('news_post'), $add_data))
		{
			$post_id=$this->db->insert_id();
			
			if(isset($category) && count($category)>0)
			{
				foreach($category as $category_tm=>$category_tm_val)
				{
					
						
						$add_cat_data = array(
												'cat_id' 	=> $category_tm_val ,				
												'post_id'	=> $post_id
												);
						$this->db->insert($this->db->dbprefix('news_post_cat'), $add_cat_data);
						#echo $this->db->last_query();
					
				}
			
			}			 
			return $post_id;
		
		}else{
			log_message('error',": ".$this->db->_error_message() );
			
			return false;
		}
	}
	
	public function getallposts(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('news_post')."` WHERE `is_featured`='1'"))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	   public function setfeaturednotfeatured(){
            $getallposts = $this->getallposts();
            $id_arr = array();
            foreach($getallposts as $post){
                $id_arr[] = $post->id;
            }
            if(!empty($id_arr)){
                $this->db->where_in('id', $id_arr);
                $data_is_featured = array('is_featured' => '0');
                $this->db->update($this->db->dbprefix('news_post'), $data_is_featured);
                return true;
            }
        }
	
	function editDetail($editid)
	{
		if($edit_query = $this->db->get_where($this->db->dbprefix('news_post'), array('id' => $editid)))
		{
			$edit_res=$edit_query->row();		
			if($edit_query_category = $this->db->get_where($this->db->dbprefix('news_post_cat'), array('post_id' => $edit_res->id)))
			{
				$edit_res->selectedcategory=$edit_query_category->result();
			}
			else
			{
				$edit_res->selectedcategory=array();
			}		
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
			
		$this->posted_by = $this->input->post('posted_by',TRUE);
		if($this->posted_by==''){
			$this->posted_by ='anonymous';
		}
		
		$this->title			= $this->input->post('title',TRUE);
		$this->description		= $this->input->post('description');	
		$this->is_active		= $this->input->post('is_active','');
		$this->is_featured		= $this->input->post('is_featured',TRUE);		
		$this->meta_title		= $this->input->post('meta_title',TRUE);
		$this->meta_desc		= $this->input->post('meta_desc',TRUE);		
    	$category				= $this->input->post('selected_cat_id',TRUE);
        $this->createdate		= $this->input->post('createdate',TRUE);
 	    $this->video_url		= $this->input->post('video_url',TRUE);	
		$this->excerpt			= $this->input->post('excerpt');
		
		if($this->is_active===false)
		{
			$this->is_active='1';
		}
		$upd_data = array(
				'title' 			=> $this->title,
				'description'		=> $this->description,	
				'meta_title'		=> $this->meta_title,
				'meta_description' 	=> $this->meta_desc,	
				'video_url'			=> $this->video_url,
				'create_dt'   		=> $this->createdate,
				'edit_dt'   		=> $this->createdate,
				'excerpt'   		=> $this->excerpt,
				'is_active ' 		=> $this->is_active,
				'is_featured'  		=>$this->is_featured,
				'posted_by ' 		=> $this->posted_by,
				'banner_photo'		=> $updateDetais
		);
		if( !empty($this->is_featured)){
                    
          $this->setfeaturednotfeatured();
        }
		$where_cond=$this->db->where('id', $curid);
		//$this->db->set('edit_dt','NOW()',FALSE);
		if($this->db->update($this->db->dbprefix('news_post'), $upd_data))
		{
			if(isset($category) && count($category)>0)
			{
				$where_cond=$this->db->where('post_id',$curid);
				$this->db->delete($this->db->dbprefix('news_post_cat'));
				foreach($category as $category_tm=>$category_tm_val)
				{
					
						//print_r($category_tm_val);
						$add_cat_data = array(
												'cat_id' 	=> $category_tm_val ,				
												'post_id'	=> $curid
												);
						$this->db->insert($this->db->dbprefix('news_post_cat'), $add_cat_data);
						#echo $this->db->last_query();
					
				}
			
			}
			return true;
		}else{
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}	
		
	}
	
	
	function delSingleRecord($id='',$curtable='',$curidname='')
	{			
			
		$sel_field=$this->db->select('*');		
		$status_query = $this->db->get_where($this->db->dbprefix('news_post'), array('id' => $id));
				
		
		if($status_query->num_rows()>0)
		{
			$res=$status_query->result();
			if($res[0]->banner_photo)
			{
				$orgimgpath = $res[0]->banner_photo;
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'news_posts/'.$orgimgpath)){
						unlink(file_upload_absolute_path().'news_posts/'.$orgimgpath);
				}
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'news_posts/thumb_'.$orgimgpath)){
					unlink(file_upload_absolute_path().'news_posts/thumb_'.$orgimgpath);
				}
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'news_posts/sthumb_'.$orgimgpath)){
					unlink(file_upload_absolute_path().'news_posts/sthumb_'.$orgimgpath);
				}
							
			}
		 }				
		$where_cond=$this->db->where($curidname,$id);
		if($this->db->delete($this->db->dbprefix($curtable))) // RECORD DELETED
		{				
		
			//$where_cond=$this->db->where('post_id',$id);
			//$this->db->delete($this->db->dbprefix('blog_comment'));
			$where_cond=$this->db->where('post_id',$id);
			$this->db->delete($this->db->dbprefix('news_post_cat'));
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
		$status_query = $this->db->get_where($this->db->dbprefix('news_post'), array('id' => $id));
		if($status_query->num_rows()>0)
		{
			$res=$status_query->result();
			
			if($res[0]->$field)
			{
				$orgimgpath = $res[0]->$field;
						
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'news_posts/'.$orgimgpath)){
						unlink(file_upload_absolute_path().'news_posts/'.$orgimgpath);
				}
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'news_posts/thumb_'.$orgimgpath)){
					unlink(file_upload_absolute_path().'news_posts/thumb_'.$orgimgpath);
				}
				if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'news_posts/sthumb_'.$orgimgpath)){
					unlink(file_upload_absolute_path().'news_posts/sthumb_'.$orgimgpath);
				}					
				
				$data = array(
              				 $field =>''
            				);
				$this->db->where('id', $id);
				if($this->db->update($this->db->dbprefix('news_post'), $data))
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
		$query = $this->db->query("SELECT `id` FROM `".$this->db->dbprefix('news_post')."` WHERE post_url = '".$cat_replace."'");
		$count=$query->num_rows();
		if($query->num_rows()>0){
			$cat_replace=$cat_replace.($count+1);
		}
		return strtolower($cat_replace);
	}
	
}
?>