<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Menu_class{
 	var $page_link = "";
	var $services_arr = "";
	public function __construct(){		
		$CI =& get_instance();
		$this->page_link = $CI->uri->segment(1);
		if(empty($this->page_link))
		{
			$this->page_link="home";
		}
		elseif($this->page_link=="pages"){
			$this->page_link = $CI->uri->segment(2);
		}
		elseif($this->page_link=="draft" || $this->page_link=="draft_home"){
			$this->page_link = "home";
		}
	}
	public function get_menu(){
		$CI =& get_instance();
		$CI->load->model('home/model_meta');
		$tot_banner = $CI->model_meta->count_cmspages();
		if($tot_banner){
			$cmspages_list = $CI->model_meta->get_list();
			$data=array();
			//echo '<pre>';
			//print_r($cmspages_list);
			$TOP_NAV_MENU = '';
			$cms_menu = $this->generate_menu(0,$cmspages_list, $TOP_NAV_MENU, 0);		
			$CI->data['hooks_cmspages_list'] = $cms_menu;
			//echo '<pre>';
			//print_r($cms_menu);
			
			$TOP_NAV_MENU2 = '';
			$cms_menu2 = $this->generate_menuf(0,$cmspages_list, $TOP_NAV_MENU2, 0);		
			$CI->data['hooks_footerpages_list'] = $cms_menu2;
			
		}	
	}
	public function generate_menu($parent,$menus_array, &$TOP_NAV_MENU, $level_depth=0){
		$has_childs = false;
		$level_depth++;
	
		foreach($menus_array as $key => $value){
	    	if ($value['parent_id'] == $parent){       
    	    	if ($has_childs === false){
                	$has_childs = true;
					if($level_depth==1){$TOP_NAV_MENU .= "<ul class=\"flexnav nav with-js opacity lg-screen\" data-breakpoint=\"900\">\n";}					
					else{$TOP_NAV_MENU .= "<ul>\n";}
            	}
				if($this->page_link==$value['page_link']){$cl="class='active'";$cl2=" active";}else{$cl="";$cl2="";}
					
				if($value['page_link']=="home"){
					$TOP_NAV_MENU .= '<li><a href="'.base_url().'" class="home"></a></li>';
				}				
				else 
				{
					
					if($value['page_link']=="about"){
						$TOP_NAV_MENU .= '<li><a href="'.site_url("about").'" '.$cl.'>' . $value['title'] . '</a>';
					}	
					elseif($value['page_link']=="theme_rooms"){
						$TOP_NAV_MENU .= '<li><a href="'.site_url("theme_rooms").'" '.$cl.'>' . $value['title'] . '</a>';
					}
					elseif($value['page_link']=="blog"){
						$TOP_NAV_MENU .= '<li><a href="'.site_url("blog").'" '.$cl.'>' . $value['title'] . '</a>';
					}
					elseif($value['page_link']=="faq"){
						$TOP_NAV_MENU .= '<li><a href="'.site_url("faq").'" '.$cl.'>' . $value['title'] . '</a>';
					}
					elseif($value['page_link']=="contact"){
						$TOP_NAV_MENU .= '<li><a href="'.site_url("contact").'" '.$cl.'>' . $value['title'] . '</a>';
					}						
					else{					
						$TOP_NAV_MENU .= '<li><a href="'.site_url('pages/'.$value['page_link']).'" '.$cl.'>' . $value['title'] . '</a>';
					}
					if($level_depth<2){$this->generate_menu($key,$menus_array,$TOP_NAV_MENU,$level_depth);}
					$TOP_NAV_MENU .= "</li>\n";
				}
			}
    	}
		if($level_depth == 1){$TOP_NAV_MENU .= '<li><a onclick="bookonlinelink();" href="javascript:void(0)" class="book-online">Book Online</a></li>';}
    	if ($has_childs === true){$TOP_NAV_MENU .= "</ul>\n";}
	
		return $TOP_NAV_MENU;
	}
	
	
	public function generate_menuf($parent,$menus_array, &$TOP_NAV_MENU, $level_depth=0){
		$has_childs = false;
		$level_depth++;
		
		foreach($menus_array as $key => $value){
	    	if ($value['parent_id'] == $parent){       
    	    	if ($has_childs === false){
                	$has_childs = true;
					//if($level_depth==1){$TOP_NAV_MENU .= "<ul class=\"footer-nav\">\n";}					
					//else{$TOP_NAV_MENU .= "<ul>\n";}
            	}
				if($this->page_link==$value['page_link']){$cl="class='active'";}else{$cl="";}
					
				if($value['page_link']=="home"){
					$TOP_NAV_MENU .= '<li><a href="'.base_url().'" '.$cl.'>' . $value['title'] . '</a>';
				}	
				elseif($value['page_link']=="about"){
						$TOP_NAV_MENU .= '<li><a href="'.site_url("about").'" '.$cl.'>' . $value['title'] . '</a>';
					}	
					elseif($value['page_link']=="theme_rooms"){
						$TOP_NAV_MENU .= '<li><a href="'.site_url("theme_rooms").'" '.$cl.'>' . $value['title'] . '</a>';
					}
					elseif($value['page_link']=="blog"){
						$TOP_NAV_MENU .= '<li><a href="'.site_url("blog").'" '.$cl.'>' . $value['title'] . '</a>';
					}
					elseif($value['page_link']=="faq"){
						$TOP_NAV_MENU .= '<li><a href="'.site_url("faq").'" '.$cl.'>' . $value['title'] . '</a>';
					}
					elseif($value['page_link']=="contact"){
						$TOP_NAV_MENU .= '<li><a href="'.site_url("contact").'" '.$cl.'>' . $value['title'] . '</a>';
					}		
				else{					
					$TOP_NAV_MENU .= '<li><a href="'.site_url('pages/'.$value['page_link']).'" '.$cl.'>' . $value['title'] . '</a>';					
					#if($level_depth<2){$this->generate_menuf($key,$menus_array,$TOP_NAV_MENU,$level_depth);}
            		$TOP_NAV_MENU .= "</li>\n";					
				}		
							
			}
    	}
    	//if ($has_childs === true){$TOP_NAV_MENU .= "</ul>\n";}
	
		return $TOP_NAV_MENU;
	}
	

}