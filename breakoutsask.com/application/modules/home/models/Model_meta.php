<?php
class Model_meta extends CI_Model{
	var $page_link = "";
	var $site_id='';
	var $membership_id;
	public function __construct(){
		parent::__construct();
		$this->site_id=$this->config->item("SITE_ID");
		$this->membership_id=$this->session->userdata('membership_id');		
			$this->page_link = xss_clean($this->uri->segment(1));
			$page_arr = array('news');
			if(empty($this->page_link)){
				$this->page_link = "home";
			}
			elseif(in_array($this->page_link,$page_arr)){
				$this->page_link = xss_clean($this->uri->segment(1));
			}
			elseif($this->page_link=="pages"){
				$this->page_link = xss_clean($this->uri->segment(2));
			}
			
			elseif($this->page_link=="draft" || $this->page_link=="draft_home"){
				$this->page_link = "home";
			}
			
	}
	
	public function count_meta(){
		
		$query = $this->db->query("SELECT `id` FROM `".$this->db->dbprefix('cms_pages')."` WHERE page_link='".$this->page_link."' and `site_id`='".$this->site_id."' LIMIT 0,1");
		if($query->num_rows()>0){
			return true;
		}
		else{
			$query = $this->db->query("SELECT `id` FROM `".$this->db->dbprefix('other_cms_pages')."` WHERE page_link='".$this->page_link."' and `site_id`='".$this->site_id."' LIMIT 0,1");
			if($query->num_rows()>0){
				return true;
			}
			else{		
				return false;
			}
		}
	}
	public function gettablecontact($id){
		
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('common_banner')."` WHERE `is_active`='1' AND `site_id`='".$this->site_id."'  AND `page_id` like '%".$id.",%' LIMIT 0,1"))
		{
			//echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	public function meta_list(){
		$query = $this->db->query("SELECT *,'1' as page_type FROM `".$this->db->dbprefix('cms_pages')."`WHERE page_link='".$this->page_link."' and `site_id`='".$this->site_id."' LIMIT 0,1");
		if($query->num_rows()>0){
			return $query->row();	
		}
		else{
			$query = $this->db->query("SELECT *,'2' as page_type FROM `".$this->db->dbprefix('other_cms_pages')."` WHERE page_link='".$this->page_link."' and `site_id`='".$this->site_id."' LIMIT 0,1");
			if($query->num_rows()>0){
				
				return $query->row();
			}
			else{		
				return false;
			}
		}
	}
	public function site_settings(){
		$query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('site_settings')."`WHERE `id`=1 ");
		if($query){
			return $query->row();	
		}
		else{
			return false;
		}
	}
	public function commonbanner($page_id){
		$query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('commonbanner')."`WHERE `page_id` like '%".$page_id."%' ");
		if($query){
			return $query->row();	
		}
		else{
			return false;
		}
	}
	 
	public function count_cmspages(){
		$query = $this->db->query("SELECT `id` FROM `".$this->db->dbprefix('cms_pages')."` WHERE  `site_id`='".$this->site_id."' LIMIT 0,10");
		#echo $this->db->last_query();exit;
		if($query->num_rows()>0){
			return true;
		}
		else{		
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}
	}
	
	public function cmspages_list($conds=""){		
		$query = $this->db->query("SELECT `id`,`title`,`parent_id`,`page_link` FROM `".$this->db->dbprefix('cms_pages')."` WHERE `is_active`=1  and `site_id`='".$this->site_id."' ".$conds." order by `display_order`>0 desc, `display_order` asc");
		if($query){
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	public function getcontact(){		
		$query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('contact')."` WHERE `is_active`=1  ");
		if($query){
			return $query->row();	
		}
		else{
			return false;
		}
	}
	
	public function getprogramcategory(){		
		$query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('group_programs_category')."` WHERE `is_active`=1   order by `display_order`>0 desc, `title` asc");
		if($query){
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	
	public function cmspages_top_header(){		
		$query = $this->db->query("SELECT `id`,`title`,`parent_id`,`page_link` FROM `".$this->db->dbprefix('cms_pages')."` WHERE `is_active`=1 and `top_header` = 1  and `site_id`='".$this->site_id."'  order by `display_order`>0 desc, `display_order` asc");
		if($query){
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	public function get_list() {
    	$cmsmenu = $this->cmspages_list();
		$menus_array = array();
		foreach ($cmsmenu as $rs_menu_id){
		  $menus_array[$rs_menu_id->id] = array('id' => $rs_menu_id->id,'title' => $rs_menu_id->title,'parent_id' => $rs_menu_id->parent_id,'page_link' => $rs_menu_id->page_link);	
                  if($rs_menu_id->page_link == 'locations'){
                      $locations = $this->getlocations();
                      $lcount = 1000;
                      foreach($locations as $location){
                          $menus_array[$lcount] = array('id' => $location->id+100,'title' => $location->title,'parent_id' => $rs_menu_id->id,'page_link' => $location->page_link);	
                          $lcount++;
                      }
                  }
				  if($rs_menu_id->page_link == 'churchlife'){
                      $programcategory = $this->getprogramcategory();
                      $pcount = 10000;
                      foreach($programcategory as $program){
                          $menus_array[$pcount] = array('id' => $program->id+1000,'title' => $program->title,'parent_id' => $rs_menu_id->id,'page_link' => $program->page_link);	
                          $pcount++;
                      }
                  }
		}		
		return $menus_array;
	}
	
public function getsocial(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('social_settings')."` where site_id = '".$this->site_id."'"))
		{
			
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	public function getdefaultcontact(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('contact')."` where is_default = 1 LIMIT 1"))
		{
			
			return $query->result();	
		}
		else{
			return false;
		}
	}
		
}


?>