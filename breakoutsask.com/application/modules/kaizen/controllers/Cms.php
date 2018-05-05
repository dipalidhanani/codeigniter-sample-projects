<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cms extends MY_Controller {
	private $limit = 20;
	var $offset = 0;
	function __construct()
	{
		parent::__construct();
		if( ! $this->session->userdata('web_admin_logged_in')) {
			redirect('login','refresh');
		}
		$this->load->vars( array(
		  'global' => 'Available to all views',
		  'header' => 'common/header',
		  'left' => 'common/left',
			'left_menu' => 'common/left_menu',
			'cms_header' => 'common/cms_header',
		  'copyright' => 'common/copyright',
		  'footer' => 'common/footer'
		));
		$this->load->model('modelcms');
	}

	public function index(){
		$this->dolist();	
	}
	
		
	public function dolist($searchstring="")
	{
		$data = array();
		$data['details']= new stdClass;
                $where = array('is_active' => 1);
                $order_by = array('id' => 'asc');
                $cms_pages_arr = $this->modelcms->select_row('cms_pages',$where,$order_by);
                
		if(empty($cms_pages_arr)){
			$data['empty_msg'] = "0 record found.";
		}
		if(!empty($cms_pages_arr[0]->id) && $cms_pages_arr[0]->id  > 0)
		{
			redirect("kaizen/cms/doedit/".$cms_pages_arr[0]->id,'refresh');
		}
		else
		{
			redirect("kaizen/cms/doadd/0",'refresh');
		}
		
		
				
	}
	
	public function doadd(){
		$data = array();
		$data['details']= new stdClass;
		$cms_id=$this->uri->segment(3);
		$data['details']->is_active = 1;
		$data['details']->id = 0;
                
               
                $order_by = array('id' => 'asc');
                
                $cms_list_arr = $this->modelcms->select_row('cms_pages',array(),$order_by);
                
		if(empty($cms_list_arr)){
			$data['empty_msg'] = "0 record found.";
		}
		$data['cms_list_arr'] = $cms_list_arr;
                
                $where = array(
                            'site_id' => $this->config->item("SITE_ID"),
                            'parent_id' => 0
                        );
                $order_by = array('id' => 'asc');
                $data['cms_list'] = $this->modelcms->select_row('cms_pages',$where,$order_by);
                
		$this->load->view('edit_cms',$data);		
	}
	public function addedit(){ 
		$this->load->library('form_validation');
		$banner_url = $this->input->post('banner_url','');
		$this->form_validation->set_rules('page_title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="validation_msg">', '</span>');
		$parent_id=$this->input->post('parent_id',TRUE);
		$id=$this->input->post('cms_id','');
		if($this->form_validation->run() == TRUE) // IF MENDATORY FIELDS VALIDATION TRUE(SERVER SIDE)  
		{
                    $where = array(
                            'site_id' => $this->config->item("SITE_ID"),
                            'id' => $id
                        );
                    $cms_detls = $this->modelcms->select_row('cms_pages',$where);
        		if(!empty($cms_detls)) 
			{
                            
				$uplod_img ="";
                                $orgimgpath=$cms_detls[0]->banner_photo;
                                        if(is_uploaded_file($_FILES['htmlfile']['tmp_name'])) // if image file upload at the updating
                                {
                                        if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'cmspages/'.$orgimgpath)){
                                                unlink(file_upload_absolute_path().'cmspages/'.$orgimgpath);
                                        }
                                        if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'cmspages/thumb_'.$orgimgpath)){
                                                unlink(file_upload_absolute_path().'cmspages/thumb_'.$orgimgpath);
                                        }
                                        $uplod_img=uploadImage('htmlfile','cmspages');
                                        resizingImage($uplod_img,$upload_rootdir='cmspages/',$img_width='1998',$img_height='1060',$img_prefix = 'thumb_');
                                        if(empty($uplod_img) || $uplod_img==false)
                                        {
                                                $session_data = array("ERROR_MSG"  => "Error in image uploading.");
                                                $this->session->set_userdata($session_data);	
                                                
                                        }
                                }	
                                else
                                {
                                        $uplod_img=$orgimgpath;
                                }
                                
                                
                                
                                
                                
				
				$this->parent_id		=$this->input->post('parent_id',TRUE);
                                $this->meta_title		=$this->input->post('meta_title',TRUE);
                                $this->meta_keyword		=$this->input->post('meta_keyword','');
                                $this->meta_description	=$this->input->post('meta_desc','');
                                $this->title			=$this->input->post('page_title',TRUE);
                                $this->content			=outputEscapeString($this->input->post('content',''));
                                $this->display_order	=$this->input->post('display_order',TRUE);
                                $this->page_link		=trim($this->input->post('page_title',''));
                                $this->is_active		=$this->input->post('is_active',TRUE); 
                                $this->banner_heading	=outputEscapeString($this->input->post('banner_heading',''));
                                $this->banner_text		=outputEscapeString($this->input->post('banner_text',''));
                                $this->banner_url		=$this->input->post('banner_url',TRUE); 
                                $this->banner_link_title		=$this->input->post('banner_link_title',TRUE); 
                                $this->show_story		=$this->input->post('show_story',TRUE); 
                                if($this->is_active===false){
                                        $this->is_active='1';
                                }
                                if(empty($this->meta_title)){$this->meta_title=$this->title;}
						
		$update_data = array(
   					'parent_id' 		=> $this->parent_id ,
					'site_id' 				=> $this->config->item("SITE_ID"),
   					'meta_title' 		=> $this->meta_title ,				
					'meta_keyword'		=> $this->meta_keyword,   					
					'meta_description' 	=> $this->meta_description,  
					'title' 			=> $this->title,
   					'content'			=> inputEscapeString($this->content),				
					'display_order' 	=> $this->display_order, 
					 
					'banner_photo' 		=> $uplod_img, 
					
					'banner_heading' 		=> $this->banner_heading, 
					'banner_text' 		=> $this->banner_text,
					'banner_url' 		=> $this->banner_url, 
					'banner_link_title' => $this->banner_link_title,
					'is_active' 		=> $this->is_active  					
					);
                                $update_where = array('id' => $id);
				if($this->modelcms->update_row('cms_pages',$update_data,$update_where)) // IF UPDATE PROCEDURE EXECUTE SUCCESSFULLY
				{
					
					$session_data = array("SUCC_MSG"  => "CMS Page Updated SUCCESSFULLY.");
					#$this->session->set_userdata($session_data);					
				}			
				else // IF UPDATE PROCEDURE NOT EXECUTE SUCCESSFULLY
				{	
					$session_data = array("ERROR_MSG"  => "CMS Page Not Updated.");
					$this->session->set_userdata($session_data);				
				}
			}
			else 
			{
                            
			$uplod_img ="";	
			if(is_uploaded_file($_FILES['htmlfile']['tmp_name'])) // if image file upload at the updating
                        {	
                                $uplod_img=uploadImage('htmlfile','cmspages');
                                resizingImage($uplod_img,$upload_rootdir='cmspages/',$img_width='1998',$img_height='1060',$img_prefix = 'thumb_');
                        }
                                
		$this->parent_id		=$this->input->post('parent_id',TRUE);
		$this->meta_title		=$this->input->post('meta_title',TRUE);
		$this->meta_keyword		=$this->input->post('meta_keyword','');
		$this->meta_description	=$this->input->post('meta_desc','');
		$this->title			=$this->input->post('page_title',TRUE);
		$this->content			=outputEscapeString($this->input->post('content',''));
		$this->display_order	=$this->input->post('display_order',TRUE);
		$this->page_link		=trim($this->input->post('page_title',''));
		$this->is_active		=$this->input->post('is_active',TRUE); 
		$this->banner_heading	=outputEscapeString($this->input->post('banner_heading',''));
		$this->banner_text		=outputEscapeString($this->input->post('banner_text',''));
		$this->banner_url		=$this->input->post('banner_url',TRUE); 
		$this->banner_link_title		=$this->input->post('banner_link_title',TRUE); 
		$this->show_story		=$this->input->post('show_story',TRUE); 
		if($this->is_active===false){
			$this->is_active='1';
		}
		if(empty($this->meta_title)){$this->meta_title=$this->title;}
						
		$add_data = array(
   					'parent_id' 		=> $this->parent_id ,
					'site_id' 				=> $this->config->item("SITE_ID"),
   					'meta_title' 		=> $this->meta_title ,				
					'meta_keyword'		=> $this->meta_keyword,   					
					'meta_description' 	=> $this->meta_description,  
					'title' 			=> $this->title,
   					'content'			=> inputEscapeString($this->content),				
					'display_order' 	=> $this->display_order, 
					 
					'banner_photo' 		=> $uplod_img, 
					
					'banner_heading' 		=> $this->banner_heading, 
					'banner_text' 		=> $this->banner_text,
					'banner_url' 		=> $this->banner_url, 
					'banner_link_title' => $this->banner_link_title, 
					'page_link' 		=> name_replaceCat($this->page_link),
					'is_active' 		=> $this->is_active  					
					);
                
                        
                        
			$id = $this->modelcms->insert_row('cms_pages',$add_data);
                        //echo $id;
				if($id) // IF UPDATE PROCEDURE EXECUTE SUCCESSFULLY
				{
					
					$session_data = array("SUCC_MSG"  => "CMS Page Inserted SUCCESSFULLY.");
					#$this->session->set_userdata($session_data);					
				}			
				else // IF UPDATE PROCEDURE NOT EXECUTE SUCCESSFULLY
				{	
					$session_data = array("ERROR_MSG"  => "CMS Page Not Inserted.");
					$this->session->set_userdata($session_data);				
				}
			}
			redirect("kaizen/cms/doedit/".$id,'refresh');
		}
		else{
			if(!empty($id)){
			$this->doedit();
			}
			else{
				$this->doadd();
			}
		}
	}
	public function doedit(){
		$data = array();
		$data['details']= new stdClass;
		$cms_id=$this->uri->segment(4);
		
                $where = array(
                            'site_id' => $this->config->item("SITE_ID"),
                            'id' => $cms_id
                        );
                $q = $this->modelcms->select_row('cms_pages',$where);
                    
		$data['details'] = $q[0];
			
		$where = array(
                            'site_id' => $this->config->item("SITE_ID"),
                            'parent_id' => 0
                        );
                $order_by = array('id' => 'asc');
                $data['cms_list'] = $this->modelcms->select_row('cms_pages',$where,$order_by);
		
		$this->load->view('edit_cms',$data);				
	}
	
	
	public function doeditajax(){
			$data = array();
			$data['details']= new stdClass;
		$cms_id=$this->uri->segment(4);
		$order_by = array('id' => 'asc');
                
                $cms_list_arr = $this->modelcms->select_row('cms_pages',array(),$order_by);
		
                $where = array(
                            'id' => $cms_id                            
                        );
                $q = $this->modelcms->select_row('cms_pages',$where);
                
                
		if($q){
			$data['details'] = $q[0];		
			
		}
		else{
			$data['details']->is_active = 1;
			$data['details']->id = $cms_id;
		}
		
		$where = array(
                            'site_id' => $this->config->item("SITE_ID")
                            
                        );
                $data['cms_list'] = $this->modelcms->select_row('cms_pages',$where);
		$this->load->view('edit_cms_ajax',$data);	
		
	}
	
	
}