<?php $this->load->view($header); ?>
<?php $this->load->view($left); ?>
<script type="text/javascript" src="<?php echo base_url("public/ckeditor/ckeditor.js");?>"></script>
<link rel="stylesheet" href="<?php echo base_url("public/validator/css/validationEngine.jquery.css");?>" type="text/css"/>
<script src="<?php echo base_url("public/js/jquery-1.8.3.min.js");?>" type="text/javascript"></script>
<script src="<?php echo base_url("public/validator/js/languages/jquery.validationEngine-en.js");?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url("public/validator/js/jquery.validationEngine.js");?>" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url("public/kaizen/css/jquery.ui.all.css");?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url("public/kaizen/js/ui/jquery.ui.core.js");?>"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("#cont").validationEngine();
	});
function form_submit(val){	
		$('#cont').submit();
}
function goto_page(){
document.location.href = "<?php echo site_url("kaizen/products/");?>";
}
function confirmdel_post(id,page){
	if(confirm("Are you sure want to delete?")){
		window.location.href="<?php echo site_url("kaizen/theme_rooms/dodelete/");?>?deleteid="+id;
	}
	else{
		return false;
	}
}

function showuploadicon(){
	document.getElementById('iconsizetext').style.display = '';
	document.getElementById('imagesizetext').style.display = 'none';
	}
function showuploadimage(){
	document.getElementById('iconsizetext').style.display = 'none';
	document.getElementById('imagesizetext').style.display = '';
	}
	
function showback_image(){
	document.getElementById('div_background_image').style.display = '';
	}
function hideback_image(){
	document.getElementById('div_background_image').style.display = 'none';
	}
</script>
<div class="rightDiv">
  <div class="right-outer">
    <div class="right-outer">
      <h3 class="title">Homepage</h3>
      <div class="bread-crumb">
        <ul>
          <li>
          <li><a href="<?php echo base_url("kaizen/theme_rooms/doadd/0/");?>">Featured Blocks</a></li>
        </ul>
      </div>
      <div class="clear"></div>
      
      <!--Search area end-->
      <div class="padbot40">
        <div class="mid-block">
          <div class="mid-content"> 
            <!--<h3>Edit User</h3>-->
            <div id="member-form">
              <?php 
		  $attributes = array('name' => 'cont', 'id' => 'cont');
		  echo form_open_multipart('kaizen/theme_rooms/addedit/'.$details->id,$attributes);
		  echo form_hidden('id', $details->id);
		  
		  ?>
              <?php
		if($this->session->userdata('ERROR_MSG')==TRUE){
			echo '<div class="notific_error">
					<h2 align="center" style="color:#fff;">'.$this->session->userdata('ERROR_MSG').'</h1></div>';
			$this->session->unset_userdata('ERROR_MSG');
		}
		if($this->session->userdata('SUCC_MSG')==TRUE){
			echo '<div class="notific_suc"><h2 align="center" style="color:#000;">'.$this->session->userdata('SUCC_MSG').'</h1></div>';
			$this->session->unset_userdata('SUCC_MSG');
		}
		?>
              <?php echo validation_errors('<div class="notific_error">', '</div>'); ?>
              <div class="single-column">
                <label>Title<span>*</span></label>
                <input type="text" name="title" id="title" value="<?php if(isset($details->title)){echo $details->title;}?>" class="inputinpt validate[required]" />
              </div>
            
           
          
              
              <div class="single-column">
                <label>Theme room Image:</label>
               			<div class="formFields">
							<div >
								<input type="file" class="file" name="htmlfile" onchange="document.getElementById('fakefilepc1').value = this.value;" />
							
							</div>
						</div>
						<div class="spacer"></div>
						<p class="sizetxt" >Size Requirement:  515 x 372 pixels</p>
              </div>
              
              
              <?php						
	if(!empty($details->theme_image))
	{						
	?>
    <div class="single-column">
                <label>&nbsp;</label>
              <img src="<?php echo file_upload_base_url()."theme_image/".$details->theme_image;?>" width="150" />
              </div>
	<div class="single-column">
                <label>&nbsp;</label>
             <a href="javascript:void(0);" title="Remove" onclick="confirmdel('<?php echo $details->id;?>','theme_image');" class="removebtn" >Remove</a>
              </div>
	<?php
	}
	?>             
               <div class="single-column">
                <label>Description</label>
               <textarea id="description" name="description"><?php if(!empty($details->description)){echo outputEscapeString($details->description);}?>
</textarea>
              </div>
              
           
            
            
            
            <div id="div_background_image" >            
             <div class="single-column">
                <label>Theme room Background Image:</label>
               			<div class="formFields">
							<div >
								<input type="file" class="file" name="background_image" />
							
							</div>
						</div>
						<div class="spacer"></div>
						<p class="sizetxt" >Size Requirement:  2000 x 1520 pixels</p>
              </div>
              
              
              <?php						
	if(!empty($details->theme_background_image))
	{						
	?>
    <div class="single-column">
                <label>&nbsp;</label>
              <img src="<?php echo file_upload_base_url()."theme_background_image/".$details->theme_background_image;?>" width="150" />
              </div>
	<div class="single-column">
                <label>&nbsp;</label>
             <a href="javascript:void(0);" title="Remove" onclick="confirmdel('<?php echo $details->id;?>','theme_background_image');" class="removebtn" >Remove</a>
              </div>
	<?php
	}
	?>
              
         </div>  
	   	
            <div class="single-column">
                <label>Button Link</label>
                <input type="text" name="theme_button_link" id="theme_button_link" value="<?php if(isset($details->theme_button_link)){echo $details->theme_button_link;}?>" class="inputinpt" />
            </div>
            
            <div class="single-column">
                <label>Display order</label>
                <input type="text" name="display_order" id="display_order" value="<?php if(isset($details->display_order)){echo $details->display_order;}?>" class="inputinpt" />
            </div>
	
            <div class="single-column">
                <label>Status:</label>
                &nbsp;<input type="radio" name="status" id="status" value="Active" <?php if(isset($details->status) && $details->status == 'Active'){echo "checked";}else if($details->id == 0){echo "checked";} ?> /> Active
                &nbsp;<input type="radio" name="status" id="status" value="Inactive" <?php if(isset($details->status) && $details->status == 'Inactive'){echo "checked";} ?> /> Inactive
            </div>        
                    
           <a href="javascript:void(0);" title="Delete" onClick="confirmdel_post('<?php echo $details->id;?>','<?php echo rawurlencode(base_url("kaizen/theme_rooms"));?>');" class="delete-red-btn" <?php if(isset($details->id) && $details->id >0){}else{echo 'style="display:none;"';}?>> <span>Delete</span> </a> 
        <a href="javascript:void(0);" class="edit-btn" onClick="form_submit();"><span>Save</span></a> 
        <?php echo form_close();?>
            </div>
          </div>
          
        </div>
        <div class="rt-block">
          <div class="rt-bg-block">
            <div class="rt-column search-side"> 
              <!--<form id="sidebar-search">
                            <input type="text" id="search-box" name="Search Box" value="Search Box">
                            <input type="submit" value="Submit" name="">
                      </form>-->
              
              <div class="clear"></div>
              <a href="<?php echo site_url("kaizen/theme_rooms/");?>" class="temp-btn orange-btn">Cancel</a>  
              <a href="<?php echo site_url("kaizen/theme_rooms/");?>" class="temp-btn">Theme Rooms List</a>			
          </div>
        </div>
      </div>
     
    </div>
     <?php $this->load->view($copyright); ?>
      
  </div>
</div>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.replace( 'description',
    {
		toolbar : '2WEB',
		width : '95%',
		contentsCss : '<?php echo base_url("public/kaizen/css/style_ck.css");?>',	
		 filebrowserBrowseUrl : '<?php echo base_url("public/ckfinder/ckfinder.html");?>',
        filebrowserUploadUrl : '<?php echo base_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files");?>',
        filebrowserImageUploadUrl : '<?php echo base_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images");?>',
        filebrowserFlashUploadUrl : '<?php echo base_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash");?>'
		
    });
};
function confirmdel(id,field){
	if(confirm("Are you sure want to delete image?")){
		window.location.href="<?php echo site_url("kaizen/theme_rooms/dodeleteimg/");?>?deleteid="+id+"&field="+field;
	}
	else{
		return false;
	}
}

</script>
<style type="text/css">
#bar1 {
	background-color:#5fbbde;
	width:0px;
	height:16px;
}
#barbox1 {
	float:right;
	height:16px;
	background-color:#FFFFFF;
	width:100px;
	border:solid 1px #000;
	margin-right:3px;
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
}
#count1 {
	float:right;
	margin-right:8px;
	font-family:'Georgia', Times New Roman, Times, serif;
	font-size:11px;
	font-weight:bold;
	color:#666666
}
#bar2 {
	background-color:#5fbbde;
	width:0px;
	height:16px;
}
#barbox2 {
	float:right;
	height:16px;
	background-color:#FFFFFF;
	width:100px;
	border:solid 1px #000;
	margin-right:3px;
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
}
#count2 {
	float:right;
	margin-right:8px;
	font-family:'Georgia', Times New Roman, Times, serif;
	font-size:11px;
	font-weight:bold;
	color:#666666
}
#bar3 {
	background-color:#5fbbde;
	width:0px;
	height:16px;
}
#barbox3 {
	float:right;
	height:16px;
	background-color:#FFFFFF;
	width:100px;
	border:solid 1px #000;
	margin-right:3px;
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
}
#count3 {
	float:right;
	margin-right:8px;
	font-family:'Georgia', Times New Roman, Times, serif;
	font-size:11px;
	font-weight:bold;
	color:#666666
}
</style>
