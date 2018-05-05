<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot_pwd extends CI_Controller {	
	
	public function __construct() {
            parent::__construct();
            // Set master content and sub-views
            $this->load->vars( array(
		  'global' => 'Available to all views',
		  'header' => 'kaizen/common/header_login',
		  'footer' => 'kaizen/common/footer_login'
		));
            $this->load->model("model_forgot_pwd");
			$this->load->library('email'); // load the library
	}

	public function index(){
		
			if (isset($_GET['info'])) {
               $data['info'] = $_GET['info'];
              }
		if (isset($_GET['error'])) {
              $data['error'] = $_GET['error'];
              }
		$this->load->view('kaizen/forgot_pwd', $data);
	}
	
	
	public function doforget()
	{
		$this->load->helper('url');
		$email= $_POST['email'];
		$q = $this->db->query("select * from ".dbprefix('admin')." where user_email='" . $email . "'");
        if ($q->num_rows > 0) {
            $r = $q->result();
            $user=$r[0];
			$this->resetpassword($user);
			
        }
		else{
		$msg['error'] = "The email id you entered not found on our database ";
		 $this->load->view('kaizen/forgot_pwd',$msg);
		}
		
	} 
	
	public function reset_password(){
	$temp_pass = $this->uri->segment(4);
	$data = array();
	
	$data['temp_pass'] = $temp_pass;
		if($this->model_forgot_pwd->is_temp_pass_valid($temp_pass)){
	
			$this->load->view('kaizen/reset_password',$data);
	
		}else{
			echo "the key is not valid";    
		}

	}
	
	private function resetpassword($user)
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
		
		date_default_timezone_set('GMT');
		$this->load->helper('string');
		$temp_pass= random_string('alnum', 16);
		$this->db->where('id', $user->id);
		$this->db->update(dbprefix('admin'),array('reset_pass'=>$temp_pass));
		$this->load->library('email', $config);
		$this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
		$this->email->from('dipali@2webdesign.com', 'Dipali');
		$this->email->to($user->user_email); 	
		$this->email->subject('Password reset');
		 $message = "<p>This email has been sent as a request to reset our password</p>";
		$message .= "<p><a href='".base_url()."kaizen/forgot_pwd/reset_password/".$temp_pass."'>Click here </a>if you want to reset your password, if not, then ignore</p>";
		$this->email->message($message);	
		if($this->email->send()){
			$msg['success'] = "check your email for instructions, thank you ";			
			}
			else{
				$msg['error'] = "email was not sent, please contact your administrator";				
				}
				
				 $this->load->view('kaizen/login',$msg);
	} 
	
	
	public function temp_reset_password(){
    $data =array(
                'reset_pass' =>$this->input->post('hdn_temp_pwd'),
                'pwd'=>SHA1($this->input->post('password')));
                $tmp_pass = $data['reset_pass'];

    if($data){
        $this->db->where('reset_pass', $tmp_pass);
        $this->db->update(dbprefix('admin'), $data);
		$msg['success'] = "Your Password has been updated successfully.";  
       $this->load->view('kaizen/login',$msg);
    }else{
       $msg['error'] = "Your password has not been updated.";  
       $this->load->view('kaizen/login',$msg);
    }

}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */