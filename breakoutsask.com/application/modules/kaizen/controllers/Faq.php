<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends MY_Controller 
{
	private $limit = 20;
	var $offset = 0;
	function __construct()
	{
		parent::__construct();		 
		
		if( ! $this->session->userdata('web_admin_logged_in')) {
			redirect('kaizen/welcome','refresh');
		}
		$this->load->vars( array(
		  'global' => 'Available to all views',
		  'header' => 'common/header',
		  //'left' => 'common/faq_left',
		  'left' => 'common/left',
		  'footer' => 'common/footer',
		  'copyright' => 'common/copyright'
		));
		$this->load->library('pagination');
		$this->load->model('modelfaq','custom_m');
		$this->load->library('image_lib'); // LOAD IMAGE THUMB LIBRARY	
	}

	public function index()
	{		
		//$this->load->helper('security');
		$offsets = (($this->uri->segment(4)) ? $this->uri->segment(4) : 1);
		if($offsets>1){$this->offset = (($offsets - 1)*$this->limit);}else{$this->offset = ($offsets - 1);}
		$searchstring = xss_clean(rawurldecode($this->input->get('q')));
		$this->dolist($searchstring);	
	}
	
	public function pagination($searchstring="",$total_row=0){
		$config['use_page_numbers'] = TRUE;		
		if(!empty($searchstring)){
			$config['uri_segment'] = 4;
			$config['base_url'] = site_url("kaizen/faq/dosearch/".rawurlencode($searchstring)."/");
		}
		else{
			$config['uri_segment'] = 3;
			$config['base_url'] = site_url("kaizen/faq/index/");
		}
		$config['total_rows'] = $total_row;
		$config['per_page'] = $this->limit;
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		$config['next_link'] = '&gt;';
		$config['prev_link'] = '&lt;';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';	
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		return $config;
	}
	
	public function dolist($searchstring=""){//
		$data = array();
		$pos = $this->input->get('pos',TRUE);
		
		$total_row = $this->custom_m->getCountAll("faq",$searchstring,$pos);
		//$this->pagination($searchstring,$total_row);
		//$data['q'] = $searchstring;
		//print_r($data['q']);exit;
		$data_row = $this->custom_m->getAllDetails("faq",$this->limit,$this->offset,$searchstring,$pos);
		if(empty($data_row)){
			$data['empty_msg'] = $total_row."No record found.";
		}
		$data['total_records']= $total_row;
		$data['records']= $data_row;
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('faq',$data);		
	}
	public function dosearch(){
		//$this->load->helper('security');
		$offsets = (($this->uri->segment(5)) ? $this->uri->segment(5) : 1);
		if($offsets>1){$this->offset = (($offsets - 1)*$this->limit);}else{$this->offset = ($offsets - 1);}
		$searchstring = xss_clean(rawurldecode($this->uri->segment(4)));
		$this->dolist($searchstring);	
	}
	public function doadd(){
		$data = array();
		$data['details'] = new stdClass();
		$faq_id=$this->uri->segment(4);
		$data['details']->is_active = 1;
		$data['details']->id = $faq_id;
		
		$data_row = $this->custom_m->getAllDetails("faq");
		$data['records']= $data_row;
		
		$total_row = $this->custom_m->getCountAll("faq");
		$data['total_records']= $total_row;
	//	print_r("asa");exit;
		$this->load->view('edit_faq',$data);		
	}
	public function addedit()
	{//print_r($_POST);exit;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'faq', 'trim|required|xss_clean');
		
		
		$this->form_validation->set_error_delimiters('<span class="validation_msg">', '</span>');
		$id=$this->input->post('id','');
		if($this->form_validation->run() == TRUE) // IF MENDATORY FIELDS VALIDATION TRUE(SERVER SIDE)  
		{	
			if(!empty($id) && $this->custom_m->getSingleRecord($id)) 
			{
			
				if($this->custom_m->updateDetais($id)) // IF UPDATE PROCEDURE EXECUTE SUCCESSFULLY
				{
					$session_data = array("SUCC_MSG"  => "Faq Updated Successfully.");
					$this->session->set_userdata($session_data);					
				}			
				else // IF UPDATE PROCEDURE NOT EXECUTE SUCCESSFULLY
				{	
					$session_data = array("ERROR_MSG"  => "Faq Not Updated.");
					$this->session->set_userdata($session_data);				
				}
			}
			else 
			{
				
				$id = $this->custom_m->addDetails();
				if($id) // IF UPDATE PROCEDURE EXECUTE SUCCESSFULLY
				{
					$session_data = array("SUCC_MSG"  => "Faq Inserted Successfully.");
					$this->session->set_userdata($session_data);					
				}			
				else // IF UPDATE PROCEDURE NOT EXECUTE SUCCESSFULLY
				{	
					$session_data = array("ERROR_MSG"  => "Faq Not Inserted.");
					$this->session->set_userdata($session_data);				
				}
				
			}
			redirect("kaizen/faq/doedit/".$id,'refresh');			
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
	public function doedit()
	{
		$data = array();
		$data['details'] = new stdClass();
		$faq_id=$this->uri->segment(4);
		$q = $this->custom_m->editDetail($faq_id);		
		//print_r($q);exit;
		if($q){
			$data['details'] = $q;
		}
		else{
			$data['details']->is_active = 1;
			$data['details']->id = 0;
		}
		
		$data_row = $this->custom_m->getAllDetails("faq");
		$data['records']= $data_row;
		
		$total_row = $this->custom_m->getCountAll("faq");
		$data['total_records']= $total_row;
		
		$this->load->view('edit_faq',$data);		
		
	}
	public function dodelete(){		
		$del_id=$this->input->get('deleteid');
		#$ref=rawurldecode($this->input->get('ref'));
		$tablename="faq";
		$idname='id';
			
		$delrec=$this->custom_m->delSingleRecord($del_id,$tablename,$idname);
		if($delrec===true){
			$session_data = array("SUCC_MSG"  => "Deleted Successfully");
			$this->session->set_userdata($session_data);
		}
		else{
			$session_data = array("ERROR_MSG"  => "Some problem occureed, please try again.");
			$this->session->set_userdata($session_data);
		}
		//redirect('faq','refresh');
		$this->load->view('faq');
	}
	
	public function do_changestatus() // CHANGE STATUS
	{
  
 		$admin_id=$this->uri->segment(5);
 		$where = array('id' => $admin_id );
		$data=array(		
		'is_active'=>$this->uri->segment(4)
		);
 		$this->custom_m->performaction('Update','faq',$data,$where);
		$session_data = array("SUCC_MSG"  => "Status changed successfully.");
		$this->session->set_userdata($session_data);
    /*$this->custom_m->dolist_common('faqcategories','faq_categories_list');
		
	    $status_id=$this->uri->segment(3, 0); // STATUS CHANGE RECORD ID
		
						
		if((int)$status_id > 0 && $this->custom_m->getSingleRecord($status_id))
		{ 
			if($this->custom_m->changeStatus($status_id))
			{				
				
				$session_data = array("SUCC_MSG"  => "Status Changed Successfully.");
				$this->session->set_userdata($session_data);
			}
			else
			{
				$session_data = array("ERROR_MSG"  => "Status Not Changed Successfully.");
				$this->session->set_userdata($session_data);
			}
		}	
		else
		{
			$session_data = array("ERROR_MSG"  => "Status Not Changed Successfully.");
			$this->session->set_userdata($session_data);
		}*/
		redirect("kaizen/faq",'refresh');
		
		
	}	
	
	public function dodeleteimg() // CHANGE STATUS
	{
		//print_r($this->input->get('deleteid'));exit;
	    $id=$this->input->get('deleteid');
		
						
		if((int)$id > 0 && $this->custom_m->getSingleRecord($id))
		{ 
			if($this->custom_m->deleteImg($id))
			{				
				
				$session_data = array("SUCC_MSG"  => "Image deleted Successfully.");
				$this->session->set_userdata($session_data);
			}
			else
			{
				$session_data = array("ERROR_MSG"  => "Image Not deleted Successfully.");
				$this->session->set_userdata($session_data);
			}
		}	
		else
		{
			$session_data = array("ERROR_MSG"  => "Image Not deleted Successfully.");
			$this->session->set_userdata($session_data);
		}
		$data = array();
		$cms_id=$this->uri->segment(4);
		$total_row = $this->custom_m->getCountAll("faq");
		$data['total_records']= $total_row;
		$data['details'] = $this->custom_m->editDetail($id);
		
		$this->load->view('edit_faq',$data);		
		
		
	}	
		//=============== START IMAGE MANUPULATION==============// 
	
	function uploadImage($field='') 
    {		
		$upload_dir='faq_photo/';
		$field_name=$field;
		
		if(!is_dir(file_upload_absolute_path().$upload_dir)){
			$oldumask = umask(0); 
			mkdir(file_upload_absolute_path().$upload_dir, 0777); // or even 01777 so you get the sticky bit set 
			umask($oldumask);
		}
		
     	$config['upload_path'] = file_upload_absolute_path().$upload_dir;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '5000';
        $config['max_width'] = '2500';
        $config['max_height'] = '2500'; 


        
        $this->load->library('upload', $config); // LOAD FILE UPLOAD LIBRARY
        
        if($this->upload->do_upload($field_name)) // CREATE ORIGINAL IMAGE
		{						
			$fInfo = $this->upload->data();					
			$data['uploadInfo'] = $fInfo;
			
			
			return $fInfo['file_name']; // RETURN ORIGINAL IMAGE NAME
		}
        else // IF ORIGINAL IMAGE NOT UPLOADED
        {			
			return false; // RETURN ORIGINAL IMAGE NAME              
        }
    }
	function resizingImage($fileName='',$upload_rootdir='',$img_width='',$img_height='',$img_prefix = '') 
    {		
		if(!is_dir(file_upload_absolute_path().$upload_rootdir)){
			$oldumask = umask(0); 
			mkdir(file_upload_absolute_path().$upload_rootdir, 0777); // or even 01777 so you get the sticky bit set 
			umask($oldumask);
		}
		
        $config['image_library'] = 'gd2';		
     	$config['source_image'] = file_upload_absolute_path().$upload_rootdir.$fileName; 
		$config['new_image']	= file_upload_absolute_path().$upload_rootdir.$img_prefix.$fileName;
		#$config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $img_width;
        $config['height'] = $img_height;
		$this->load->library('image_lib', $config);
       	$this->image_lib->initialize($config); 
      	if(!$this->image_lib->resize()){
            echo $this->image_lib->display_errors();			
        }
		else{
			return false;
		}
	}
  /* FAQ Cateogries start*/
  
	public function list_categories(){
		$this->custom_m->dolist_common('faqcategories','faq_categories_list');
   }
 	public function edit_category(){
 		$admin_id=$this->uri->segment(4);
 		$where = array('id' => $admin_id );

 		$this->custom_m->doedit_common('faqcategories','edit_faqs_category',$where);	
 	} 

  public function add_category(){
	  $data = array();
    $data['details']=new stdClass();
	  $this->load->view('edit_faqs_category',$data);		
  }
	public function addedit_category($id='')	{
		$update_where = '';
		$id=$this->input->post('id','');
    
		$data=array(		
		'faqcategories_title'=>xss_clean($this->input->post('faqcategories_title')),
		'display_order'=>xss_clean($this->input->post('display_order')),
		'is_active'=>xss_clean($this->input->post('is_active'))
		);
		
		if(empty($id)){
		  $id=$this->custom_m->performaction('Insert','faqcategories',$data,$update_where);
			if($id){
				$session_data = array("SUCC_MSG"  => "FAQ category inserted successfully.");
				$this->session->set_userdata($session_data);
			}
			else{
				$session_data = array("ERROR_MSG"  => "FAQ category not inserted.");
				$this->session->set_userdata($session_data);
			}
		}
		else{      
			$update_where=array('id'=>$id);
			$this->custom_m->performaction('Update','faqcategories',$data,$update_where);
			if($id){
				$session_data = array("SUCC_MSG"  => "FAQ category updated successfully.");
				$this->session->set_userdata($session_data);
			}
			else{
				$session_data = array("ERROR_MSG"  => "FAQ category not updated.");
				$this->session->set_userdata($session_data);
			}
		}
		redirect("kaizen/faq/edit_category/".$id,'refresh');
	} 
 	public function category_changestatus(){
 		$admin_id=$this->uri->segment(5);
 		$where = array('id' => $admin_id );
		$data=array(		
		'is_active'=>$this->uri->segment(4)
		);
 		$this->custom_m->performaction('Update','faqcategories',$data,$where);
		$session_data = array("SUCC_MSG"  => "Status changed successfully.");
		$this->session->set_userdata($session_data);
    $this->custom_m->dolist_common('faqcategories','faq_categories_list');
 	}   
  
  /* FAQ Cateogries End*/ 
	//=============== END IMAGE MANUPULATION==============//
}