<?php
class Model_common extends MY_Model {
	public function __construct()
    {
        parent::__construct();
        $this->site_id=$this->session->userdata('SITE_ID');	
    }
}
?>