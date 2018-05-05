<?php
class Modelsettings extends MY_Model{

	public function __construct()
    {
        $this->site_id=$this->session->userdata('SITE_ID');	
		parent::__construct();	
		
    }

			
	
}
