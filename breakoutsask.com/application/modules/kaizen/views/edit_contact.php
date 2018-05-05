<?php $this->load->view($header); ?>
<?php $this->load->view($left); ?>
<script type="text/javascript" src="<?php echo site_url("public/ckeditor/ckeditor.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/ckeditor/adapters/jquery.js");?>"></script>
<link rel="stylesheet" href="<?php echo site_url("public/validator/css/validationEngine.jquery.css");?>" type="text/css"/>
<script src="<?php echo site_url("public/validator/js/languages/jquery.validationEngine-en.js");?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo site_url("public/validator/js/jquery.validationEngine.js");?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#cont").validationEngine();
	});
function form_submit(){
    $('#selected_id option').prop('selected', true);
$('#cont').submit();
}
function goto_page(){
document.location.href = "<?php echo site_url("kaizen/contact/");?>";
}
function confirmdel_contact(id,page){
	if(confirm("Are you sure want to delete?")){
		window.location.href="<?php echo site_url("kaizen/contact/dodelete/");?>?deleteid="+id+"&ref="+page;
	}
	else{
		return false;
	}
}
</script>
<div class="rightDiv">
	<div class="right-outer">
		<h3 class="title">Edit Contact</h3>
		
        <div class="clear"></div>
        <div class="mid-block padbot40">
	        <div class="mid-content web-cont-mid">
	            <div id="webcont-form">
        		<div id="member-form" class="midarea">
			<?php 
		  $attributes = array('name' => 'cont', 'id' => 'cont');
		  echo form_open_multipart('kaizen/contact/addedit/'.$details->id,$attributes);
		  echo form_hidden('contact_id', $details->id);
		  
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
                            <div class="single-column" >
                                    <label class="question-label">Enter Title  </label>
                                    <input type="text" name="contact_title" id="contact_title" value="<?php if(isset($details->title)){echo $details->title;}?>" class="inputinpt validate[required]" />
                            </div>
                            <div class="single-column" >
                                    <label class="question-label">First Name  </label>
                                    <input type="text" name="fname" id="fname" value="<?php if(isset($details->fname)){echo $details->fname;}?>" class="inputinpt " />
                            </div>
                            <div class="single-column" >
                                    <label class="question-label">Last Name  </label>
                                    <input type="text" name="lname" id="lname" value="<?php if(isset($details->lname)){echo $details->lname;}?>" class="inputinpt " />
                            </div>
                            <div class="single-column">
                            <label class="question-label">Address: </label>
                            <textarea id="address" name="address" class="editor"><?php if(isset($details->address)){echo outputEscapeString($details->address);}?></textarea>
                        </div>
                            <div class="single-column" >
                                    <label class="question-label">Phone  </label>
                                    <input type="text" name="phone" id="phone" value="<?php if(isset($details->phone)){echo $details->phone;}?>" class="inputinpt " />
                            </div>
                    <div class="single-column" >
                                    <label class="question-label">Email  </label>
                                    <input type="text" name="email" id="email" value="<?php if(isset($details->email)){echo $details->email;}?>" class="inputinpt " />
                            </div>
                            <div class="single-column" >
                                    <label class="question-label">Fax  </label>
                                    <input type="text" name="fax" id="fax" value="<?php if(isset($details->fax)){echo $details->fax;}?>" class="inputinpt " />
                            </div>
                            <div class="single-column" >
                                    <label class="question-label">Latitude  </label>
                                    <input type="text" name="latitude" id="latitude" value="<?php if(isset($details->latitude)){echo $details->latitude;}?>" class="inputinpt validate[optional,custom[number]]" />
                            </div>
                            <div class="single-column" >
                                    <label class="question-label">Longitude  </label>
                                    <input type="text" name="longitude" id="longitude" value="<?php if(isset($details->longitude)){echo $details->longitude;}?>" class="inputinpt validate[optional,custom[number]]" />
                            </div>                    
                            <div class="single-column">
                                <label class="question-label">Marker Text: </label>
                                <textarea id="marker" name="marker" class="editor"><?php if(isset($details->marker)){echo outputEscapeString($details->marker);}?></textarea>
                            </div>
                            <div class="single-column">
                                <ul>
                                    <li class="fullWidth">
                                        <label><span>Map Marker</span></label>
                                        <div class="image-upload">
                                            <div class="inputBtnSection">
                                                <input id="uploadFile1" class="disableInputField" disabled="disabled" style="width:83%" />
                                                <label class="fileUpload">
                                                    <input id="htmlfile1" type="file" class="upload" name="htmlfile1" onChange="document.getElementById('uploadFile1').value = this.value;" />
                                                    <span class="uploadBtn">Browse</span>
                                                </label>
                                            </div>
                                        </div>
                                        <p class="sizetxt">Size Requirement: 50px X 50px pixels </p>
                                    </li>
                                </ul>
                                <?php if(!empty($details->map_marker)){ ?>
                                <?php if($details->map_marker!='' && is_file(file_upload_absolute_path()."contact_photo/".$details->map_marker))	
                                                                        {
                                                                            $logo_photo1 = substr_replace($details->map_marker,'_thumb',-4,0);
                                                                            $logo_photo1=file_upload_base_url()."contact_photo/".$details->map_marker;

                                                                        }
                                                                        else
                                                                        {
                                                                            $logo_photo1=file_upload_base_url()."noimage_thumb.jpg";
                                                                        }?>
                          <img src="<?php echo $logo_photo1;?>" style="background:black;" width="150" height="100"/>

                                <a href="javascript:void(0);" title="Remove" onClick="imagedelete('<?php echo $details->id;?>','map_marker','contact','contact_photo');" class="removebtn" >Remove</a>
                                <?php } ?>
                            </div>
                            <div class="single-column" >
                                <label class="question-label">Shown Map</label>
                                <input type="checkbox" name="is_shown_map" id="is_shown_map" value="1" <?php if(isset($details->is_shown_map) && ($details->is_shown_map == 1)){ ?> checked <?php }?> class="inputinpt"  />
                            </div>
                           
<!--                            <div class="single-column" >
                                <label class="question-label">Status:<span>*</span></label>
                                <input type="radio" name="is_active" id="is_active" value="1" 
                                <?php echo ((isset($details->is_active) && $details->is_active ==1)?'checked="checked"':'')?>/>
                              &nbsp;Active &nbsp;&nbsp;
                              <input type="radio" name="is_active" id="is_active_1" value="0" <?php echo ((isset($details->is_active) && $details->is_active ==0)?'checked="checked"':'')?> />
                              &nbsp;Inactive &nbsp;&nbsp; 
                            </div>-->
			<div class="bottonserright" style="padding-bottom:20px;"> 
                            <!--<a href="javascript:void(0);" title="Delete" onClick="rowdelete('<?php echo $details->id; ?>','contact');" class="web-red-btn" <?php if(isset($details->id) && $details->id >0){}else{echo 'style="display:none;"';}?>> <span>Delete</span> </a>--> 
                            <a href="javascript:void(0);" class="web-red-btn" onClick="form_submit();"><span>Save</span></a> <?php echo form_close();?> </div>
		</div>
	</div>
	<div class="bodybottom"> </div>
</div>
 <?php $this->load->view($footer); ?>
</div>

</div>
    <div class="clear"></div>
     
                       
 
<script type="text/javascript">
function showdiv(val){
    if(val == '1'){
        $('#divurl').show();
    }else{
        $('#divurl').hide();
    }
}
       $(function() {
					
					
					
					$("#MoveRight,#MoveLeft").click(function(event) {
						var id = $(event.target).attr("id");
						var selectFrom = id == "MoveRight" ? "#cat_id" : "#selected_id";
						var moveTo = id == "MoveRight" ? "#selected_id" : "#cat_id";

						var selectedItems = $(selectFrom + " :selected").toArray();
						$(moveTo).append(selectedItems);
					   

					});
					});
</script>

