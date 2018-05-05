<?php
class Model_pages extends CI_Model{
	
	var $site_id='';
	public function __construct(){
		parent::__construct();	
		$this->site_id=$this->session->userdata('SITE_ID');	
	}
	 public function gettable($table){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix($table)."` WHERE `is_active`='1' and `is_featured`='1' order by display_order > 0 desc,display_order asc  "))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	 public function gettable2($table){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix($table)."` WHERE `is_active`='1' order by display_order > 0 desc,display_order asc  "))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	 public function getFaqList($table,$keyword=''){
		$conds='';
		if(!empty($keyword)){
			$conds= 'AND (title LIKE "%'.$keyword.'%" OR content LIKE "%'.$keyword.'%")';
			
		}
		
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix($table)."` WHERE `is_active`='1' ".$conds." order by display_order > 0 desc,display_order asc  "))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	function save_help_me_form($uplod_img='')
	{	
		$this->title		= $this->input->post('title',TRUE);
		$this->address		= $this->input->post('address',TRUE);
		$this->description		= $this->input->post('description','');	
		
		$add_data = array(
   					'title' 			=> $this->title,
					'site_id' 			=> $this->site_id,
					'address' 			=> $this->address,
					'description' 		=> $this->description,
					'create_dt' 		=> date('Y-m-d H:i:s'),	
					'page_link' 		=> $this->name_replaceCat($this->title),				
   					'help_me_photo' 	=> $uplod_img				
					);

		if($this->db->insert($this->db->dbprefix('help_me'), $add_data))
		{
			$cmsid=$this->db->insert_id();	
			return $cmsid;
		
		}else{
			log_message('error',": ".$this->db->_error_message() );
			
			return false;
		}
	}
	function name_replaceCat($string)
	{    
		$string = strip_tags(outputEscapeString($string));
		$string = preg_replace('/[^A-Za-z0-9\s\s]/', '', $string);
		$cat_replace = str_replace(" ","-",$string);
		$query = $this->db->query("SELECT `id` FROM `".$this->db->dbprefix('help_me')."` WHERE page_link = '".$cat_replace."'");
		$count=$query->num_rows();
		if($query->num_rows()>0){
			$cat_replace=$cat_replace.($count+1);
		}
		return strtolower($cat_replace);
	}
	
	function getlatestblog_post(){
		$conds= " and t1.create_dt<=CURRENT_DATE()";
		$query = $this->db->query("SELECT t1.* FROM `".$this->db->dbprefix('blog_post')."`as t1,`".$this->db->dbprefix('blog_post_cat')."`as t2 WHERE  t1.`is_active`='1' ".$conds." group by t1.id ORDER BY t1.create_dt desc limit 0,2");
		#echo $this->db->last_query();
		if($query)
		{
			return $query->result();	
		}
		else
		{
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}
	
	}	
	public function get_emg_contacts_details($city='')
	{
		$conds='';
		$conds2='';
		if(!empty($city)){
				$conds= " where `city_id`='".$city."'";
		}
		if(!empty($city)){
				$conds2= " and t1.`city_id`='".$city."'";
		}
		
		$query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('emg_contacts_category')."`  WHERE `is_active`=1 and `id` in(SELECT category_id FROM `".$this->db->dbprefix('emg_contacts')."` ".$conds.") group by id ORDER BY display_order > 0 desc,display_order asc,title asc");
		#echo $this->db->last_query();
		if($query){
			$res = $query->result();
			if(!empty($res))
			{
				foreach($res as $list)
				{
	$query2 = $this->db->query("SELECT t1.* FROM `".$this->db->dbprefix('emg_contacts')."` as t1,`".$this->db->dbprefix('city')."` as t2 WHERE t1.`is_active`=1 and t2.`id`=t1.`city_id` and t1.`category_id`= '".$list->id."' ".$conds2." ORDER BY t1.`display_order` > 0 desc,t1.`display_order` asc,t1.`title` asc,t2.`display_order` > 0 desc,t2.`display_order` asc,t2.`title` asc");
					#echo $this->db->last_query();
					if($query2){
						$list->emg_con_list = $query2->result();	
					}
				}
			}
			
			return $res;
			
		}
		else{
			return false;
		}
	}
	
	public function gethomebanner(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('banner')."` WHERE `is_active`='1' order by display_order > 0 desc,display_order asc  "))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	public function gettestimonial(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('testimonial')."` WHERE `is_active`='1' order by display_order > 0 desc,display_order asc  limit 0,1"))
		{
			#echo $this->db->last_query();
			return $query->row();	
		}
		else{
			return false;
		}
	}
	public function gettestimonial_image(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('testimonial_image')."` WHERE `is_active`='1' order by display_order > 0 desc,display_order asc  limit 0,1"))
		{
			#echo $this->db->last_query();
			return $query->row();	
		}
		else{
			return false;
		}
	}
	public function getapp_features_list(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('home_page_featured')."` WHERE `is_active`='1' order by display_order > 0 desc,display_order asc"))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
        public function getsubjectline(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('subject_line')."` WHERE `is_active`='1' order by display_order > 0 desc,display_order asc  "))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
        
	public function get_services_projects_list($category){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('services_projects')."` WHERE `is_active`='1' AND FIND_IN_SET('".$category."', category) order by display_order > 0 desc,display_order asc  "))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	public function get_services_projects_innerpages(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('cms_pages')."` WHERE `is_active`='1' AND `parent_id`='6' order by display_order > 0 desc,display_order asc  "))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	public function getaboutusbanner(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('about_us_banner')."` WHERE `is_active`='1' order by display_order > 0 desc,display_order asc  "))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	public function getaboutuscontent(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('about_us_content')."` WHERE `is_active`='1' order by display_order > 0 desc,display_order asc  "))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	public function get_certificates(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('certificates')."` WHERE `is_active`='1' order by display_order > 0 desc,display_order asc  "))
		{
			#echo $this->db->last_query();
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	public function getcontent($curtable,$url){
		$query = $this->db->query("SELECT `title`,`content` FROM `".$this->db->dbprefix($curtable)."` WHERE  `is_active`='1' AND `site_id`='".$this->site_id."' AND `page_link`='".$url."'");
		#echo $this->db->last_query();
		if($query)
		{
			return $query->row();	
		}
		else{
			return false;
		}
	}	
	
	public function get_parent_pages(){		
		$query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('cms_pages')."` WHERE `is_active`=1  and `site_id`='".$this->site_id."' and parent_id=0 order by `display_order`>0 desc, `display_order` asc");
		if($query){
			return $query->result();	
		}
		else{
			return false;
		}
	}
	public function getparent_page($parentid){		
		$query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('cms_pages')."` WHERE `is_active`=1 and id='".$parentid."'");
		if($query){
			return $query->row();	
		}
		else{
			return false;
		}
	}
	
	public function get_careers_list(){
		$query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('careers')."` WHERE `is_active`=1 ORDER BY display_order > 0 desc,display_order asc limit 0,6");
		if($query)
		{
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	public function get_projects_list(){
		$query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('projects')."` WHERE `is_active`=1 ORDER BY display_order > 0 desc,display_order asc");
		if($query)
		{
			return $query->result();	
		}
		else{
			return false;
		}
	}
	
	public function get_homepg_middle_box(){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('home_pg_middle_box')."` WHERE  `is_active`='1' order by display_order > 0 desc , display_order asc limit 0,4"))
		{
			return $query->result();
		}
		else
		{
			log_message('error',": ".$this->db->_error_message() );
			return false;
		}
	}
	
		public function getparentpages($id,$parent_id){
		
		if(empty($parent_id)){
			if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('cms_pages')."` WHERE `is_active`='1' and `site_id`='".$this->site_id."' and `id`='".$id."'  order by display_order > 0 desc,display_order asc  "))
		{
			#echo $this->db->last_query();
			return $query->result();
			}else{
					return false;
				}
		}else{
			if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('cms_pages')."` WHERE `is_active`='1' and `site_id`='".$this->site_id."' and `id`='".$parent_id."'  order by display_order > 0 desc,display_order asc  "))
		{
			#echo $this->db->last_query();
			return $query->result();
			}else{
					return false;
				}
		}
		
		
	}
	
		public function getsubpages($id,$parent_id){
		if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('cms_pages')."` WHERE `is_active`='1'  and `parent_id`='".$id."'  order by display_order > 0 desc,display_order asc  "))
		{
			
			$res = $query->result();
			if(!empty($res)){
				return $query->result();
			}else if($parent_id != 0){
				if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('cms_pages')."` WHERE `is_active`='1' and  `parent_id`='".$parent_id."' order by display_order > 0 desc,display_order asc  "))
				{
				
					return $query->result();
				}else{
					return false;
				}
			}
		}
		else{
			return false;
		}
	}
}
?>