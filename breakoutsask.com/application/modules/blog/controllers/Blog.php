<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {
	var $data = array();
	public function __construct() {
	   parent::__construct();
	   // Set master content and sub-views
	   $this->load->vars( array(		  
		  'header' => 'common/header',
		  'footer' => 'common/footer'
		));
		
		$this->load->model('model_blog');
		
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
		
                //$this->data['banner'] = $this->model_blog->gethomebanner();
		
		
		//$data['homepageslider_arr'] = $this->model_blog->gethomebanner();
		
		//$data['about_background'] = $this->model_blog->getsectionbackground('1');
		//$data['calltoaction_background'] = $this->model_blog->getsectionbackground('2');
		$this->data['recentblogs_background'] = $this->model_blog->getsectionbackground('3');
		//$data['contact_background'] = $this->model_blog->getsectionbackground('4');
		
		
		//$data['about_featuredblocks_arr'] = $this->model_blog->getFeaturedblocks('About');
		
	//	$data['calltoaction_featuredblocks_arr'] = $this->model_blog->getFeaturedblocks('Calltoaction');
		
		$this->data['blogs_arr'] = $this->model_blog->getBlogs();
		
		$this->data['blog_category_arr'] = $this->model_blog->getBlog_category();
		
		$this->data['blogbanner_arr'] = $this->model_blog->getBlogbanner();
		
		//$data['contact_arr'] = $this->model_blog->getContact();
		
		$this->load->view('blog',$this->data);
		
	}
	
	public function category(){
		$catid = $this->uri->segment(3);
		$this->data['blogs_arr'] = $this->model_blog->getBlogs_cat($catid);
		
		$this->data['blog_category_arr'] = $this->model_blog->getBlog_category();
		
		$this->load->view('blog',$this->data);
		}
		
	public function blog_detail(){
		$blogid = $this->uri->segment(3);
		//$data['blogs_arr'] = $this->model_blog->getBlogs_cat($blogid);
		
		$this->data['blog_category_arr'] = $this->model_blog->getBlog_category();
		
		$this->data['single_blog_arr'] = $this->model_blog->getSingle_blog($blogid);
		
		$this->load->view('blog_detail',$this->data);
		}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */