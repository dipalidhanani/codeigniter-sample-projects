<?php 
	if(isset($details->title)){echo '<h3>'.$details->title.'</h3>';}
	else{echo '<h3>Add New Page</h3>';}
	?>

<br />
<?php 
		  $attributes = array('name' => 'cont', 'id' => 'cont');
		  echo form_open_multipart('kaizen/other_cms/addedit',$attributes);
		  //echo form_hidden('cms_id', $details->id);
		  ?>
		  <input type="hidden" name="cms_id" id="cms_id" value="<?php echo $details->id; ?>">
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
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="midtable">
	<!--<tr>
		<td align="left" valign="top" height="5"></td>
	</tr>-->
	<?php if($details->id>0 ) { ?>
	<div class="single-column" >
    	<label class="question-label">Page Link:</label>
		<?php 
					$page_array=array('services','home','projects');
					if(!in_array($details->page_link,$page_array))
					{
						echo base_url("pages/".$details->page_link);
					}
					else
					{
						$page_array2=array('home');
						if(!in_array($details->page_link,$page_array2))
						{
							echo base_url($details->page_link);
						}
						else
						{
							echo base_url();
						}
					}
				?>
                </div>
	<?php } ?>
    <div class="single-column" >
	<?php 
		$new_parent_id = $this->input->get('parent_id', TRUE);
		if(!empty($new_parent_id)){$parent_id=$new_parent_id;}
		elseif(!empty($details->parent_id)){$parent_id=$details->parent_id;}else{$parent_id=0;}
		if(($parent_id>0) || $details->id==0 ) { ?>
		<label class="labelname">Select location:</label>
		<select name="parent_id" id="parent_id" style="width:268px;" tabindex="1">
					<option value=""  <?php echo ((!isset($details->parent_id))?'selected="selected"':'')?> >-TOP-</option>
							<?php 
					
					$OPT_MENU = '';
					$menus_array = array();
					foreach ($cms_list as $rs_menu_id){
					
					  $menus_array[$rs_menu_id->id] = array('id' => $rs_menu_id->id,'title' => $rs_menu_id->title,'parent_id' => $rs_menu_id->parent_id,'page_link' => $rs_menu_id->page_link);
					  }	
					
	    			$optmenu = generate_opt_menu(0,$menus_array, $OPT_MENU, 0,$parent_id);
					echo $optmenu;
					  ?>
						</select><?php
		  echo link_tag("public/css/dd.css")."\n";
		  ?>
			<script type="text/javascript" src="<?php echo base_url("public/js/jquery.dd.js");?>"></script>
			<script type="text/javascript">
            $(document).ready(function() {
            try {
                oHandler = $("#parent_id").msDropDown({mainCSS:'dd2'}).data("dd");
                //alert($.msDropDown.version);
                //$.msDropDown.create("body select");
                $("#ver").html($.msDropDown.version);
                } catch(e) {
                    alert("Error: "+e.message);
                }
            })
        </script>
	<?php  }else{
	echo form_hidden('parent_id', 0);}?>
    </div>
<!--	<tr>
	<tr>
		<td align="left" valign="top" height="5"></td>
	</tr>-->
	
    </div>
	<div class="single-column" >
                <label class="labelname">Enter Title : <span>*</span></label>
                        <input type="text" name="page_title" id="page_title" value="<?php if(isset($details->title)){echo $details->title;}?>" class="inputinpt validate[required]" />
	</div>
	<?php if(!empty($details->page_link) && ($details->page_link =='staff-members')){
	?>
        <div class="single-column" >
            <label class="labelname">Testimonial Name : <span>*</span></label>
            <input type="text" name="test_name" id="test_name" value="<?php if(isset($details->test_name)){echo $details->test_name;}?>" class="inputinpt validate[required]" />
        </div>
        <div class="single-column" >
            <label class="labelname">Testimonial Content : <span>*</span></label>
            <input type="text" name="test_cont" id="test_cont" value="<?php if(isset($details->test_cont)){echo $details->test_cont;}?>" class="inputinpt validate[required]" />
        </div>
	
	<?php } ?>
	<div class="single-column"style="display:none">
        <label class="labelname">Position:</label>
        <input type="text" name="display_order" id="display_order" value="<?php if(isset($details->display_order)){echo $details->display_order;}?>" class="inputinpt" />
	</div>
    <div class="single-column cont-banner-upload" >
    <label class="labelname">Featured Image:</label>
    
    <div class="inputBtnSection">
                    <input id="fakefilepc1" class="disableInputField" placeholder="No File chosen" disabled="disabled" name="newsletterfile" />
                    <label class="fileUpload">
                        <input id="uploadBtn1" type="file" class="upload" name="htmlfile" onchange="document.getElementById('fakefilepc1').value = this.value;" />
                        <span class="uploadBtn">Browse</span>
                    </label>

    </div>
            <span class="upload-size">Size requirement 2000 x 373 pixels</span>
            
	<?php						
	if(!empty($details->banner_photo))
	{						
	?>
	<label class="labelname">&nbsp;</label>
				<img src="<?php echo file_upload_base_url()."other_cmspages/".$details->banner_photo;?>" width="200"  alt="" />
				<label class="labelname">&nbsp;</label>
				<a href="javascript:void(0);" title="Remove" onclick="imagedelete('<?php echo $details->id;?>','banner_photo','other_cms_pages','other_cmspages');" class="removebtn" >Remove</a>
	<?php
		}
	?>
    </div>
    
    <div class="single-column">
    	<label class="question-label">Banner Description: </label>
        <textarea id="banner_text" name="banner_text" class="editor"><?php if(isset($details->banner_text)){echo outputEscapeString($details->banner_text);}?>
</textarea>
 	</div>

	<?php if(!empty($details->page_link) && ($details->page_link =='about-us')){
	?>
    <div class="single-column" ><label class="labelname">Featured Image:</label></div>
    <div style="overflow:hidden; margin-bottom: 22px;">
        <div class="formFields">
            <div style="width:350px;" class="fileinputs">
                <input type="file" class="file" name="htmlfile4" onchange="document.getElementById('fakefilepc3').value = this.value;" />
                <div class="fakefile">
                    <input id="fakefilepc3" type="text" disabled="disabled" name="newsletterfile" />
					<img src="<?php echo base_url("public/images/browsebtn.jpg");?>" alt="" height="31" width="84" onmouseover="this.src='<?php echo base_url("public/images/browsebtn-ho.jpg");?>'" onmouseout="this.src='<?php echo base_url("public/images/browsebtn.jpg");?>'" />
                </div>
            </div>
        </div>

        <div style="clear: both;"></div>
        <p class="sizetxt">Size Requirement: 84 x 111 pixels</p>
   </div>

	<?php						
					if(!empty($details->featured_photo)){						
					?>
            <div class="single-column">
                <label class="question-label">&nbsp;</label>
               <img src="<?php echo file_upload_base_url()."other_cmspages/".$details->featured_photo;?>"  alt="" />
            </div>
            <div class="single-column">
                <label class="question-label">&nbsp;</label>
                <a href="javascript:void(0);" title="Remove" onclick="confirmdel_featured_photo('<?php echo $details->id;?>');" class="removebtn" >Remove</a>
            </div>
            <?php
					}
					?>

	<div class="single-column" ><label class="labelname">Upload File:</label></div>
    <div style="overflow:hidden; margin-bottom: 22px;">
        <div class="formFields">
            <div style="width:350px;" class="fileinputs">
                <input type="file" class="file" name="htmlfile2" onchange="document.getElementById('fakefilepc2').value = this.value;" />
                <div class="fakefile">
                    <input id="fakefilepc3" type="text" disabled="disabled" name="newsletterfile" />
					<input id="fakefilepc2" type="text" disabled="disabled" name="newsletterfile" />
									<img src="<?php echo base_url("public/images/browsebtn.jpg");?>" alt="" height="31" width="84" onmouseover="this.src='<?php echo base_url("public/images/browsebtn-ho.jpg");?>'" onmouseout="this.src='<?php echo base_url("public/images/browsebtn.jpg");?>'" /> 
                </div>
            </div>
        </div>
        <!--<p class="sizetxt">Size Requirement: 84 x 111 pixels</p>-->
   </div>
        
	<?php						
					if(!empty($details->banner_file)){						
					?>
            <div class="single-column">
                <label class="question-label">&nbsp;</label>
                <a href='<?php echo file_upload_base_url()."other_cmspages/".$details->banner_file;?>'>View File</a>
                <label class="question-label">&nbsp;</label>
                <a href="javascript:void(0);" title="Remove" onclick="confirmdel_banner_file('<?php echo $details->id;?>');" class="removebtn" >Remove</a>
            </div>
	
	<?php
					}
					?>
    <div class="single-column">
        <label class="labelname">Upload Button Title : <span>*</span></label>
        <input type="text" name="title1" id="title1" value="<?php if(isset($details->title1)){echo $details->title1;}?>" class="inputinpt validate[required]" />
    </div>
    <div class="single-column">
        <label class="labelname">Featured Content:</label>
        <?php
				if(!empty($draft_content->contents1)){
					$dcont_txt = $draft_content->contents1;
				}
				else{
					$dcont_txt ='';
				}
				if(!empty($details->content1)){
					$cont_txt = $details->content1;
				}
				else{
					$cont_txt = "";
				}?>
			<textarea id="contents1" name="contents1" class="editor"><?php echo ($cont_txt);?></textarea>
    </div>
	<?php
	
	} ?>
    <div class="single-column" tyle="display:none;" >
        <label class="labelname">Banner URL:</label>
        <input type="text" name="banner_url" id="banner_url" value="<?php if(isset($details->banner_url)){echo $details->banner_url;}?>" class="inputinpt validate[optional,custom[url]]" />
    </div>
	
	<div class="single-column" tyle="display:none;" >
        <label class="labelname">Banner Link Title:</label>
        <input type="text" name="banner_link_title" id="banner_link_title" value="<?php if(isset($details->banner_link_title)){echo $details->banner_link_title;}?>" class="inputinpt" />
	</div>
	
    <div class="single-column" <?php  if(!empty($details->id) && $details->id==1){ ?>style="display:none"<?php } ?>>
        <label class="labelname">Content:</label>
        <?php
				if(!empty($draft_content->contents)){
					$dcont_txt = $draft_content->contents;
				}
				else{
					$dcont_txt ='';
				}
				if(!empty($details->content)){
					$cont_txt = $details->content;
				}
				else{
					$cont_txt = "";
				}?>
			<textarea id="contents" name="contents" class="editor"><?php echo ($cont_txt);?></textarea>
    </div>
	 <div class="single-column" >
            <label class="question-label">Status </label>
            <input type="radio" name="is_active" id="is_active" value="1" 
 <?php echo ((isset($details->is_active) && $details->is_active ==1)?'checked="checked"':'')?>/>
                                                                                                       &nbsp;Active &nbsp;&nbsp;
                                                                                                       <input type="radio" name="is_active" id="is_active_1" value="0" <?php echo ((isset($details->is_active) && $details->is_active ==0)?'checked="checked"':'')?> />
                                                                                                       &nbsp;Inactive &nbsp;&nbsp; 
        </div>
</table>
<br />
<div class="single-column" >
		<?php
		if(!empty($details->id) ){
		?>
		<a href="javascript:void(0);" class="web-yellow-btn" onclick="openpage('<?php echo base_url("other_cms/doeditajax/".$details->id);?>')"><span>Cancel</span></a>
        <!--<a href="javascript:void(0);" class="web-green-btn">
		<input name="is_active" type="checkbox" value="0" <?php if(empty($details->is_active)){echo 'checked="checked"';}?> class="chkbox" onclick="setPublish('<?php echo $details->id;?>');" id="publish"/>
		<span>Hide</span></a>-->
         <a href="javascript:void(0);" class="web-red-btn" onclick="rowdelete('<?php echo $details->id; ?>','other_cms_pages');"><span>Delete</span></a>
		<div id="publish_msg" style="display:none;color:green;"></div>
		<?php
		}
		else{echo form_hidden('is_active', 1);}
		?>
	
	
		<?php 
		if(empty($draft_content) && !empty($details->id)){
		?>
		<!--<a href="javascript:void(0);" class="darkgreybtn" onclick="form_submit('draft');" <?php if($details->id == 10 || $details->id == 14){echo 'style="display:none"';}?>><span> Save Draft </span></a>-->
		<?php
		}
		elseif(!empty($details->id)){
		?>
		<!--<span id="showdraft_content"> <a href="javascript:void(0);" class="web-blue-btn" onclick="showdraft_content2();"><span>Edit Draft</span></a> </span>-->
		<?php
		}
		?>
		<?php
		if(!empty($details->id)){
		?>
		<!--<a href="javascript:void(0);" class="darkgreybtn" onclick="previewget('<?php echo $details->id;?>');"  ><span>Preview</span></a>-->
		<?php
		}
		?>
		<a href="javascript:void(0);" class="web-gray-btn" onclick="form_submit('publish');"><span>Publish</span></a> </div>
</div>
<!--seo panel -->
<div class="seopan">
	<h2><a href="javascript:void(0);" onclick="javascript:showseopanel('droplistseo');" class="expandable">SEO</a></h2>
	<div class="droplists" id="droplistseo">
		<table width="512" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="135" align="left" valign="top">Meta Title:</td>
				<td width="349" align="left" valign="top"><input name="meta_title" id="meta_title" type="text" value="<?php if(isset($details->meta_title)){echo $details->meta_title;}?>" class="titlefiled" onkeyup="checkcharcount('meta_title','count1','bar1',72);"/>
					<div id="barbox1">
						<div id="bar1"></div>
					</div>
					<div id="count1">72</div>
					<p class="chartxt"> Character Limit</p>
					<div class="showhide1" style="display:none;">
						<div class="seoimgdiv" style="top:57px;"> <a href="#" class="cross close"><img src="<?php echo base_url("public/images/cross-butt.jpg");?>" alt="" /></a>
							<h2>Meta Title</h2>
							<p> - Page titles should be descriptive and concise<br />
								- Avoid keyword stuffing<br />
								- Avoid repeated or boilerplate titles<br />
								- Brand your titles, but concisely <br />
							</p>
						</div>
					</div></td>
				<td width="28" align="right" valign="top"><a href="javaScript:void(0);" onmouseover="showdiv(1)" onmouseout="hidediv(1);" class="newshow_hide"><img src="<?php echo base_url("public/images/q-icon.jpg");?>" alt="" width="22" height="22" /></a></td>
			</tr>
			<tr style="display:none;">
				<td align="left" valign="top">Meta Keyword:</td>
				<td align="left" valign="top"><textarea name="meta_keyword" id="meta_keyword" class="description"><?php if(isset($details->meta_keyword)){echo html_entity_decode(stripslashes($details->meta_keyword), ENT_QUOTES,'UTF-8');}?>
</textarea>
					<div id="barbox2">
						<div id="bar2"></div>
					</div>
					<div id="count2">200</div>
					<p class="chartxt" style="float:left;">Character Limit</p>
					<div class="showhide2" style="display:none;">
						<div class="seoimgdiv" style="top:107px;"> <a href="#" class="cross close"><img src="<?php echo base_url("public/images/cross-butt.jpg");?>" alt="" /></a>
							<h2>SEO Heading</h2>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
						</div>
					</div></td>
				<td align="right" valign="top"><a href="javaScript:void(0);" onmouseover="showdiv(2)" onmouseout="hidediv(2);" class="newshow_hide"><img src="<?php echo base_url("public/images/q-icon.jpg");?>" alt="" width="22" height="22" /></a></td>
			</tr>
			<tr>
				<td align="left" valign="top">Meta Description:</td>
				<td align="left" valign="top"><textarea name="meta_desc" id="meta_desc" class="description" onkeyup="checkcharcount('meta_desc','count3','bar3',200);"><?php if(isset($details->meta_description)){echo html_entity_decode(stripslashes($details->meta_description), ENT_QUOTES,'UTF-8');}?>
</textarea>
					<div id="barbox3">
						<div id="bar3"></div>
					</div>
					<div id="count3">200</div>
					<p class="chartxt" style="float:left;">Character Limit</p>
					<div class="showhide3" style="display:none;">
						<div class="seoimgdiv" style="top:107px;"> <a href="#" class="cross close"><img src="<?php echo base_url("public/images/cross-butt.jpg");?>" alt="" /></a>
							<h2>Meta Description</h2>
							<p> - This will only be shown in search results if the search engine can not come up with a better description.<br />
								- Differentiate the descriptions for different pages. Identical or similar descriptions on every page of a site aren't helpful when individual pages appear in the web results.<br />
								- Use quality descriptions.<br />
							</p>
						</div>
					</div></td>
				<td align="right" valign="top"><a href="javaScript:void(0);" onmouseover="showdiv(3)" onmouseout="hidediv(3);" class="newshow_hide"><img src="<?php echo base_url("public/images/q-icon.jpg");?>" alt="" width="22" height="22" /></a></td>
			</tr>
		</table>
		<?php echo form_hidden("sbmt","1");?> </div>
</div>
<!--seo panel -->
<input type="hidden" name="content" id="content" value="" />
<input type="hidden" name="content1" id="content1" value="" />
<input type="hidden" name="save_draft" id="save_draft" value="0" />
<?php echo form_close();?>
<script type="text/javascript">
	var editor, html = '';
	if (editor ){
   	editor.destroy();
	editor = null;
	}
	


    CKEDITOR.replace( 'contents' ,{
		contentsCss : '<?php echo base_url("public/css/style_ck.css");?>',	
		 filebrowserBrowseUrl : '<?php echo base_url("public/ckfinder/ckfinder.html");?>',
        filebrowserUploadUrl : '<?php echo base_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files");?>',
        filebrowserImageUploadUrl : '<?php echo base_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images");?>',
        filebrowserFlashUploadUrl : '<?php echo base_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash");?>'
		}
	);
<?php if(!empty($details->page_link) && ($details->page_link =='about-us')){
	?>
    CKEDITOR.replace( 'contents1' ,{
		contentsCss : '<?php echo base_url("public/css/style_ck.css");?>',	
		 filebrowserBrowseUrl : '<?php echo base_url("public/ckfinder/ckfinder.html");?>',
        filebrowserUploadUrl : '<?php echo base_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files");?>',
        filebrowserImageUploadUrl : '<?php echo base_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images");?>',
        filebrowserFlashUploadUrl : '<?php echo base_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash");?>'
		}
	);
<?php } ?>


function form_submit2(val){
if(confirm("Are you sure want to delete?")){
			window.location.href="<?php echo base_url("other_cms/dodelete/");?>?deleteid="+val+"&ref=<?php echo base_url("other_cms/");?>";
		}
		else{
			return false;
		}
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
checkcharcount('meta_keyword','count2','bar2',200);
checkcharcount('meta_desc','count3','bar3',200);

$("#cont").validationEngine();

function showdraft_content2(){
	$("#showdraft_content").html(' <a href="javascript:void(0);" class="darkgreybtn" onclick="form_submit(\'draft\');"><span>Save Draft</span></a>');
	CKEDITOR.instances.contents.setData( '<?php echo addslashes(str_replace("\n","",outputEscapeString($dcont_txt)));?>' );
	
}
function confirmdelGallery(event_id,gallery_id){
	if(confirm("Are you sure want to delete image?")){
		window.location.href="<?php echo base_url("other_cms/dodeleteimggallery/");?>?deleteid="+gallery_id+'&event_id='+event_id;
	}
	else{
		return false;
	}
}

$(document).ready(function() { 
	// bind 'myForm' and provide a simple callback function 
	$('#cont').ajaxForm(function() {
		<?php
			if(empty($details->id)){
			?>
			window.location.href='<?php echo base_url('kaizen/other_cms/doadd/0/');?>';
			<?php
			}
			else{
			?>
			openpage('<?php echo base_url("kaizen/other_cms/doeditajax/".$details->id);?>');
			<?php
			}
			?>
	}); 
}); 
function confirmdel_banner_file(id){
	if(confirm("Are you sure want to delete image?")){
		window.location.href="<?php echo base_url("kaizen/other_cms/dodeleteimg_banner_file/");?>?deleteid="+id;
	}
	else{
		return false;
	}
}

function confirmdel_featured_photo(id){
	if(confirm("Are you sure want to delete image?")){
		window.location.href="<?php echo base_url("kaizen/other_cms/dodeleteimg_featured_photo/");?>?deleteid="+id;
	}
	else{
		return false;
	}
}
</script>
