<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Admin extends CI_Controller {
	private $limit = 50;
	var $offset = 0;
	function __construct()
	{
		parent::__construct();		 
		
		if( ! $this->session->userdata('web_admin_logged_in')) {
			redirect('kaizen/welcome','refresh');
		}
		$this->load->vars( array(
		  'global' => 'Available to all views',
		  'header' => 'kaizen/common/header',
		  'left' => 'kaizen/common/admin_left',
		  'footer' => 'kaizen/common/footer'
		));
		$this->load->library('pagination');
		$this->load->model('kaizen/modeladmin');
	}

	public function index(){	
		$data['details'] = $this->modeladmin->getAllDetails();
		$this->load->view('kaizen/admin_list',$data);		
	}
	
	public function deleteadmin(){
		$id=$this->uri->segment(4);
		$data['details'] = $this->modeladmin-> delRecord($id);
		$this->session->set_flashdata('message','Successfull deleted');
		redirect("kaizen/admin",'refresh');
	}
	
	public function addadmin(){
	    
		$data['details']='';
		$data['center_list_arr']=$this->modeladmin->get_center_list('industrial_career_center');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[si_admin.user_name]|xss_clean');
		$this->form_validation->set_rules('user_email', 'user Email ', 'trim|required|valid_email|is_unique[si_admin.user_email]|xss_clean');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('conf_pwd', 'Confirm Password', 'trim|required|matches[pwd]|xss_clean');
		$this->form_validation->set_rules('user_level', 'User level', 'trim|required|xss_clean');
		$this->form_validation->set_rules('center_id', 'Center', 'trim|required|xss_clean');
		$this->form_validation->set_rules('approved', 'Approved', 'trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="validation_msg">', '</span>');
		if($this->form_validation->run() == TRUE){	
			$id = $this->modeladmin->addDetails();
			if($id>0)
			$this->session->set_flashdata('message','Successfull inserted');
			else
			$this->session->set_flashdata('message','Try again');
			
			redirect("kaizen/admin/addadmin",'refresh');
		}
		
		$this->load->view('kaizen/edit_admin',$data);		
	}
	public function editadmin(){
		$this->load->library('form_validation');
		$id=$this->uri->segment(4);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|xss_clean');
		
		if($this->input->post('user_name2') ==$this->input->post('user_name')){
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|xss_clean');
		}
		else {
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[si_admin.user_name]|xss_clean');
		}
		if($this->input->post('user_email2') ==$this->input->post('user_email')){
		$this->form_validation->set_rules('user_email', 'user Email ', 'trim|required|valid_email|xss_clean');
		}
		else {
		$this->form_validation->set_rules('user_email', 'user Email ', 'trim|required|valid_email|is_unique[si_admin.user_email]|xss_clean');
		}
		
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('conf_pwd', 'Confirm Password', 'trim|required|matches[pwd]|xss_clean');
		$this->form_validation->set_rules('user_level', 'User level', 'trim|required|xss_clean');
		$this->form_validation->set_rules('center_id', 'Center', 'trim|required|xss_clean');
		$this->form_validation->set_rules('approved', 'Approved', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="validation_msg">', '</span>');
		if($this->form_validation->run() == TRUE){	
			$this->modeladmin->updateDetais();
			$this->session->set_flashdata('message','Successfull updated');
			redirect("kaizen/admin/editadmin".'/'.$id,'refresh');
		}
		$id=$this->uri->segment(4);
		$data['details']=$this->modeladmin->getSingleRecord($id);
		$data['center_list_arr']=$this->modeladmin->get_center_list('industrial_career_center');
		$this->load->view('kaizen/edit_admin',$data);		
	  }
	

		
}	