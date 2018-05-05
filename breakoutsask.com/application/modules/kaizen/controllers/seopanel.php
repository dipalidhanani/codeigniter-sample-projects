<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seopanel extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();		 
		
		
	}

	
	
	public function doadd(){
		$data = array();
		$this->load->view('kaizen/seopanel',$data);		
	}
	
	//=============== END IMAGE MANUPULATION==============//
}