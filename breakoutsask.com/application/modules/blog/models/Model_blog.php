<?php
class Model_blog extends CI_Model{
	
	var $site_id='';
	public function __construct(){
		parent::__construct();	
		$this->site_id=$this->config->item("SITE_ID");	
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
	

	public function getBlogs(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('news_post')."` order by create_dt desc"))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	public function getBlogs_cat($catid=''){
		
		$qu = "SELECT * FROM `".$this->db->dbprefix('news_post_cat')."` as pc INNER JOIN `".$this->db->dbprefix('news_post')."` as np ON np.id = pc.post_id ";
		
		if($catid != ''){$qu .= " where pc.cat_id = '".$catid."' ";}
		
		$qu.= " order by np.create_dt desc";
		
		if($query = $this->db->query($qu))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	public function getBlog_category(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('news_category')."` "))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	public function getSingle_blog($blogid){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('news_post')."` where id = '".$blogid."'"))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
			
	public function getBlogbanner(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('cms_pages')."` where page_link = 'blog'"))
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