<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_category extends CI_Controller 
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
		  'cms_header' => 'common/cms_header',
		  'left' => 'common/left',
		  'footer' => 'common/footer',
		  'copyright' => 'common/copyright'
		  
		  
			
		));
		$this->load->library('pagination');
		$this->load->model('modelnews_category');
		$this->load->library('image_lib'); // LOAD IMAGE THUMB LIBRARY	
	}

	public function index()
	{		
		
		$this->dolist();	
	}
	
	public function dolist(){
		$data = array();
		
		$data_row = $this->modelnews_category->getAllDetails("news_category",$this->limit,$this->offset,'','','');	
		$data['records']= $data_row;
		$this->load->view('news_category_list',$data);	
	}
	public function dosearch(){
		//$this->load->helper('security');
		$offsets = (($this->uri->segment(4)) ? $this->uri->segment(4) : 1);
		if($offsets>1){$this->offset = (($offsets - 1)*$this->limit);}else{$this->offset = ($offsets - 1);}
		$searchstring = xss_clean(rawurldecode($this->uri->segment(3)));
		$this->dolist($searchstring);	
	}
	public function doadd(){
		$data = array();
		$data['details']= new stdClass;
		$news_category_id=$this->uri->segment(4);
		$data['details']->is_active = 1;
		$data['details']->id = $news_category_id;
		
		$data_row = $this->modelnews_category->getAllDetails("news_category");
		$data['records']= $data_row;
		$data['news_category'] = $this->modelnews_category->getAllChildDetails("news_category");
		
		$this->load->view('edit_news_category',$data);		
	}
	public function addedit()
	{ 
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('news_category_title', 'Title', 'trim|required|xss_clean');
		
		
		$this->form_validation->set_error_delimiters('<span class="validation_msg">', '</span>');
		$id=$this->input->post('news_category_id','');
		
		if($this->form_validation->run() == TRUE) // IF MENDATORY FIELDS VALIDATION TRUE(SERVER SIDE)  
		{	
			if(!empty($id) && $this->modelnews_category->getSingleRecord($id)) 
			{		
				if($this->modelnews_category->updateDetais($id)) // IF UPDATE PROCEDURE EXECUTE SUCCESSFULLY
				{
					$session_data = array("SUCC_MSG"  => "News Category Updated Successfully.");
					$this->session->set_userdata($session_data);					
				}			
				else // IF UPDATE PROCEDURE NOT EXECUTE SUCCESSFULLY
				{	
					$session_data = array("ERROR_MSG"  => "News Category Not Updated.");
					$this->session->set_userdata($session_data);				
				}
			}
			else 
			{
				$id = $this->modelnews_category->addDetails();
				if($id) // IF UPDATE PROCEDURE EXECUTE SUCCESSFULLY
				{
					$session_data = array("SUCC_MSG"  => "News Category Inserted Successfully.");
					$this->session->set_userdata($session_data);					
				}			
				else // IF UPDATE PROCEDURE NOT EXECUTE SUCCESSFULLY
				{	
					$session_data = array("ERROR_MSG"  => "News Category Not Inserted.");
					$this->session->set_userdata($session_data);				
				}
				
			}
			redirect("kaizen/news_category/doedit/".$id,'refresh');			
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
		$data['details']= new stdClass;
		$news_category_id=$this->uri->segment(4);
		$q = $this->modelnews_category->editDetail($news_category_id);		
		
		if($q){
			$data['details'] = $q;
		}
		else{
			$data['details']->is_active = 1;
			$data['details']->id = 0;
		}
		$data['news_category'] = $this->modelnews_category->getAllChildDetails("news_category");
		
		$data_row = $this->modelnews_category->getAllDetails("news_category");
		$data['records']= $data_row;
		
		$this->load->view('edit_news_category',$data);		
		
	}
	public function dodelete(){		
		$del_id=$this->input->get('deleteid');
		#$ref=rawurldecode($this->input->get('ref'));
		$tablename="news_category";
		$idname='id';
			
		$delrec=$this->modelnews_category->delSingleRecord($del_id,$tablename,$idname);
		if($delrec===true){
			$session_data = array("SUCC_MSG"  => "Deleted Successfully");
			$this->session->set_userdata($session_data);
		}
		else{
			$session_data = array("ERROR_MSG"  => "Some problem occureed, please try again.");
			$this->session->set_userdata($session_data);
		}
		redirect("kaizen/news_category",'refresh');
	}
	
	public function do_changestatus() // CHANGE STATUS
	{
		
	    $status_id=$this->uri->segment(4, 0); // STATUS CHANGE RECORD ID
		
						
		if((int)$status_id > 0 && $this->modelnews_category->getSingleRecord($status_id))
		{ 
			if($this->modelnews_category->changeStatus($status_id))
			{				
				
				$session_data = array("SUCC_MSG"  => "Status Changed Successfully.");
				#$this->session->set_userdata($session_data);
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
		}
		redirect("kaizen/news_category",'refresh');
		
	}	
	    
   
}