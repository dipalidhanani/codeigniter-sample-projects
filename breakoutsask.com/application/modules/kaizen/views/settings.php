<?php $this->load->view($header); ?>
<?php echo $this->load->view($left); ?>
<?php 
//$this->load->view($left); 
echo link_tag("public/validator/css/validationEngine.jquery.css")."\n";
?>

<script src="<?php echo base_url("public/validator/js/languages/jquery.validationEngine-en.js");?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url("public/validator/js/jquery.validationEngine.js");?>" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
$(document).ready(function(){
	checkcharcount('meta_title','count1','bar1',72);
	checkcharcount('meta_keyword','count2','bar2',200);
	checkcharcount('meta_desc','count3','bar3',200);
	$("#cont").validationEngine();
});	

function form_submit()
{
	$('#cont').submit();
	return true;
}

</script>
<style>
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
<script>
function addAnotherFile(url,predifine_link,sequence,social_settings_id){
	var count = $('#count').val();
	var count_val = parseInt(count)+1;
	$('#count').val(count_val);
	$.ajax({
			   type: "POST",
				url : '<?php echo site_url("kaizen/settings/add_file/");?>',
				data: { count:count,url:url,predifine_link:predifine_link,social_settings_id:social_settings_id,sequence:sequence},
				dataType : "html",
				success: function(data)
				{
					if(data)
					{
						
							$("#socialdiv").prepend(data);
						
						
					}
					else
					{
						//alert("Sorry, Some problem is there. Please try again.");
					}
				},
				error : function() 
				{
		
					alert("Sorry, The requested property could not be found.");		
				}
			});
}

$(document).ready(function(){

   $(".slidingDiv").hide();
   $(".show_hide").show();

   $('.show_hide').toggle(function(){
       $("#plus").text("- change Password");
       $(".slidingDiv").slideDown();
       
   },function(){
       $("#plus").text("+ change Password");
       $(".slidingDiv").slideUp();
   });
    
});
</script>
<div class="rightDiv">
	<div class="right-outer">
            
	            
    	<div class="clear"></div>
      <h3 class="title">Website Setting</h3><div class="bread-crumb"><ul><li>Edit Setting Details</li></ul></div>
      
      <?php 
		  $attributes = array('name' => 'cont', 'id' => 'cont');
		  echo form_open_multipart('kaizen/settings/save',$attributes);
		  //echo form_hidden('cms_id', $details->id);
		  
		  ?>
      <?php
		if($this->session->userdata('ERROR_MSG')==TRUE){
			echo '<div class="notific_error">
					<h2 align="center" style="color: #009900;">'.$this->session->userdata('ERROR_MSG').'</h1></div>';
			$this->session->unset_userdata('ERROR_MSG');
		}
		if($this->session->userdata('SUCC_MSG')==TRUE){
			echo '<div class="notific_suc"><h2 align="center" style="color: #009900;">'.$this->session->userdata('SUCC_MSG').'</h1></div>';
			$this->session->unset_userdata('SUCC_MSG');
		}
		?>
        <div class="clear"></div>
        
      <?php echo validation_errors('<div class="notific_error">', '</div>'); ?>
        <div class="padbot40">
            <div id="webcont-form">
        		<div id="member-form" class="midarea"> 
        	<div class="mid-block">
                    <div class="mid-content noBotPadd">
                    <div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Site Name: *</label>
                                <input type="text" name="site_name" id="site_name" value="<?php if(isset($details->site_name)){echo $details->site_name;}?>" class="validate[required]" />
                            </li>
                        </ul>
                    </div>
                    
                    
                    <!--<div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Phone Number: *</label>
                                <input type="text" name="phone" id="phone" value="<?php if(isset($details->phone)){echo $details->phone;}?>" class="validate[required]" />
                            </li>
                        </ul>
                    </div>-->
                    
                    <div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Site URL: *</label>
                                <input type="text" name="url" id="url" value="<?php if(isset($details->url)){echo $details->url;}?>" class="validate[required, custom[url]]" />
                            </li>
                        </ul>
                    </div>
                    
                    <div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Copy Right: *</label>
                                <input type="text" name="copy_right" id="copy_right" value="<?php if(isset($details->copy_right)){echo $details->copy_right;}?>" class="validate[required]" />
                            </li>
                        </ul>
                    </div>
                    
                    
                    <!--<div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Email: *</label>
                                <input type="text" name="email" id="email" value="<?php if(isset($details->email)){echo $details->email;}?>" class="validate[required,custom[email]]" />
                            </li>
                        </ul>
                    </div>
                        
                    <div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Address:</label>
                                <textarea class="validate[required]" id="address" name="address"><?php if(isset($details->address)){echo $details->address;}?></textarea>
                            </li>
                        </ul>
                    </div>-->
                    
                    <div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label><span>Header Logo Upload</span></label>
                                <div class="image-upload">
                                    <div class="inputBtnSection">
                                        <input id="uploadFile1" class="disableInputField" disabled="disabled" style="width:83%" />
                                        <label class="fileUpload">
                                            <input id="htmlfile1" type="file" class="upload" name="htmlfile1" onChange="document.getElementById('uploadFile1').value = this.value;" />
                                            <span class="uploadBtn">Browse</span>
                                        </label>
                                    </div>
                                </div>
                                <p class="sizetxt">Size Requirement: 271px X 57px pixels</p>
                            </li>
                        </ul>
                        <?php if(!empty($details->logo_photo)){ ?>
                        <?php if($details->logo_photo!='' && is_file(file_upload_absolute_path()."setting_photo/".$details->logo_photo))	
                                                                {
                                                                    $logo_photo1 = substr_replace($details->logo_photo,'_thumb',-4,0);
                                                                    $logo_photo1=file_upload_base_url()."setting_photo/".$details->logo_photo;

                                                                }
                                                                else
                                                                {
                                                                    $logo_photo1=file_upload_base_url()."noimage_thumb.jpg";
                                                                }?>
                  <img src="<?php echo $logo_photo1;?>" style="background:black;" width="271" />
                  
                        <a href="javascript:void(0);" title="Remove" onClick="imagedelete('<?php echo $details->id;?>','logo_photo','site_settings','setting_photo');" class="removebtn" >Remove</a>
                        <?php } ?>
                    </div>
                    <h4><a href="#" class="show_hide" id="plus">+ change Password</a></h4>
                    
                    <div class="setting-single-block slidingDiv">
							
                             <?php
								if($this->session->userdata('ERROR_MSG')==TRUE){
									echo '<div class="notific_error">
											<h2 align="center" style="color: #009900;">'.$this->session->userdata('ERROR_MSG').'</h1></div>';
									$this->session->unset_userdata('ERROR_MSG');
								}
								if($this->session->userdata('SUCCESS_MSG')==TRUE){
									echo '<div class="notific_suc"><h2 align="center" style="color: #009900;">'.$this->session->userdata('SUCCESS_MSG').'</h1></div>';
									$this->session->unset_userdata('SUCCESS_MSG');
								} ?>
                            
                            <div class="single-column setting-short-form">
								<label>Old Password:</label>
								<input type="password" name="old_pwd" id="old_pwd">
							</div>
							
							<div class="single-column setting-short-form">
								<label>New Password:</label>
								<input type="password" name="new_pwd" id="new_pwd">
							</div>
							
							<div class="single-column setting-short-form">
								<label>Repeat Password:</label>
								<input type="password" name="repeat_pwd" id="repeat_pwd" >
							</div>
							
							<div class="single-column setting-short-form">
							<input type="submit" value="Reset Password" name="reset" class="gray-btn">							
							</div>
							
						</div>
                        
                   <div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Header - "Book Online" Button Link: *</label>
                                <input type="text" name="book_online_link" id="book_online_link" value="<?php if(isset($details->book_online_link)){echo $details->book_online_link;}?>"  />
                            </li>
                        </ul>
                    </div>
                        
                    <!--<div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Facebook Link:</label>
                                <input type="text" name="fb_link" id="fb_link" value="<?php if(isset($details->fb_link)){echo $details->fb_link;}?>" class="validate[optional,custom[url]]" />
                            </li>
                        </ul>
                    </div>
                    <div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Twitter Link:</label>
                                <input type="text" name="twitter_link" id="twitter_link" value="<?php if(isset($details->twitter_link)){echo $details->twitter_link;}?>" class="validate[optional,custom[url]]" />
                            </li>
                        </ul>
                    </div>
                    <div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Linkedin Link:</label>
                                <input type="text" name="linkedin_link" id="linkedin_link" value="<?php if(isset($details->linkedin_link)){echo $details->linkedin_link;}?>" class="validate[optional,custom[url]]" />
                            </li>
                        </ul>
                    </div>
                    <div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Google+ Link:</label>
                                <input type="text" name="google_link" id="google_link" value="<?php if(isset($details->google_link)){echo $details->google_link;}?>" class="validate[optional,custom[url]]" />
                            </li>
                        </ul>
                    </div>
                    <div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Youtube Link:</label>
                                <input type="text" name="youtube_link" id="youtube_link" value="<?php if(isset($details->youtube_link)){echo $details->youtube_link;}?>" class="validate[optional,custom[url]]" />
                            </li>
                        </ul>
                    </div>
                    <div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Pinterest Link:</label>
                                <input type="text" name="instagram_link" id="instagram_link" value="<?php if(isset($details->instagram_link)){echo $details->instagram_link;}?>" class="validate[optional,custom[url]]" />
                            </li>
                        </ul>
                    </div>
                    <div class="single-column">
                        <ul>
                            <li class="fullWidth">
                                <label class="labelname">Tumblr Link:</label>
                                <input type="text" name="tumblr_link" id="tumblr_link" value="<?php if(isset($details->tumblr_link)){echo $details->tumblr_link;}?>" class="validate[optional,custom[url]]" />
                            </li>
                        </ul>
                    </div>-->
                    
                    <!--Google Analytics panel -->
                    <div class="seopan">
                        <h2><a href="javascript:showseopanel('droplistseo');" class="expandable">Google Analytics</a></h2>
                        <div class="droplists" id="droplistseo" style="display:none;">
                            <div class="single-column">
                                <ul>
                                    <li class="fullWidth">
                                        <label class="labelname">Google Site Verification:</label>
                                        <input name="site_verification" id="site_verification" type="text" value="<?php if(isset($details->site_verification)){echo $details->site_verification;}?>" class="titlefiled"  />
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="single-column">
                                <ul>
                                    <li class="fullWidth">
                                        <label class="labelname">Google Analytics Code:</label>
                                        <textarea name="analytics_code" id="analytics_code" class="description"><?php if(isset($details->analytics_code)){echo html_entity_decode(stripslashes($details->analytics_code), ENT_QUOTES,'UTF-8');}?></textarea>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="single-column">
                                <ul>
                                    <li class="fullWidth">
                                        <label class="labelname">Profile ID:</label>
                                        <input name="profile_id" id="profile_id" type="text" value="<?php if(isset($details->profile_id)){echo $details->profile_id;}?>" class="titlefiled"  />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="seopan">
                        <h2><a href="javascript:showseopanel('droplistblog');" class="expandable">Blog Settings</a></h2>
                        <div class="droplists" id="droplistblog" style="display:none;">
                            
                            <div class="single-column" >
                                <label class="question-label">Show Comment</label>
                                <input type="checkbox" name="show_comment" id="show_comment" value="1" <?php if(isset($details->show_comment) && ($details->show_comment == 1)){ ?> checked <?php }?> class="inputinpt"  />
                            </div>
                            <div class="single-column" >
                                <label class="question-label">Comments Moderated?</label>
                                <input type="checkbox" name="comments_moderated" id="comments_moderated" value="1" <?php if(isset($details->comments_moderated) && ($details->comments_moderated == 1)){ ?> checked <?php }?> class="inputinpt"  />
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="seopan">
	<h2><a href="javascript:void(0);" onclick="javascript:showseopanel('droplistseopanel');" class="expandable">SEO</a></h2>
        <div class="droplists" id="droplistseopanel" style="display:none;">
                            <div class="single-column" >
                                <label class="question-label">Meta Title</label>
                                <input name="meta_title" id="meta_title" type="text" value="<?php if(isset($details->meta_title)){echo $details->meta_title;}?>" class="titlefiled" />
                            </div>
                            <div class="single-column" >
                                <label class="question-label">Meta Keyword</label>
                                <textarea name="meta_keyword" id="meta_keyword" class="description"><?php if(isset($details->meta_keyword)){echo html_entity_decode(stripslashes($details->meta_keyword), ENT_QUOTES,'UTF-8');}?>
</textarea>
                            </div>
                            <div class="single-column" >
                                <label class="question-label">Meta Description</label>
                                <textarea name="meta_desc" id="meta_desc" class="description" ><?php if(isset($details->meta_description)){echo html_entity_decode(stripslashes($details->meta_description), ENT_QUOTES,'UTF-8');}?>
</textarea>
                            </div>
		
		<?php echo form_hidden("sbmt","1");?> </div>
</div>
                            
                    
                    
                    <div class="seopan">
                        <h2><a href="javascript:showseopanel('droplistsocialmedia');" class="expandable">Social Media</a></h2>
                        <div class="droplists" id="droplistsocialmedia" style="display:none;">
                            <a onclick="addAnotherFile('','')" href="javascript:void(0);" class="temp-btn" style="width:15%"><img style="float: left;margin-top: 3px;margin-left: 10px;width: 22px;" src="http://www.motifmarketing-test.ca.php56-1.ord1-1.websitetestlink.com/public/images/plus-icon.png">Add Social Media</a>
                            
                            <input type="hidden" name="count" id="count" value="1" />	
                            
                            
                           
                            <div id="socialdiv">
                                
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    
                            
                        
                        <?php echo form_hidden("sbmt","1");?> </div>
                    
                    <!--Google Analytics panel -->
                    
                    
                    
                    
                    
        </div>
        
            <div class="rt-block">
                        <div class="rt-bg-block">
                            <div class="rt-column search-side">
                                <a class="temp-btn " href="javascript:void(0);" onclick="form_submit();" >Update</a>
                            </div>
                        </div>
                    </div>
        </div>
        </div>
        </div>
        <?php echo $this->load->view($copyright); ?>
        
          </div>
                    
             </div>
            
        
        
      
     <!--<a href="javascript:void(0);" class="darkgreybtn" onclick="form_submit();"><span>UPDATE</span></a> -->
      <input type="hidden" name="save_draft" id="save_draft" value="0" />
      <?php echo form_close();?> 
</div>
<script type="text/javascript">
  
function showdiv(id){
	$('.showhide'+id).fadeIn('slow');
}

function hidediv(id){
	$('.showhide'+id).fadeOut('slow');
}

function checkcharcount(id,id2,id3,id4){ /*
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
	return true;*/
}

function confirmdel(id,field){
	if(confirm("Are you sure want to delete image?")){
		window.location.href="<?php echo site_url("kaizen/settings/dodeleteimg/");?>?deleteid="+id+'&field='+field;
	}
	else{
		return false;
	}
}
<?php if(!empty($social_settings_arr)){ ?>
    <?php foreach($social_settings_arr as $ssa){ ?>
            addAnotherFile('<?php echo $ssa->link ; ?>','<?php echo $ssa->social_menus_id ; ?>','<?php echo $ssa->sequence ; ?>','<?php echo $ssa->id ; ?>');
    <?php } ?>
<?php } ?>
</script>
<?php //$this->load->view($footer); ?>
