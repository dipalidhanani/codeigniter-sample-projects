<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {
	var $data = array();
	public function __construct() {
	   parent::__construct();
	   // Set master content and sub-views
	   $this->load->vars( array(		  
		  'header' => 'common/header',
		  'footer' => 'common/footer'
		));
		
		$this->load->model('model_contact');
		$this->load->library('email'); // load the library
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()	{
		
                //$this->data['banner'] = $this->model_contact->gethomebanner();
		
		
		//$data['homepageslider_arr'] = $this->model_contact->gethomebanner();
		
		//$data['about_background'] = $this->model_contact->getsectionbackground('1');
		//$data['calltoaction_background'] = $this->model_contact->getsectionbackground('2');
		//$data['recentblogs_background'] = $this->model_contact->getsectionbackground('3');
		$this->data['contact_background'] = $this->model_contact->getsectionbackground('4');
		
		
		//$data['about_featuredblocks_arr'] = $this->model_contact->getFeaturedblocks('About');
		
	//	$data['calltoaction_featuredblocks_arr'] = $this->model_contact->getFeaturedblocks('Calltoaction');
		
		$this->data['recent_blogs_arr'] = $this->model_contact->getRecentblogs('3');
		
		$this->data['contact_arr'] = $this->model_contact->getContact();
		
		$this->data['contactbanner_arr'] = $this->model_contact->getContactbanner();
		
		$this->load->view('contact',$this->data);
		
	}
	function sendMail()
	{
		$config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'dipali@2webdesign.com', // change it to yours
		  'smtp_pass' => 'dipali@123', // change it to yours
		  'mailtype' => 'html',
		  'validate' => TRUE,
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);
		

        $message = '<!DOCTYPE HTML>
					<html>
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<title></title>
					</head>					
					<body>
					<table align="center" width="600" border="1" cellpadding="4" cellspacing="0">
		<tr>
		<td width="10%"><b>Name:</b></td><td>'.$this->input->post('name').'</td>
		</tr>
		<tr>
		<td><b>Email:</b></td><td>'.$this->input->post('email').'</td>
		</tr>
		<tr>
		<td><b>Phone:</b></td><td>'.$this->input->post('phone').'</td>
		</tr>
		<tr>
		<td><b>Comment:</b></td><td>'.$this->input->post('comment').'</td>
		</tr>
		</table>
					</body>
					</html>';
        $this->load->library('email', $config);
		$this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $this->email->from('dipali@2webdesign.com'); // change it to yours
        $this->email->to($this->input->post('email'));// change it to yours
        $this->email->subject('Contact Information from Breakout Sask');
        $this->email->message($message);
		if($this->email->send())
		{
		  $session_data = array("SUCC_MSG"  => "Email Sent Successfully.");
		  $this->session->set_userdata($session_data);
		 
		}
		 else
		{
			$session_data = array("ERROR_MSG"  => "Email Sent ERROR");
		  	$this->session->set_userdata($session_data);
			
		 //show_error($this->email->print_debugger());
		}
		
		redirect("contact#inner-banner","refresh");

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */