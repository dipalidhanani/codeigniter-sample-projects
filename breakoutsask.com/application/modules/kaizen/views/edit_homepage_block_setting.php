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
		window.location.href="<?php echo site_url("kaizen/homepage_block_setting/dodelete/");?>?deleteid="+id;
	}
	else{
		return false;
	}
}

function fun_showhideabout(){
	
	if(document.getElementById('block_section_no').value == '1'){
		document.getElementById('divabout').style.display = '';
		}
		else{document.getElementById('divabout').style.display = 'none';}
	
	}

</script>
<div class="rightDiv">
  <div class="right-outer">
    <div class="right-outer">
      <h3 class="title">Homepage</h3>
      <div class="bread-crumb">
        <ul>
          <li>
          <li><a href="<?php echo base_url("kaizen/homepage_block_setting/doadd/0/");?>"> Block Settings</a></li>
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
		  echo form_open_multipart('kaizen/homepage_block_setting/addedit/'.$details->id,$attributes);
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
                <label>Title <span>*</span></label>
                <input type="text" name="title" id="title" value="<?php if(isset($details->title)){echo $details->title;}?>" class="inputinpt validate[required]" />
              </div>
            
          	 <div class="single-column">
                <label>Description</label>
               <textarea id="description" name="description"><?php if(!empty($details->description)){echo outputEscapeString($details->description);}?></textarea>
              </div>
              
              <div class="single-column">
                <label>Assign Section<span>*</span></label>
               <select name="block_section_no" id="block_section_no" class="validate[required]" onchange="fun_showhideabout();">
               <option value="">Select section</option>
               <option value="1" <?php if(isset($details->block_section_no) && $details->block_section_no == '1'){echo "selected";} ?> <?php if($totalsection1 > 0 && $details->block_section_no != '1'){echo "disabled";} ?>>Section 1 - About</option>
               <option value="2" <?php if(isset($details->block_section_no) && $details->block_section_no == '2'){echo "selected";} ?> <?php if($totalsection2 > 0 && $details->block_section_no != '2'){echo "disabled";} ?>>Section 2 - Call to action</option>
               <option value="3" <?php if(isset($details->block_section_no) && $details->block_section_no == '3'){echo "selected";} ?> <?php if($totalsection3 > 0 && $details->block_section_no != '3'){echo "disabled";} ?>>Section 3 - Recent Blogs</option>
               <option value="4" <?php if(isset($details->block_section_no) && $details->block_section_no == '4'){echo "selected";} ?> <?php if($totalsection4 > 0 && $details->block_section_no != '4'){echo "disabled";} ?>>Section 4 - Contact</option>
               </select>
              </div>
              
              <?php if($details->block_section_no == '1')
					 {
						  $dis_btn = '';
					 }
				  else{ $dis_btn = 'none';}
				  
				   ?>
              
              <div class="single-column" id="divabout" style="display:<?php echo $dis_btn; ?>">
                <label>About - "Read More" Button Link <span>*</span></label>
                <input type="text" name="about_read_more_link" id="about_read_more_link" value="<?php if(isset($details->about_read_more_link)){echo $details->about_read_more_link;}?>" />
              </div>
              
           
              
               <div class="single-column">
                <label>Upload Background Image</label>
               <div class="formFields">
							<div >
								<input type="file" class="file" name="htmlfile" id="htmlfile" onchange="document.getElementById('fakefilepc1').value = this.value;" />
							
							</div>
						</div>
						<div class="spacer"></div>
						<p class="sizetxt" >Size Requirement:  2000 x 1490 pixels</p>
                      
              </div>
              
              
            	   <?php						
					if(!empty($details->block_background_image))
					{						
					?>
					<div class="single-column">
								<label>&nbsp;</label>
							  <img src="<?php echo file_upload_base_url()."homepage_background_image/"."bg_".$details->block_background_image;?>" width="150" />
							  </div>
					<div class="single-column">
								<label>&nbsp;</label>
							 <a href="javascript:void(0);" title="Remove" onclick="confirmdel('<?php echo $details->id;?>','block_background_image');" class="removebtn" >Remove</a>
							  </div>
					<?php
					}
					?>             
               
           
				<div class="single-column">
                <label>Status:</label>
                &nbsp;<input type="radio" name="block_status" id="block_status" value="Active" <?php if(isset($details->block_status) && $details->block_status == 'Active'){echo "checked";}else if($details->id == 0){echo "checked";} ?> /> Active
                &nbsp;<input type="radio" name="block_status" id="block_status" value="Inactive" <?php if(isset($details->block_status) && $details->block_status == 'Inactive'){echo "checked";} ?> /> Inactive
                </div>
	
	
                    
                    
           <a href="javascript:void(0);" title="Delete" onClick="confirmdel_post('<?php echo $details->id;?>','<?php echo rawurlencode(base_url("kaizen/homepage_block_setting"));?>');" class="delete-red-btn" <?php if(isset($details->id) && $details->id >0){}else{echo 'style="display:none;"';}?>> <span>Delete</span> </a> 
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
              <a href="<?php echo site_url("kaizen/homepage_block_setting/");?>" class="temp-btn orange-btn">Cancel</a>
               <a  href="<?php echo site_url("kaizen/homepage_slider/");?>" class="temp-btn " >Sliding Image and Video Banner</a>
              <a href="<?php echo site_url("kaizen/homepage_component/");?>" class="temp-btn">Featured Blocks (About us & Call to action)</a>
			<a href="<?php echo site_url("kaizen/homepage_block_setting/");?>" class="temp-btn">Homepage Block Settings</a>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view($copyright); ?>
      
    </div>
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
		window.location.href="<?php echo site_url("kaizen/homepage_block_setting/dodeleteimg/");?>?deleteid="+id+"&field="+field;
	}
	else{
		return false;
	}
}
$(function() {
        $("#MoveRight,#MoveLeft").click(function(event) {
            var id = $(event.target).attr("id");
            var selectFrom = id == "MoveRight" ? "#cat_id" : "#selected_cat_id";
            var moveTo = id == "MoveRight" ? "#selected_cat_id" : "#cat_id";
            var selectedItems = $(selectFrom + " :selected").toArray();
            $(moveTo).append(selectedItems);
           
        });
    });

function showdiv(id){
	$('.showhide'+id).fadeIn('slow');
}
function hidediv(id){
	$('.showhide'+id).fadeOut('slow');
}
function showseopanel(){
	$('.droplists').slideToggle('slow');
	
}
function checkcharcount(id,id2,id3,id4){
	var box=$("#"+id).val();
	var main = box.length *100;
	var value= (main / id4);
	var count= id4 - box.length;
	if(box.length <= id4){
		$('#'+id2).html(count);
		$('#'+id3).animate({"width": value+'%',}, 1);
	}
	else{
		$(this).attr('maxlength',id4);
		$('#'+id).maxlength({max:id4});
	}
	return true;
}
checkcharcount('meta_title','count1','bar1',72);
/*checkcharcount('meta_keyword','count2','bar2',200);*/
checkcharcount('meta_desc','count3','bar3',200);
	
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
