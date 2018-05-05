<?php 
function pre($data){
    echo '<pre>',print_r($data),'</pre>';
}

function socialLinks(){
        $CI =& get_instance();
        $CI->load->model("common/model_common");
        $where = array(
            'site_id' => 1
        );
        $order_by = array(
            'id' => 'asc'
        );
        $social_settings = $CI->model_common->select_row("social_settings",$where,$order_by);
        $default = array(
            1   => 'fb',
            2   => 'twit',
            3   => 'in',
            4   => 'google',
            5   => 'utube',
            6   => 'inst',
            7   => 'ts'            
        );
        $html = '';
        if(!empty($social_settings)){
            foreach($social_settings as $sos){
                $class = '';
                if($default[$sos->social_menus_id]){
                    $class = $default[$sos->social_menus_id];
                }
                $html .= '<li><a href="'.$sos->link.'" class="'.$class.'" target="_blank"></a></li>';
            }
        }
        echo $html;
        
}

function resizingImage($fileName='',$upload_rootdir='',$img_width='',$img_height='',$img_prefix = ''){
	
        $CI =& get_instance();
        if(!is_dir(file_upload_absolute_path().$upload_rootdir)){
                $oldumask = umask(0); 
                mkdir(file_upload_absolute_path().$upload_rootdir, 0777); // or even 01777 so you get the sticky bit set 
                umask($oldumask);
        }
		
        $config['image_library'] = 'gd2';		
     	$config['source_image'] = file_upload_absolute_path().$upload_rootdir.$fileName; 
        $config['new_image']	= file_upload_absolute_path().$upload_rootdir.$img_prefix.$fileName;
        
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $img_width;
        $config['height'] = $img_height;
	$CI->load->library('image_lib', $config);
       	$CI->image_lib->initialize($config); 
      	if(!$CI->image_lib->resize()){
            echo $CI->image_lib->display_errors();			
        }
        else{
                return false;
        }

}

function uploadImage($field='',$upload_dir='') 
    {		
        $CI =& get_instance();
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
		                     
        
        $CI->load->library('upload', $config); // LOAD FILE UPLOAD LIBRARY
        $CI->upload->initialize($config);
        if($CI->upload->do_upload($field_name)) // CREATE ORIGINAL IMAGE
					{						
						$fInfo = $CI->upload->data();					
						//$data['uploadInfo'] = $fInfo;            
						
						return $fInfo['file_name']; // RETURN ORIGINAL IMAGE NAME
					}
							else // IF ORIGINAL IMAGE NOT UPLOADED
							{			
						return false; // RETURN ORIGINAL IMAGE NAME              
							}
}
        
function name_replaceCat($string){    
                $CI =& get_instance();
		$string = strip_tags(outputEscapeString($string));
		$string = preg_replace('/[^A-Za-z0-9\s\s]/', '', $string);
		$cat_replace = str_replace(" ","-",$string);
		$query = $CI->db->query("SELECT `id` FROM `".$CI->db->dbprefix('cms_pages')."` WHERE page_link like '%".$cat_replace."%'");
		$count=$query->num_rows();
		if($query->num_rows()>0){
			$cat_replace=$cat_replace.($count+1);
		}
		return strtolower($cat_replace);
	}
	

?>