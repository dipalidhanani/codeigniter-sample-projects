<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends CI_Controller {
	
	public function __construct() {
	   parent::__construct();
	   
	}
    public function google_map(){ 
                $this->data['default_lat'] = $this->data['contact']->latitude;
                $this->data['default_lng'] = $this->data['contact']->longitude;
                $this->load->view('common/google_map_dealers_v3',$this->data);
    }
    public function google_map_xml(){
            $this->data['default_lat'] = $this->data['contact']->latitude;
            $this->data['default_lng'] = $this->data['contact']->longitude;
            $this->data['contact_title'] = $this->data['site_settings']->site_name;
            $this->data['marker'] = $this->data['contact']->marker;
            $this->load->view('common/google_map_xml',$this->data);
    }
}