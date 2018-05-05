<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	var $data;
	public function __construct() {
	   parent::__construct();
	   // Set master content and sub-views
	  $this->load->vars( array(		  
		  'header' => 'common/header',
		  'footer' => 'common/footer',
                  //'common_right' => 'common/default/common_right'
		));
		
		$this->load->model('model_pages');
		$this->load->model('common/model_common');
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
		//$url = $this->uri->segment(2);
       // $this->data['parent_page'] =  $this->Model_pages->getparentpages($this->data['hooks_meta']->id,$this->data['hooks_meta']->parent_id);
	
       $this->data['subpages'] = $this->model_pages->getsubpages($this->data['hooks_meta']->id,$this->data['hooks_meta']->parent_id);	
     // if($url == 'privacy-policy'){
		 $this->data['parentpage'] =  $this->model_pages->getparent_page($this->data['hooks_meta']->parent_id);
			// $this->data['page_data'] =  $this->model_pages->getcontent('cms_pages',$url);
			 
			
			
         //  $this->load->view('privacy-policy',$this->data);
		//}else{
			
           $this->load->view('pages',$this->data);
       // }
    }
    
    
        

}