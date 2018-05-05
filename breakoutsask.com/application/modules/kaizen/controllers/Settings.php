<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->vars( array(
		  'global' => 'Available to all views',
		  'header' => 'common/header',
		  'left' => 'common/left',
		  'footer' => 'common/footer',
                    'copyright' => 'common/copyright'
		));
		$this->load->model('modelsettings');
		
		
	}

	public function index()
	{
		$data = array();
                $where = array(
                    'id' => 1
                            
                        );
		$res_arr = $this->modelsettings->select_row('site_settings',$where);
                if(!empty($res_arr[0])){
                    $data['details'] = $res_arr[0];
                }else{
                    $data['details'] = array();
                }
                 $where = array(
                    'id' => $this->session->userdata('web_admin_user_id')
                            
                        );
                $where_social = array(
                            'site_id' => 1
                        );
                $order_by = array('sequence' =>'desc');
                $social_settings_arr = $this->modelsettings->select_row('social_settings',$where_social,$order_by);
                $data['social_settings_arr'] = $social_settings_arr;
                
		$this->load->view('settings',$data);
	}

	public function save()
	{
	if($this->input->post('reset') == 'Reset Password'){
		
		
		
			$status_query = $this->db->get_where($this->db->dbprefix('admin'), array('id' => $this->session->userdata('web_admin_user_id')));		
			
			$res = $status_query->result();
			
			if($res[0]->pwd != SHA1($this->input->post('old_pwd'))){
					$session_data = array("ERROR_MSG"  => "Old Password doesnt match with current login.");
					$this->session->set_userdata($session_data);	
				
			}
			else{
				
				if(($this->input->post('new_pwd') == $this->input->post('repeat_pwd')) && ($this->input->post('new_pwd') != '')){
					
					$where =  array(
                            'id' => $this->session->userdata('web_admin_user_id')
                        );
					
					$upd_data = array(
					'pwd' => SHA1($this->input->post('new_pwd'))
					);
					
					$return = $this->modelsettings->update_row("admin",$upd_data,$where);
					
					if($return){
					
					//$this->db->where('id' => $id);
					
					$session_data = array("SUCCESS_MSG"  => "Password changed successfully");
					$this->session->set_userdata($session_data);
					}
				}
				else{
					$session_data = array("ERROR_MSG"  => "Password has not changed. ");
					$this->session->set_userdata($session_data);
					
					}
				
				
				}
		
		
		redirect("kaizen/settings/",'refresh');
		
	}else{                
		$data = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('site_name', 'Site Name', 'trim|required|xss_clean');

		$this->form_validation->set_error_delimiters('<span class="validation_msg">', '</span>');
		if($this->form_validation->run() == TRUE) // IF MENDATORY FIELDS VALIDATION TRUE(SERVER SIDE)
		{
		
			//$getFile=$this->modelsettings->getSingleRecord('1');			
                        $where = array(
                            'id' => 1
                        );
                        $q = $this->modelsettings->select_row('site_settings',$where);
                        
                        $orglogo_photo1=$q[0]->logo_photo;
			$footer_logo = $q[0]->footer_logo;
                        
                        
                        
                        if(is_uploaded_file($_FILES['htmlfile1']['tmp_name'])) // if image file upload at the updating
				{
						
					
					if(!empty($orglogo_photo1) && is_file(file_upload_absolute_path().'setting_photo/'.$orglogo_photo1)){
						unlink(file_upload_absolute_path().'setting_photo/'.$orglogo_photo1);
					}
					if(!empty($orglogo_photo1) && is_file(file_upload_absolute_path().'setting_photo/thumb_'.$orglogo_photo1)){
						unlink(file_upload_absolute_path().'setting_photo/thumb_'.$orglogo_photo1);
					}
					
									
					$logo_photo=uploadImage('htmlfile1','setting_photo');
					resizingImage($logo_photo,$upload_rootdir='setting_photo/',$img_width='271',$img_height='57',$img_prefix = 'thumb_');
					if(empty($logo_photo) || $logo_photo==false)
					{
						$session_data = array("ERROR_MSG"  => "Error in image uploading.");
						$this->session->set_userdata($session_data);	
						redirect("kaizen/Settings",'refresh');
					}
				}	
				else
				{
					$logo_photo=$orglogo_photo1;
				}
				
				   
			
			
			$where = array(
                            'id' => 1
                            
                        );
                            
                        $this->site_name					= $this->input->post('site_name',TRUE);	
                        $this->phone						= $this->input->post('phone',TRUE);			
                        $this->url							= $this->input->post('url',TRUE);		
                        $this->copy_right					= $this->input->post('copy_right',TRUE);
						$this->book_online_link = 	$this->input->post('book_online_link',TRUE);					
                        $this->email					= $this->input->post('email',TRUE);						
                        $this->address						= $this->input->post('address',TRUE);
                        $this->fb_link						= $this->input->post('fb_link',TRUE);
                        $this->linkedin_link				= $this->input->post('linkedin_link',TRUE);
                        $this->twitter_link					= $this->input->post('twitter_link',TRUE);
                        $this->google_link					= $this->input->post('google_link',TRUE);
                        $this->youtube_link					= $this->input->post('youtube_link',TRUE);
                        $this->instagram_link				= $this->input->post('instagram_link',TRUE);    
                        $this->tumblr_link				= $this->input->post('tumblr_link',TRUE);    
                        $this->site_verification			= $this->input->post('site_verification','');
                        $this->analytics_code				= $this->input->post('analytics_code',''); 
                        $this->profile_id				= $this->input->post('profile_id',TRUE); 
                        $this->show_comment				= $this->input->post('show_comment',TRUE); 
                        $this->comments_moderated				= $this->input->post('comments_moderated',TRUE); 
                        $this->meta_title				= $this->input->post('meta_title',''); 
                        $this->meta_keyword				= $this->input->post('meta_keyword',''); 
                        $this->meta_desc				= $this->input->post('meta_desc',''); 
						
                       // $this->request_quote_email				= $this->input->post('request_quote_email',TRUE); 
                        
                        
                        $upd_data = array(
                            'site_name' =>$this->site_name,
                            'phone' =>$this->phone,
                            'url' =>$this->url,
                            'copy_right' =>$this->copy_right,
							'book_online_link' => $this->book_online_link,
                            'email' =>$this->email,
                            'address' =>$this->address,
                            'site_verification'			=> $this->site_verification,
                            'analytics_code'			=> $this->analytics_code,
                            'linkedin_link' 			=> $this->linkedin_link ,
                            'google_link' 				=> $this->google_link ,
                            'fb_link' 					=> $this->fb_link ,
                            'twitter_link' 				=> $this->twitter_link ,		
                            'youtube_link' 				=> $this->youtube_link ,		
                            'instagram_link' 			=> $this->instagram_link ,			
                            'logo_photo' 			=> $logo_photo ,
                            'tumblr_link' 			=> $this->tumblr_link, 			
                            'profile_id' 			=> $this->profile_id, 			
                            'show_comment' 			=> $this->show_comment,			
                            'meta_title' 			=> $this->meta_title,			
                            'meta_keyword' 			=> $this->meta_keyword,			
                            'meta_description' 			=> $this->meta_desc,	
                            'comments_moderated' 			=> $this->comments_moderated 			
                        );
                        
			$return = $this->modelsettings->update_row("site_settings",$upd_data,$where);
                        
                        $count = $this->input->post("count");
                        if(!empty($count)){
                            for($i=1;$i<=$count;$i++){
                                $social_menus_id = $this->input->post("predifine_link_".$i);
                                $url = $this->input->post("url_".$i);
                                $sequence = $this->input->post("sequence_".$i);
                                $social_settings_id = $this->input->post("social_settings_id_".$i);
                                
                                if(!empty($social_menus_id) && !empty($url) && !empty($sequence)){
                                    $social_arr = array(
                                                    'social_menus_id' => $social_menus_id,
                                                    'link' => $url,
                                                    'site_id' => 1,
                                                    'sequence' => $sequence
                                    );
                                    if(!empty($social_settings_id)){
                                        $update_where = array('id' => $social_settings_id);
                                        $this->modelsettings->update_row('social_settings',$social_arr,$update_where);
                                    }else{
                                        
                                         $this->modelsettings->insert_row('social_settings',$social_arr);
                                    }
                                }
                            }
                        }
			$session_data = array("SUCC_MSG"  => "Settings Updation Is Successfully Completed.");
			$this->session->set_userdata($session_data);
			redirect("kaizen/settings/",'refresh');
		}
		else 
		{
			$this->index();
		}
	}
	}
        
        public function add_file(){		 
		$data = array();
		
		$count = $this->input->post("count");
		$url = $this->input->post("url");
		$predifine_link = $this->input->post("predifine_link");
		$sequence = $this->input->post("sequence");
		$social_settings_id = $this->input->post("social_settings_id");
		
		$data['count'] = $count;
		$data['url'] = $url;
		$data['predifine_link'] = $predifine_link;
		$data['social_settings_id'] = $social_settings_id;
		$data['sequence'] = $sequence;
		$where = array(
                            'site_id' => 1,
                            'is_active' =>1
                        );
                $social_menus_arr = $this->modelsettings->select_row('social_menus',$where);
                $data['social_menus_arr'] = $social_menus_arr;
                
                if(empty($social_settings_id)){
                    $where_social = array(
                                'site_id' => 1
                            );
                }else{
                    $where_social = array(
                                'site_id' => 1,
                                'id !=' => $social_settings_id
                            );
                }
                $social_settings_arr = $this->modelsettings->select_row('social_settings',$where_social);
                $data['social_settings_arr'] = $social_settings_arr;
                
                
                
		$this->load->view('file_div_information',$data);		
	}	
        
}