<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller 
{
	private $limit = 20;
	var $offset = 0;
	function __construct()
	{
		parent::__construct();		 
		
		if( ! $this->session->userdata('web_admin_logged_in')) {
			redirect('kaizen/welcome','refresh');
		}
		$this->load->vars( array(
		  'global' => 'Available to all views',
		  'header' => 'common/header',
		  'left' => 'common/left',
          'right' => 'common/right',
		  'footer' => 'common/footer',
          'copyright' => 'common/copyright'
		));
		
		$this->load->model('modelcontact');	
	}

	public function index()
	{	
		
		$this->dolist();	
	}
	
	
	
	public function dolist(){
		$data = array();
		
                $where = array(
                    'site_id' => 1
                            
                        );
                $order_by = array('id' => 'asc');
		$data_row = $this->modelcontact->select_row('contact',$where,$order_by);
		$data['records']= $data_row;
		$this->load->view('kaizen/contact_list',$data);		
	}
	
	public function doadd(){
		$data = array();
        $data['details']= new stdClass;
		$contact_id=$this->uri->segment(4);
		$data['details']->is_active = 1;
		$data['details']->id = $contact_id;
		
		
		$this->load->view('edit_contact',$data);		
	}
    
	public function addedit()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('contact_title', 'Title', 'trim|required|xss_clean');
		
		
		$this->form_validation->set_error_delimiters('<span class="validation_msg">', '</span>');
		$id=$this->input->post('contact_id','');
		if($this->form_validation->run() == TRUE) // IF MENDATORY FIELDS VALIDATION TRUE(SERVER SIDE)  
		{	
			$where = array(
                            'site_id' => $this->session->userdata('SITE_ID'),
                            'id' => $id
                        );
                        $contact_detls = $this->modelcontact->select_row('contact',$where);
        		if(!empty($contact_detls)) 
                {
                    $orglogo_photo1=$contact_detls[0]->map_marker;
			
                                $this->contact_title		=$this->input->post('contact_title',TRUE);
                                $this->fname        		=$this->input->post('fname');
                                $this->lname		=$this->input->post('lname');
                                $this->address        		=$this->input->post('address');
                                $this->phone		=$this->input->post('phone');
                                $this->fax        		=$this->input->post('fax');
                                $this->latitude        		=$this->input->post('latitude');
                                $this->longitude        	=$this->input->post('longitude');
                                $this->is_shown_map        	=$this->input->post('is_shown_map');
                                $this->marker        	=$this->input->post('marker');
                                $this->email        	=$this->input->post('email');
                                
                                
//                                $this->is_active		=$this->input->post('is_active',TRUE); 
                                if($this->is_active===false){
                                        $this->is_active='1';
                                }
                                if(is_uploaded_file($_FILES['htmlfile1']['tmp_name'])) // if image file upload at the updating
                                    {
                                        if(!empty($orglogo_photo1) && is_file(file_upload_absolute_path().'contact_photo/'.$orglogo_photo1)){
                                            unlink(file_upload_absolute_path().'contact_photo/'.$orglogo_photo1);
                                        }
                                        if(!empty($orglogo_photo1) && is_file(file_upload_absolute_path().'contact_photo/thumb_'.$orglogo_photo1)){
                                            unlink(file_upload_absolute_path().'contact_photo/thumb_'.$orglogo_photo1);
                                        }


                                        $marker_photo=uploadImage('htmlfile1','contact_photo');
                                        resizingImage($marker_photo,$upload_rootdir='contact_photo/',$img_width='50',$img_height='50',$img_prefix = 'thumb_');
                                        if(empty($marker_photo) || $marker_photo==false)
                                        {
                                            $session_data = array("ERROR_MSG"  => "Error in image uploading.");
                                            $this->session->set_userdata($session_data);	
                                            redirect("kaizen/contact",'refresh');
                                        }
                                    }	
                                    else
                                    {
                                        $marker_photo=$orglogo_photo1;
                                    }
                                
                                $update_data = array(
                                    'site_id' 				=> $this->session->userdata('SITE_ID'),
                                    'title' 			=> $this->contact_title,
                                    'fname' 			=> $this->fname,
                                    'lname' 			=> $this->lname,
                                    'address' 			=> $this->address,
                                    'phone' 			=> $this->phone,
                                    'fax'               => $this->fax,
                                    'latitude' 			=> $this->latitude,
                                    'longitude' 			=> $this->longitude,
                                    'map_marker' 			=> $marker_photo,
                                    'is_shown_map' 			=> $this->is_shown_map,
                                    'marker' 			=> $this->marker,
                                    'email' 			=> $this->email
                                    
                                    //'is_active' 			=> $this->is_active
                                );
                                
                
				$update_where = array('id' => $id);
				if($this->modelcontact->update_row('contact',$update_data,$update_where)) // IF UPDATE PROCEDURE EXECUTE SUCCESSFULLY
				{
					$session_data = array("SUCC_MSG"  => "Contact Updated Successfully.");
					$this->session->set_userdata($session_data);					
				}			
				else // IF UPDATE PROCEDURE NOT EXECUTE SUCCESSFULLY
				{	
					$session_data = array("ERROR_MSG"  => "Contact Not Updated.");
					$this->session->set_userdata($session_data);				
				}
			}
			else 
			{ 
				$this->contact_title		=$this->input->post('contact_title',TRUE);
                $this->fname        		=$this->input->post('fname');
                $this->lname		=$this->input->post('lname');
                $this->address        		=$this->input->post('address');
                $this->phone		=$this->input->post('phone');
                $this->fax        		=$this->input->post('fax');
                $this->latitude        		=$this->input->post('latitude');
                $this->longitude        		=$this->input->post('longitude');
                $this->is_shown_map        		=$this->input->post('is_shown_map');
                $this->marker        		=$this->input->post('marker');
                $this->email        		=$this->input->post('email');
                
//                $this->is_active		=$this->input->post('is_active',TRUE); 
                if($this->is_active===false){
                        $this->is_active='1';
                }
                
                                    if(is_uploaded_file($_FILES['htmlfile1']['tmp_name'])) // if image file upload at the updating
                                    {


                                        $marker_photo=uploadImage('htmlfile1','contact_photo');
                                        resizingImage($marker_photo,$upload_rootdir='contact_photo/',$img_width='50',$img_height='50',$img_prefix = 'thumb_');
                                        if(empty($marker_photo) || $marker_photo==false)
                                        {
                                            $session_data = array("ERROR_MSG"  => "Error in image uploading.");
                                            $this->session->set_userdata($session_data);	
                                            redirect("kaizen/contact",'refresh');
                                        }
                                    }	
                                                  
                $add_data = array(
                    'site_id' 			=> $this->session->userdata('SITE_ID'),
                    'title' 			=> $this->contact_title,
                    'fname' 			=> $this->fname,
                    'lname' 			=> $this->lname,
                    'address' 			=> $this->address,
                    'phone' 			=> $this->phone,
                    'fax'               => $this->fax,
                    'latitude' 			=> $this->latitude,
                    'longitude' 			=> $this->longitude,
                    'is_shown_map' 			=> $this->is_shown_map,
                    'marker' 			=> $this->marker,
                    'email' 			=> $this->email,
                    'map_marker' 			=> $marker_photo                
                    
                    //'is_active' 			=> $this->is_active
                );
                                
				$id = $this->modelcontact->insert_row('contact',$add_data);
				if($id) // IF UPDATE PROCEDURE EXECUTE SUCCESSFULLY 
				{
					$session_data = array("SUCC_MSG"  => "Contact Inserted Successfully.");
					$this->session->set_userdata($session_data);					
				}			
				else // IF UPDATE PROCEDURE NOT EXECUTE SUCCESSFULLY
				{	
					$session_data = array("ERROR_MSG"  => "Contact Not Inserted.");
					$this->session->set_userdata($session_data);				
				}
				
			}
			redirect("kaizen/contact/doedit/".$id,'refresh');			
		}
		else{
			if(!empty($id)){
			$this->doedit();
			}
			else{
				$this->doadd();
			}
		}
	}
	public function doedit()
	{
		$data = array();
		echo "asdfadsF".$contact_id=$this->uri->segment(4); 
		
		$where = array(
                            'id' => $contact_id
                        );
        $contact_detls = $this->modelcontact->select_row('contact',$where);
                        
		if($contact_detls){
			$data['details'] = $contact_detls[0];
		}
		else{
			$data['details']->is_active = 1;
			$data['details']->id = 0;
		}
		$this->load->view('edit_contact',$data);		
		
	}
	
	/// AXAX - List template variables start
	public function default_fun()
 	{ 
	 $is_default = $this->input->post('is_default');
	
	  $curid = $this->input->post('id');
	   
	// $matches = $this->model_comm_template->get_match_by_module($module_name);
	
	
	if($query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('contact')."` where is_default = '1'"))
		{
			#echo $this->db->last_query();
			$res_all = $query->result();	
		}
		if($is_default == '1'){
			
				$upd_data = array(
						'is_default' 			=> '0'
				);
			
				$where_cond=$this->db->where('id', $curid);
	
				$update_featured = $this->db->update($this->db->dbprefix('contact'), $upd_data);
				
				echo '<input type="checkbox" name="is_default" value="0" onclick="ajaxchange_default(this.value,'.$curid.');" />';
		}
				
		else if(count($res_all) != 1){
			
			if($is_default == '0'){$setfeatured = '1';}else{$setfeatured = '0';}
			
				$upd_data = array(
						'is_default' 			=> $setfeatured
				);
			
				$where_cond=$this->db->where('id', $curid);
	
				$update_featured = $this->db->update($this->db->dbprefix('contact'), $upd_data);
				
					echo '<input type="checkbox" name="is_default" value="1" checked="checked" onclick="ajaxchange_default(this.value,'.$curid.');" />';
				
			
			
			}
			else{
				
				echo '<input type="checkbox" name="is_default" value="0" onclick="ajaxchange_default(this.value,'.$curid.');" />';
				}
		
		
		
	 }
	
	
}