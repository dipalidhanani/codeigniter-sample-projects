<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {
	var $data = array();
	public function __construct() {
	   parent::__construct();
	   // Set master content and sub-views
	   $this->load->vars( array(		  
		  'header' => 'common/header',
		  'footer' => 'common/footer'
		));
		
		$this->load->model('model_faq');
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
		
                //$this->data['banner'] = $this->model_faq->gethomebanner();
		
		
		//$data['homepageslider_arr'] = $this->model_faq->gethomebanner();
		
		$this->data['about_background'] = $this->model_faq->getsectionbackground('1');
		//$data['calltoaction_background'] = $this->model_faq->getsectionbackground('2');
		//$data['recentblogs_background'] = $this->model_faq->getsectionbackground('3');
		//$data['contact_background'] = $this->model_faq->getsectionbackground('4');
		
		
		$this->data['about_featuredblocks_arr'] = $this->model_faq->getFeaturedblocks('About');
		
		$this->data['calltoaction_featuredblocks_arr'] = $this->model_faq->getFeaturedblocks('Calltoaction');
		
		$this->data['recent_blogs_arr'] = $this->model_faq->getRecentblogs('3');
		
		$catid = $this->uri->segment(3);
		
		$this->data['allfaq_categories_arr'] = $this->model_faq->getallFaqs_category();
		
		$this->data['faq_categories_arr'] = $this->model_faq->getFaqs_category($catid);
			$this->data['faqbanner_arr'] = $this->model_faq->getFaqbanner();
		
		//$data['contact_arr'] = $this->model_faq->getContact();
		
		$this->load->view('faq',$this->data);
		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */