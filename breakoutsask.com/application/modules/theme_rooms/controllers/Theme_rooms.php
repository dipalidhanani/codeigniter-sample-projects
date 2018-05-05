<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Theme_rooms extends CI_Controller {
	var $data = array();
	public function __construct() {
	   parent::__construct();
	   // Set master content and sub-views
	   $this->load->vars( array(		  
		  'header' => 'common/header',
		  'footer' => 'common/footer'
		));
		
		$this->load->model('model_theme_rooms');
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
		
                //$this->data['banner'] = $this->model_theme_rooms->gethomebanner();
		
		
		//$data['homepageslider_arr'] = $this->model_theme_rooms->gethomebanner();
		
		//$data['theme_rooms_background'] = $this->model_theme_rooms->getsectionbackground('1');
		//$data['calltoaction_background'] = $this->model_theme_rooms->getsectionbackground('2');
		//$data['recentblogs_background'] = $this->model_theme_rooms->getsectionbackground('3');
		//$data['contact_background'] = $this->model_theme_rooms->getsectionbackground('4');
		
		
		
		
		$this->data['recent_blogs_arr'] = $this->model_theme_rooms->getRecentblogs('3');
		
		$this->data['theme_rooms_arr'] = $this->model_theme_rooms->getThemerooms();
		
		$this->data['themebanner_arr'] = $this->model_theme_rooms->getThemebanner();
		
		//$data['contact_arr'] = $this->model_theme_rooms->getContact();
		
		$this->load->view('theme_rooms',$this->data);
		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */