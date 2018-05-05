<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Breakoutsask404 extends CI_Controller {
	var $data = array();
	public function __construct() {
	   parent::__construct();
	   // Set master content and sub-views
	   $this->load->vars( array(
		 'header' => 'common/header',
		  'footer' => 'common/footer'
		));
		$this->load->model('home/model_home');
		$this->load->model('home/model_meta');
			
	}

	public function index()	{
			//echo '<pre>';print_r($this->data);
			//echo "gdgdgdg"; die();
			$meta_list = $this->model_meta->meta_list();
			$data=array();
			$this->data['hooks_meta'] = $meta_list;	
			$site_setting = $this->model_meta->site_settings();
			$this->data['site_settings']=$site_setting;
			$social_links = $this->model_meta->getsocial();
			$this->data['social_links']=$social_links;
			$default_contact = $this->model_meta->getdefaultcontact();
			$this->data['default_contact']=$default_contact;
			$commonbanner = $this->model_meta->commonbanner($meta_list->id);
			$this->data['commonbanner']=$commonbanner;
			$contact = $this->model_meta->getcontact();
			$this->data['contact'] = $contact;
            $this->load->view('breakoutsask404/breakoutsask404',$this->data);
       
	}
		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */