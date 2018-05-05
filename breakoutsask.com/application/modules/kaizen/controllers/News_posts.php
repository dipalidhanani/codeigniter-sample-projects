<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_posts extends MY_Controller {
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
		  'footer' => 'common/footer',
		  'copyright' => 'common/copyright'
		));
		$this->load->library('pagination');
		$this->load->model('modelnews_posts');
		$this->load->model('modelnews_category');
		//$this->load->library('image_lib'); // LOAD IMAGE THUMB LIBRARY	
		
	}
	public function index(){		
		//$this->load->helper('security');
		$offsets = (($this->uri->segment(4)) ? $this->uri->segment(4) : 1);
		if($offsets>1){$this->offset = (($offsets - 1)*$this->limit);}else{$this->offset = ($offsets - 1);}
		$searchstring = xss_clean(rawurldecode($this->input->get('q')));
		$this->dolist($searchstring);	
	}
	
	public function pagination($searchstring="",$total_row=0){
		$config['use_page_numbers'] = TRUE;		
		if(!empty($searchstring)){
			$config['uri_segment'] = 5;
			$config['base_url'] = site_url("news_posts/dosearch/".rawurlencode($searchstring)."/");
		}
		else{
			$config['uri_segment'] = 4;
			$config['base_url'] = site_url("news_posts/index/");
		}
		$config['total_rows'] = $total_row;
		$config['per_page'] = $this->limit;
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		$config['next_link'] = '&gt;';
		$config['prev_link'] = '&lt;';
		$config['first_tag_open'] = '<li>';	
		$config['first_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		return $config;
	}
	
	public function dolist($searchstring=""){
		$data = array();
		$total_row = $this->modelnews_posts->getCountAll("news_post",$searchstring);
		$this->pagination($searchstring,$total_row);
		$data['q'] = $searchstring;
		
		$data_row = $this->modelnews_posts->getAllDetails("news_post",$this->limit,$this->offset,$searchstring);
		if(empty($data_row)){
			$data['empty_msg'] = "No record found.";
		}
		$data['total_records']= $total_row;
		$data['records']= $data_row;
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('news_posts_list',$data);		
	}
	public function dosearch(){
		//$this->load->helper('security');
		$offsets = (($this->uri->segment(5)) ? $this->uri->segment(5) : 1);
		if($offsets>1){$this->offset = (($offsets - 1)*$this->limit);}else{$this->offset = ($offsets - 1);}
		$searchstring = xss_clean(rawurldecode($this->uri->segment(4)));
		$this->dolist($searchstring);	
	}
	public function doadd(){
		$data = array();
		$id=$this->uri->segment(4);
		$data['details'] = new StdClass;
		$data['details']->is_active = 1;
		$data['details']->id = $id;
		$data['category']= $this->productcategoryselectbox("0",'','2');
		$data['selected_category']= '';
		/*$data_row = $this->modelcategory->getAllCategory("products");
		$data['records']= $data_row;*/
		
		$this->load->view('edit_news_posts',$data);		
	}
	public function addedit()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
		
		
		$this->form_validation->set_error_delimiters('<span class="validation_msg">', '</span>');
		$id=$this->input->post('id','');
		if($this->form_validation->run() == TRUE) // IF MENDATORY FIELDS VALIDATION TRUE(SERVER SIDE)  
		{
			
			if(!empty($id) && $this->modelnews_posts->getSingleRecord($id)) 
			{	

				$getFile=$this->modelnews_posts->editDetail($id);
				$orgimgpath=$getFile->banner_photo;
				if(isset($_FILES['htmlfile']['tmp_name']) && is_uploaded_file($_FILES['htmlfile']['tmp_name'])) // if image file upload at the updating
				{
							
					if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'news_posts/'.$orgimgpath)){
						unlink(file_upload_absolute_path().'news_posts/'.$orgimgpath);
					}
					if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'news_posts/thumb_'.$orgimgpath)){
						unlink(file_upload_absolute_path().'news_posts/thumb_'.$orgimgpath);
					}
					if(!empty($orgimgpath) && is_file(file_upload_absolute_path().'news_posts/sthumb_'.$orgimgpath)){
						unlink(file_upload_absolute_path().'news_posts/sthumb_'.$orgimgpath);
					}				
					$uplod_img=$this->uploadImage('htmlfile','news_posts/');
					$this->resizingImage($uplod_img,$upload_rootdir='news_posts/',$img_width='710',$img_height='365',$img_prefix = 'thumb_');
					$this->resizingImage($uplod_img,$upload_rootdir='news_posts/',$img_width='327',$img_height='271',$img_prefix = 'sthumb_');
					
				}	
				else
				{
					$uplod_img=$orgimgpath;
				}

				if($this->modelnews_posts->updateDetais($id,$uplod_img)) // IF UPDATE PROCEDURE EXECUTE SUCCESSFULLY
				{
					$session_data = array("SUCC_MSG"  => "news post Updated SUCCESSFULLY.");
					#$this->session->set_userdata($session_data);					
				}			
				else // IF UPDATE PROCEDURE NOT EXECUTE SUCCESSFULLY
				{	
					$session_data = array("ERROR_MSG"  => "news post Not Updated.");
					$this->session->set_userdata($session_data);				
				}
			}
			else 
			{	
				$uplod_img = "";
				if(is_uploaded_file($_FILES['htmlfile']['tmp_name'])) // if image file upload at the updating
			{
				
				$uplod_img=$this->uploadImage('htmlfile','news_posts/');
				$this->resizingImage($uplod_img,$upload_rootdir='news_posts/',$img_width='710',$img_height='365',$img_prefix = 'thumb_');
				$this->resizingImage($uplod_img,$upload_rootdir='news_posts/',$img_width='327',$img_height='271',$img_prefix = 'sthumb_');
				if(empty($uplod_img) || $uplod_img==false)
				{
					$session_data = array("ERROR_MSG"  => "Error in image uploading.");
					$this->session->set_userdata($session_data);	
					redirect("kaizen/cms/doedit/".$id,'refresh');
				}
			}
				$id = $this->modelnews_posts->addDetails($uplod_img);
				if($id) // IF UPDATE PROCEDURE EXECUTE SUCCESSFULLY
				{
					$session_data = array("SUCC_MSG"  => "news post Inserted SUCCESSFULLY.");
					#$this->session->set_userdata($session_data);					
				}			
				else // IF UPDATE PROCEDURE NOT EXECUTE SUCCESSFULLY
				{	
					$session_data = array("ERROR_MSG"  => "news post Not Inserted.");
					$this->session->set_userdata($session_data);				
				}
				
			}
			redirect("kaizen/news_posts/doedit/".$id,'refresh');			
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
		$selected_category=array();
		$banner_id=$this->uri->segment(4);
		$q = $this->modelnews_posts->editDetail($banner_id);		
		if(count($q->selectedcategory)>0)
		{
			foreach($q->selectedcategory as $cat_select)
			{
				$selected_category[]=$cat_select->cat_id;
			}
		}
		if($q){
			$data['details'] = $q;
		}
		else{
			$data['details'] = new StdClass;
			$data['details']->is_active = 1;
			$data['details']->id = 0;
		}
		
		$data['category']= $this->productcategoryselectbox("0",$selected_category,'2');
		$data['selected_category']= $this->productcategoryselectboxselected(0,$selected_category,2);
		
		
		$data_row = $this->modelnews_posts->getAllDetails("news_post");
		$data['records']= $data_row;
		
		//echo "<pre>";print_r($data_row);exit;
		$this->load->view('edit_news_posts',$data);		
		
	}
	
		public function do_changestatus() // CHANGE STATUS
	{
		
	    $status_id=$this->uri->segment(4, 0); // STATUS CHANGE RECORD ID
		
						
		if((int)$status_id > 0 && $this->modelnews_posts->getSingleRecord1('news_post',$status_id))
		{ 
			if($this->modelnews_posts->changeStatus('news_post',$status_id))
			{				
				
				$session_data = array("SUCC_MSG"  => "Status Changed Successfully.");
				$this->session->set_userdata($session_data);
			}
			else
			{
				$session_data = array("ERROR_MSG"  => "Status Not Changed Successfully.");
				$this->session->set_userdata($session_data);
			}
		}	
		else
		{
			$session_data = array("ERROR_MSG"  => "Status Not Changed Successfully.");
			$this->session->set_userdata($session_data);
		}
		redirect("kaizen/news_posts",'refresh');
		
	}	
	
	
	public function do_changefeature() // CHANGE STATUS
	{
		
	    $status_id=$this->uri->segment(4, 0); // STATUS CHANGE RECORD ID
		
						
		if((int)$status_id > 0 && $this->modelnews_posts->getSingleRecord1('news_post',$status_id))
		{ 
			if($this->modelnews_posts->changeFeatured('news_post',$status_id))
			{				
				
				$session_data = array("SUCC_MSG"  => "Featured Changed Successfully.");
				$this->session->set_userdata($session_data);
			}
			else
			{
				$session_data = array("ERROR_MSG"  => "Featured Not Changed Successfully.");
				$this->session->set_userdata($session_data);
			}
		}	
		else
		{
			$session_data = array("ERROR_MSG"  => "Featured Not Changed Successfully.");
			$this->session->set_userdata($session_data);
		}
		redirect("kaizen/news_posts",'refresh');
		
	}
	public function dodelete(){		
		$del_id=$this->input->get('deleteid');
		#$ref=rawurldecode($this->input->get('ref'));
		$tablename="news_post";
		$idname='id';
			
		$delrec=$this->modelnews_posts->delSingleRecord($del_id,$tablename,$idname);
		if($delrec===true){
			$session_data = array("SUCC_MSG"  => "Deleted Successfully");
			#$this->session->set_userdata($session_data);
		}
		else{
			$session_data = array("ERROR_MSG"  => "Some problem occureed, please try again.");
			$this->session->set_userdata($session_data);
		}
		redirect("kaizen/news_posts/dolist/",'refresh');		
		#redirect($ref,'refresh');
	}
	
	
	
	public function dodeleteimg() // CHANGE STATUS
	{
		
	    $id    = $this->input->get('deleteid');
		$field = $this->input->get('field');
						
		if((int)$id > 0 && $this->modelnews_posts->getSingleRecord($id))
		{ 
			if($this->modelnews_posts->deleteImg($id,$field))
			{				
				
				#$session_data = array("SUCC_MSG"  => "Image deleted Successfully.");
				#$this->session->set_userdata($session_data);
			}
			else
			{
				$session_data = array("ERROR_MSG"  => "Image Not deleted Successfully.");
				$this->session->set_userdata($session_data);
			}
			redirect("kaizen/news_posts/doedit/".$id,"refresh");
		}	
		else
		{
			$session_data = array("ERROR_MSG"  => "Image Not deleted Successfully.");
			$this->session->set_userdata($session_data);
			redirect("kaizen/news_posts/doadd/0","refresh");
		}
			
		redirect("kaizen/news_posts/","refresh");
	}
		//=============== START IMAGE MANUPULATION==============// 
	
	
   function productcategoryselectbox($pid,$selected,$depth=0)
{
	$tab='';
	for($k=0;$k<$depth;$k++)
		$tab .=	"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if($depth > 0)
		$tab .=	"-->";
		
	$rs = $this->modelnews_category->getRecordByParentId("news_category",$pid);
	
	$str = "";
	
	
	if(!empty($rs))
	{	
		foreach($rs as $category)
		{
		
          $count_subcategory 	= $this->modelnews_category->getRecordByParentId("news_category",$category->id);
		   if($category->parent_id=='0' || count($count_subcategory) > 0 || $category->parent_id!='0')
		   { 
	           if($depth==0)
				{
					$str .= "<optgroup label=\"".$category->title."\">";
					$str.= fillProductCategory11($category->id,$selected,$site_id,$condition,$depth+1);
					$str .= "</optgroup>";
				}
				else
				{				
						$str .= "<option value=\"".$category->id."\" ";
			
						if(is_array($selected))
						{
							foreach($selected as $val)
							{
								if($val == $category->id)
									$str .= " disabled ";
			
							}
						}
						else
						{
							if($selected == $category->id)
								$str .= " selected ";
						
						}
						$str .= ">".$tab.$category->title."</option>\n";	
						$str.=$this->productcategoryselectbox($category->id,$selected,$depth+1);						
				}
		   }				
			
		}
		
	}
	
	return $str;
   
}
function productcategoryselectboxselected($pid,$selected = '',$depth=0)
{
	
	$tab='';
	for($k=0;$k<$depth;$k++)
		$tab .=	"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if($depth > 0)
		$tab .=	"-->";
	
	$rs = $this->modelnews_category->getRecordByParentId("news_category",$pid);
	
	$str = "";
	
	if(!empty($rs))
	{	
		foreach($rs as $category)
		{
		
			if(is_array($selected))
			{
				foreach($selected as $val)
				{
					if($val == $category->id)
						$str .= "<option value=\"".$category->id."\"  selected >".$tab.$category->title."</option>\n";
				}
			}
			else if($selected == $category->id)
			{
				$str .= "<option value=\"".$category->id."\"   selected  >".$tab.$category->title."</option>\n";
			}
					
		
		$str.= $this->productcategoryselectboxselected($category->id,$selected,$depth+1);
		
	}
}
	
	return $str;
}	

	function uploadImage($field='',$upload_dir='',$new_name = '') 
    {				
		
		$field_name=$field;
		
		if(!is_dir(file_upload_absolute_path().$upload_dir)){
			$oldumask = umask(0); 
			mkdir(file_upload_absolute_path().$upload_dir, 0777); // or even 01777 so you get the sticky bit set 
			umask($oldumask);
		}
		
     		$config['upload_path'] = file_upload_absolute_path().$upload_dir;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '5000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000'; 
		                     
        
        $this->load->library('upload', $config); // LOAD FILE UPLOAD LIBRARY
        $this->upload->initialize($config);
        if($this->upload->do_upload($field_name)) // CREATE ORIGINAL IMAGE
					{						
						$fInfo = $this->upload->data();					
						$data['uploadInfo'] = $fInfo;            
						
						return $fInfo['file_name']; // RETURN ORIGINAL IMAGE NAME
					}
							else // IF ORIGINAL IMAGE NOT UPLOADED
							{			
						return false; // RETURN ORIGINAL IMAGE NAME              
							}
    }
   //=============== END IMAGE MANUPULATION==============//
   //////////////////==================Start Image Rsizing==================/////////////////////		
	function resizingImage($fileName='',$upload_rootdir='',$img_width='',$img_height='',$dest_name='') 
    {		
		if(!is_dir(file_upload_absolute_path().$upload_rootdir)){
			$oldumask = umask(0); 
			mkdir(file_upload_absolute_path().$upload_rootdir, 0777); // or even 01777 so you get the sticky bit set 
			umask($oldumask);
		}
		
        $config['image_library'] = 'gd2';		
     	$config['source_image'] = file_upload_absolute_path()."news_posts/".$fileName; 
		$config['new_image']	= file_upload_absolute_path().$upload_rootdir.$dest_name.$fileName;
		#$config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $img_width;
        $config['height'] = $img_height;
		$this->load->library('image_lib', $config);
    /*echo $upload_rootdir;
    echo "<br>";
   echo $config['source_image'];
   echo "<br>";
   echo $config['new_image'];
   echo "<br>";
    */
       	$this->image_lib->initialize($config); 
		
      	if(!$this->image_lib->resize()){
            echo $this->image_lib->display_errors();			
        }
		else{
			return false;
		}
	}
	//////////////////==================End Image Rsizing==================/////////////////////	
	
	
	
	
	
}