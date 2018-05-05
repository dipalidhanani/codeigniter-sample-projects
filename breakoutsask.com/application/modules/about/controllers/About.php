<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {
	var $data = array();
	public function __construct() {
	   parent::__construct();
	   // Set master content and sub-views
	   $this->load->vars( array(		  
		  'header' => 'common/header',
		  'footer' => 'common/footer'
		));
		
		$this->load->model('model_about');
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
		
                //$this->data['banner'] = $this->model_about->gethomebanner();
		
		
		//$data['homepageslider_arr'] = $this->model_about->gethomebanner();
		
		$this->data['about_background'] = $this->model_about->getsectionbackground('1');
		//$data['calltoaction_background'] = $this->model_about->getsectionbackground('2');
		//$data['recentblogs_background'] = $this->model_about->getsectionbackground('3');
		//$data['contact_background'] = $this->model_about->getsectionbackground('4');
		
		
		$this->data['about_featuredblocks_arr'] = $this->model_about->getFeaturedblocks('About');
		
		$this->data['calltoaction_featuredblocks_arr'] = $this->model_about->getFeaturedblocks('Calltoaction');
		
		$this->data['recent_blogs_arr'] = $this->model_about->getRecentblogs('3');
		
		$this->data['aboutbanner_arr'] = $this->model_about->getAboutbanner();
		
		//$data['contact_arr'] = $this->model_about->getContact();
		
		$this->load->view('about',$this->data);
		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */