<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		
		if( ! $this->session->userdata('web_admin_logged_in')) {redirect('kaizen/welcome','refresh');
		}
		$this->load->vars( array(
		  'global' => 'Available to all views',
		  'header' => 'kaizen/common/header',
		  'left' => 'kaizen/common/left',
		  'footer' => 'kaizen/common/footer',
		   'copyright' => 'kaizen/common/copyright'
		));
	}

	function index()
	{
		if($this->session->userdata('web_admin_logged_in'))
		{
			if(!$this->session->userdata('SITE_ID'))
			{
			$this->session->set_userdata(array('SITE_ID'=>'1'));
			}
			$this->load->view('kaizen/dashboard_view');
		}
		else
		{
			redirect('kaizen/welcome','refresh');
		}
	}
	function ajax_site()
	{
		if($this->session->userdata('web_admin_logged_in'))
		{

			$site	=	$this->input->post('site',TRUE);
			if(!empty($site))
			{
				$this->session->set_userdata(array('SITE_ID'=>$site));
			}
			else
			{
				$this->session->set_userdata(array('SITE_ID'=>'1'));			
			}
			
		echo $this->session->userdata('SITE_ID');
		}
		else
		{
			redirect('kaizen/welcome','refresh');
		}
	}
	
	
}