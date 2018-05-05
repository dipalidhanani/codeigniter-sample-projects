<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class Metalist
 {
 	
 	public function get_meta()
 	{	
		$CI =& get_instance();
		$CI->load->model('home/model_meta');
		$CI->load->model('home/model_home');
		$tot_meta = $CI->model_meta->count_meta();
		if($tot_meta)
		{			
			$meta_list = $CI->model_meta->meta_list();
			$data=array();
			$CI->data['hooks_meta'] = $meta_list;	
			$site_setting = $CI->model_meta->site_settings();
			$CI->data['site_settings']=$site_setting;
			$social_links = $CI->model_meta->getsocial();
			$CI->data['social_links']=$social_links;
			$default_contact = $CI->model_meta->getdefaultcontact();
			$CI->data['default_contact']=$default_contact;
			$commonbanner = $CI->model_meta->commonbanner($meta_list->id);
			$CI->data['commonbanner']=$commonbanner;
			$contact = $CI->model_meta->getcontact();
			$CI->data['contact'] = $contact;
			
			/*$footer_navigation = $CI->model_meta->footer_navigation();
			$CI->data['footer_navigation']=$footer_navigation;*/
			
		}
		else
		{
                        
			$site_setting = $CI->model_meta->site_settings();
			$data=array();
			$CI->data['hooks_meta'] = $site_setting;
			$meta_list = $site_setting;
                        
                        
			$CI->data['site_settings']=$site_setting;
                        $contact = $CI->model_meta->getcontact();
			$CI->data['contact'] = $contact;
                        
			/*$footer_navigation = $CI->model_meta->footer_navigation();
			$CI->data['footer_navigation']=$footer_navigation;*/
                        
		}
                /*if(!empty($meta_list)){
                                $common_banner_list = $CI->model_meta->gettablecontact($meta_list->id);
                                
                                $CI->data['common_banner_list']=$common_banner_list;
								
								$testimonial_list = $CI->model_meta->getcommontestimonial($meta_list->id);
                                
                                $CI->data['testimonial']=$testimonial_list;
								
								$timonialimage_list = $CI->model_meta->getcommontestimonialimage($meta_list->id);
                                
                                $CI->data['testimonial_image']=$timonialimage_list;
								
								
                        }*/
	}
	
	
 }