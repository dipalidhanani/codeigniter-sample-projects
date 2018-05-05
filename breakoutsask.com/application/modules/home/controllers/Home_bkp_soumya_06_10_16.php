<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	var $data = array();
	public function __construct() {
	   parent::__construct();
	   // Set master content and sub-views
	   $this->load->vars( array(		  
		  'header' => 'common/header',
		  'footer' => 'common/footer'
		));
		
		$this->load->model('model_home');
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
		
                //$this->data['banner'] = $this->model_home->gethomebanner();
		
		
		$this->data['homepageslider_arr'] = $this->model_home->gethomebanner();
		
		$this->data['about_background'] = $this->model_home->getsectionbackground('1');
		$this->data['calltoaction_background'] = $this->model_home->getsectionbackground('2');
		$this->data['recentblogs_background'] = $this->model_home->getsectionbackground('3');
		$this->data['contact_background'] = $this->model_home->getsectionbackground('4');
		
		$this->data['about_featuredblocks_arr'] = $this->model_home->getFeaturedblocks('About');
		
		$this->data['calltoaction_featuredblocks_arr'] = $this->model_home->getFeaturedblocks('Calltoaction');
		
		$this->data['recent_blogs_arr'] = $this->model_home->getRecentblogs('2');
		
		$this->data['contact_arr'] = $this->model_home->getContact();
		
		$this->load->view('home',$this->data);
		
	}
	function sendMail()
	{
			$config['wordwrap'] = TRUE;
					$config['validate'] = TRUE;
					$config['mailtype'] = 'html';
					$this->email->initialize($config);

		

        $message = '<html>
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<title>'.$this->config->item("COMPANY_NAME").'</title>
					</head>					
					<body>
					<table align="center" width="600" border="1" cellpadding="4" cellspacing="0">
					<tr><td><b>Name:</b></td><td>'.stripslashes($this->input->post('name')).'</td></tr>
					<tr><td><b>Email Address:</b></td><td>'.$this->input->post('email').'</td></tr>
					<tr><td><b>Phone:</b></td><td>'.$this->input->post('phone').'</td></tr><tr><td><b>Comments:</b></td><td>'.$this->input->post('comment').'</td></tr>
									
					</table>
					</body>
					</html>';
					$contact_arr = $this->model_home->getContact();
				  $toemail = $contact_arr[0]->email;	
         $this->load->library('email', $config);
		     $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $this->email->from('info@breadkoutsask.com'); // change it to yours
        $this->email->reply_to($this->input->post('email')); // change it to yours
        $this->email->to($toemail);// change it to yours
        //$this->email->bcc('hardik@2webdesign.com');// change it to yours
        $this->email->subject('Contact Information from Breakoutsask');
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
		$redirect = $this->input->post('redirect');
    if(!empty($redirect)){
      redirect("contact#inner-banner","refresh");
    }
    else{
      redirect("home#home-contact","refresh");
    }

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */