<?php
class Model_theme_rooms extends CI_Model{
	
	var $site_id='';
	public function __construct(){
		parent::__construct();	
		$this->site_id=$this->config->item("SITE_ID");	
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
	
	public function getThemerooms(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('theme_rooms')."` order by display_order asc "))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
public function getThemebanner(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('cms_pages')."` where page_link = 'theme_rooms'"))
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