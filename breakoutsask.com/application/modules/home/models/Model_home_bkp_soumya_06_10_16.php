<?php
class Model_home extends CI_Model{
	
	var $site_id='';
	public function __construct(){
		parent::__construct();	
		$this->site_id=$this->config->item("SITE_ID");	
	}
	
	public function gethomebanner(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('homepage_slider')."` WHERE `slider_status`='Active' order by sequence > 0 desc,sequence asc  "))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	public function getsectionbackground($section){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('homepage_block_setting')."` WHERE `block_status`='Active' and block_section_no= '".$section."'"))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	public function getFeaturedblocks($section_type){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('featured_blocks')."` WHERE block_section_type = '".$section_type."' and is_featured = '1' and featured_block_status = 'Active' LIMIT 3"))
		{
			#echo $this->db->last_query();
			
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	public function getRecentblogs($limit){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('news_post')."` order by create_dt desc LIMIT ".$limit))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	public function getContact(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('contact')."` where is_default = 1 LIMIT 1"))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
        
	
}
?>