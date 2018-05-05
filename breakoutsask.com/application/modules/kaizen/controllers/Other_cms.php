<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Other_cms extends MY_Controller {
	private $limit = 20;
	var $offset = 0;
    var $contentdata=array();
    var $page_link='';
    
	function __construct()
	{
		parent::__construct();		 
		$this->site_id=$this->config->item("SITE_ID");
		if( ! $this->session->userdata('web_admin_logged_in')) {
			redirect('kaizen/welcome','refresh');
		}
		$this->load->vars( array(
		  'global' => 'Available to all views',
		  'header' => 'common/header',
		  'left' => 'common/left',
			'left_menu' => 'common/other_cms_left',
			'cms_header' => 'common/cms_header',
		  'copyright' => 'common/copyright',
		  'footer' => 'common/footer'
		));
		
		$this->load->model('kaizen/modelother_cms');	
	}

	public function index(){		
		
		$this->dolist();	
	}
	
		
	public function dolist()
	{
		$data = array();
		$where = array('is_active' => 1);
                $order_by = array('id' => 'asc');
                $cms_pages_arr = $this->modelother_cms->select_row('other_cms_pages',$where,$order_by);
                
		if(empty($cms_pages_arr)){
			$data['empty_msg'] = "0 record found.";
		}
		if(!empty($cms_pages_arr[0]->id) && $cms_pages_arr[0]->id > 0)
		{
			redirect("kaizen/other_cms/doedit/".$cms_pages_arr[0]->id,'refresh');
		}
		else
		{
			redirect("kaizen/other_cms/doadd/0",'refresh');
		}
				
	}
	
	
	public function doadd(){
		$data = array();
                $data['details']= new stdClass;
		$cms_id=$this->uri->segment(4);
		$data['details']->is_active = 1;
		$data['details']->id = $cms_id;
		$order_by = array('id' => 'asc');
                
                $cms_list_arr = $this->modelother_cms->select_row('other_cms_pages',array(),$order_by);
                $data['cms_list_arr'] = $cms_list_arr;
                
                $where = array(
                            'site_id' => $this->config->item("SITE_ID"),
                            'parent_id' => 0
                        );
                $order_by = array('id' => 'asc');
                $data['cms_list'] = $this->modelother_cms->select_row('other_cms_pages',$where,$order_by);
                
                $this->load->view('edit_other_cms',$data);		
	}
	public function addedit(){ 
		$this->load->library('form_validation');
		$banner_url = $this->input->post('banner_url','');
		$this->form_validation->set_rules('page_title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="validation_msg">', '</span>');
		$id=$this->input->post('cms_id','');
		if($this->form_validation->run() == TRUE) // IF MENDATORY FIELDS VALIDATION TRUE(SERVER SIDE)  
		{	
                        
                        $where = array(
                            'site_id' => $this->config->item("SITE_ID"),
                            'id' => $id
                        );
                        $cms_detls = $this->modelother_cms->select_row('other_cms_pages',$where);
                    
			if(!empty($cms_detls)) 
			{//echo 'hi';die();
			$uplod_img ="";
                                $orgimgpath=$cms_detls[0]->banner_photo;
                                        if(is_uploaded_file($_FILES['htmlfile']['tmp_name'])) // if image file upload at the updating
                                {
                                        if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'other_cmspages/'.$orgimgpath)){
                                                unlink(file_upload_absolute_path().'other_cmspages/'.$orgimgpath);
                                        }
                                        if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'other_cmspages/thumb_'.$orgimgpath)){
                                                unlink(file_upload_absolute_path().'other_cmspages/thumb_'.$orgimgpath);
                                        }
                                        $uplod_img=uploadImage('htmlfile','other_cmspages');
                                        resizingImage($uplod_img,$upload_rootdir='other_cmspages/',$img_width='1998',$img_height='1060',$img_prefix = 'thumb_');
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
               
               $this->parent_id		=$this->input->post('parent_id','');
                $this->meta_title		=$this->input->post('meta_title',TRUE);
                $this->meta_keyword		=$this->input->post('meta_keyword','');
                $this->meta_description	=$this->input->post('meta_desc','');
                $this->title			=$this->input->post('page_title',TRUE);
                $this->content			=outputEscapeString($this->input->post('content',''));
                $this->display_order	=$this->input->post('display_order',TRUE);
                $this->page_link		=trim($this->input->post('page_title',''));
               
                $this->banner_url		=$this->input->post('banner_url',TRUE); 
                $this->banner_link_title		=$this->input->post('banner_link_title',TRUE); 
                $this->is_active		=$this->input->post('is_active',TRUE); 
               
            if($this->is_active===false){$this->is_active='1';}
            if(empty($this->meta_title)){$this->meta_title=$this->title;}            
                                
                 $upd_data = array(
                                        'parent_id' 		=> $this->parent_id,
                                        'site_id' 			=> $this->config->item("SITE_ID"),
                                        'meta_title' 		=> $this->meta_title,				
                                        'meta_keyword'		=> $this->meta_keyword,   					
                                        'meta_description' 	=> $this->meta_description,  
                                        'title' 			=> $this->title,
                                        'content'			=> $this->content,				
                                        'display_order' 	=> $this->display_order, 
                                        'banner_url' 		=> $this->banner_url, 	
                                        'banner_photo' 		=> $uplod_img, 	
                                        'banner_link_title' => $this->banner_link_title, 
                                        
                                        'is_active' 		=> $this->is_active  					
					);
                 if($this->save_draft==1){
                   
                }
                else{
                    $upd_data['content'] = inputEscapeString($this->content);
                }

                $where_cond=array('id' => $this->input->post('cms_id'));
				if($this->modelother_cms->update_row('other_cms_pages',$upd_data,$where_cond)) // IF UPDATE PROCEDURE EXECUTE SUCCESSFULLY
				{
					$session_data = array("SUCC_MSG"  => "Other CMS Page Updated SUCCESSFULLY.");
					#$this->session->set_userdata($session_data);					
				}			
				else // IF UPDATE PROCEDURE NOT EXECUTE SUCCESSFULLY
				{	
					$session_data = array("ERROR_MSG"  => "Other CMS Page Not Updated.");
					#$this->session->set_userdata($session_data);				
				}
			}
			else 
			{
				$uplod_img ="";	
			if(is_uploaded_file($_FILES['htmlfile']['tmp_name'])) // if image file upload at the updating
                        {	
                                $uplod_img=uploadImage('htmlfile','other_cmspages');
                                resizingImage($uplod_img,$upload_rootdir='other_cmspages/',$img_width='1998',$img_height='1060',$img_prefix = 'thumb_');
                        }
                //$data=$this->contentdata;	
                $this->parent_id		=$this->input->post('parent_id','');
                $this->meta_title		=$this->input->post('meta_title',TRUE);
                $this->meta_keyword		=$this->input->post('meta_keyword','');
                $this->meta_description	=$this->input->post('meta_desc','');
                $this->title			=$this->input->post('page_title',TRUE);
                $this->content			=outputEscapeString($this->input->post('content',''));
                $this->display_order	=$this->input->post('display_order',TRUE);
                $this->page_link		=trim($this->input->post('page_title',''));
               
                $this->banner_url		=$this->input->post('banner_url',TRUE); 
                $this->banner_link_title		=$this->input->post('banner_link_title',TRUE); 
                $this->is_active		=$this->input->post('is_active',TRUE); 
                $page_link = name_replaceCat($this->page_link);
            if($this->is_active===false){$this->is_active='1';}
            if(empty($this->meta_title)){$this->meta_title=$this->title;}

            $add_data = array(
                        'parent_id' 		=> $this->parent_id,
                        'site_id' 			=> $this->config->item("SITE_ID"),
                        'meta_title' 		=> $this->meta_title,				
                        'meta_keyword'		=> $this->meta_keyword,   					
                        'meta_description' 	=> $this->meta_description,  
                        'title' 			=> $this->title,
                        'content'			=> $this->content,				
                        'display_order' 	=> $this->display_order,
                        'banner_url' 		=> $this->banner_url, 	
                        'banner_link_title' => $this->banner_link_title, 
                        'banner_photo' 		=> $uplod_img, 
                        'page_link' 		=> $page_link,
                        'is_active' 		=> $this->is_active  					
                        );
                $id = $this->modelother_cms->insert_row('other_cms_pages',$add_data);
				if($id) // IF UPDATE PROCEDURE EXECUTE SUCCESSFULLY
				{
					$session_data = array("SUCC_MSG"  => "Other CMS Page Inserted SUCCESSFULLY.");
					#$this->session->set_userdata($session_data);					
				}			
				else // IF UPDATE PROCEDURE NOT EXECUTE SUCCESSFULLY
				{	
					$session_data = array("ERROR_MSG"  => "Other CMS Page Not Inserted.");
					$this->session->set_userdata($session_data);				
				}
			}
            
			redirect("kaizen/other_cms/doedit/".$id,'refresh');
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
		//$data['details'] = $this->modelother_cms->editDetail($cms_id);	
                $where = array(
                            'site_id' => $this->config->item("SITE_ID"),
                            'id' => $cms_id
                        );
                $q = $this->modelother_cms->select_row('other_cms_pages',$where);	
                $data['details'] = $q[0];
		///$data['draft_content'] = $this->modelother_cms->getDraft($cms_id);
                $where = array(
                            'site_id' => $this->config->item("SITE_ID"),
                            'parent_id' => 0
                        );
                $order_by = array('id' => 'asc');
                $data['cms_list'] = $this->modelother_cms->select_row('other_cms_pages',$where,$order_by);
		//$data['cms_list']=$this->modelother_cms->getAllParentDetails();
		//$data['hooks_cmsmenu']=$this->get_cms_menu();
		$this->load->view('edit_other_cms',$data);				
	}
	
	
	public function doeditajax(){
		$data = array();
        $data['details']= new stdClass;
		$cms_id=$this->uri->segment(4);
		$where = array(
                            'id' => $cms_id                            
                        );
                $q = $this->modelother_cms->select_row('other_cms_pages',$where);
        //echo $cms_id;
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
                $data['cms_list'] = $this->modelother_cms->select_row('other_cms_pages',$where);

		$this->load->view('edit_other_cms_ajax',$data);		
		
	}
	

	
	
	//=============== END IMAGE MANUPULATION==============//
}