<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
  public function __construct(){ 
    parent::__construct(); 
    if($this->session->userdata('web_admin_logged_in')!=TRUE) {
            redirect('kaizen','refresh');
    }
    
    $current_module = $this->router->fetch_module();
    $this->load->model('common/model_common');
  }
  
  
  public function imagedelete(){
                $id=$this->input->get('deleteid', TRUE);
		$field_name=$this->input->get('field_name', TRUE);
		$table_name=$this->input->get('table_name', TRUE);
		$folder_name=$this->input->get('folder_name', TRUE);
		$module_name=$this->input->get('module_name', TRUE);
                
                $where = array(
                        'site_id' => $this->session->userdata('SITE_ID'),
                        'id' => $id
                    );
                $detls = $this->model_common->select_row($table_name,$where);
						
		if(!empty($detls))
		{ 
                        if(is_file(file_upload_absolute_path().$folder_name."/".$detls[0]->$field_name)){
					unlink(file_upload_absolute_path().$folder_name."/".$detls[0]->$field_name);
                        }
                        if(is_file(file_upload_absolute_path().$folder_name."/thumb_".$detls[0]->$field_name)){
					unlink(file_upload_absolute_path().$folder_name."/thumb_".$detls[0]->$field_name);
                        }
                        $update_data = array(
                                 $field_name =>''
                                );
                        $update_where = array('id' => $id);
                        $update = $this->model_common->update_row($table_name,$update_data,$update_where);
                        if($update)
                        {
                                $session_data = array("ERROR_MSG"  => "Image Remove Successfully.");
                                $this->session->set_userdata($session_data);	
                        }
                        else
                        {
                               
                        } 
                                
			
		}	
		else
		{
			$session_data = array("ERROR_MSG"  => "Image Not deleted Successfully.");
			$this->session->set_userdata($session_data);
		}
                redirect("kaizen/".$module_name,'refresh');
                 
  }
  public function rowdelete(){
        $id=$this->input->get('deleteid', TRUE);
        $table_name=$this->input->get('table_name', TRUE);
        $module_name=$this->input->get('module_name', TRUE);
        
        $where = array(
                    'id' => $id

                );

        $this->model_common->delete_row($table_name,$where);
        $this->session->set_flashdata('message','Successfull deleted');
        redirect("kaizen/".$module_name,'refresh');
                
  }
  
  public function statusChange(){
      $data_id = $this->uri->segment(4, 0);
      $table_name = $this->uri->segment(5, 0);
      
      if(!empty($data_id) && !empty($table_name)){
        $where = array(
                            'site_id' => $this->session->userdata('SITE_ID'),
                            'id' => $data_id
                        );
        $data_details = $this->model_common->select_row($table_name,$where);
        if(!empty($data_details[0])){
            if($data_details[0]->is_active == 1){
                $update_data = array(
                        'is_active' =>0
                       );
            }else{
                $update_data = array(
                        'is_active' =>1
                       );
            }
            $update_where = array('id' => $data_id);
            if($this->model_common->update_row($table_name,$update_data,$update_where)){
                $session_data = array("SUCC_MSG"  => "Status Changed Successfully.");
		$this->session->set_userdata($session_data);
            }else{
                $session_data = array("ERROR_MSG"  => "Status Not Changed Successfully.");
                $this->session->set_userdata($session_data);
            }
                
        }else{
                $session_data = array("ERROR_MSG"  => "Status Not Changed Successfully.");
                $this->session->set_userdata($session_data);
        }       
      }else
        {
                $session_data = array("ERROR_MSG"  => "Status Not Changed Successfully.");
                $this->session->set_userdata($session_data);
        }
      redirect("kaizen/".$this->router->fetch_class(),'refresh');
  }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */