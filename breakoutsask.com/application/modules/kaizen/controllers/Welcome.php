<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {	
	
	public function __construct() {
            parent::__construct();
            // Set master content and sub-views
            $this->load->vars( array(
		  'global' => 'Available to all views',
		  'header' => 'kaizen/common/header_login',
		  'footer' => 'kaizen/common/footer_login'
		));
            $this->load->model("model_login");
	}

	public function index(){
		if($this->session->userdata('web_admin_logged_in')==TRUE) {
			redirect('kaizen/main','refresh');
		}
		$data['error'] = "Please login with your credentials";
		
		
		$this->load->view('kaizen/login', $data);
	}
	
	public function authentication(){
		$this->load->helper('security');
		$username = xss_clean($this->input->post('uname'));
		$password = xss_clean($this->input->post('pwd'));
	
		if($username == "" || $password == "")
		{
			
                        $err['uname'] =  'Invalid Username/ Password';
                        echo json_encode($err);
		}
		else
		{
                    
                        $where = array(
                            'user_name' => $username,
                            'pwd' => SHA1($password),
                            'approved' => '1'
                            
                        );
			
                        $result= $this->model_login->select_row('admin',$where);
                                            
			if($result['0']) 
			{		 
					$session_data = array(
					   "web_admin_user_name"  	=> $username, 
					   "web_admin_user_id"  	=> $result['0']->id,
					   "SITE_ID"  	=> $result['0']->id, 
					   "web_admin_logged_in"	=> TRUE
					); 
					
					$this->model_login->update($result['0']->id,$username);
          
					$this->session->set_userdata($session_data);
					//$err =  '';
					//echo json_encode($err);
					redirect("kaizen/main/",'refresh');
			}
			else
			{
				//$this->model_login->update(0,$username);
				$err['uname'] =  'Invalid Username/ Password';
                              //  echo json_encode($err);
								$this->load->view('login',$err);	
			}
		}
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */