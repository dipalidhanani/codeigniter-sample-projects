<?php $this->load->view($header); ?>
<?php $this->load->view($left); ?>
<script type="text/javascript" src="<?php echo site_url("public/ckeditor/ckeditor.js");?>"></script>
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
		<h3 class="title">Edit Team Component</h3>
		
        <div class="clear"></div>
        <div class="mid-block padbot40">
	        <div class="mid-content web-cont-mid">
	            <div id="webcont-form">
        		<div id="member-form" class="midarea">
			<?php 
		  $attributes = array('name' => 'cont', 'id' => 'cont');
		  echo form_open_multipart('kaizen/team_component/addedit/'.$details->id,$attributes);
		  echo form_hidden('team_component_id', $details->id);
		  
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
                                    <input type="text" name="team_component_title" id="team_component_title" value="<?php if(isset($details->title)){echo $details->title;}?>" class="inputinpt validate[required]" />
                            </div>
                            <div class="single-column" >
                                    <label class="question-label">Designation  </label>
                                    <input type="text" name="designation" id="designation" value="<?php if(isset($details->designation)){echo $details->designation;}?>" class="inputinpt" />
                            </div>
                            <div class="single-column">
                                <label class="question-label">Excert </label>
                                <textarea id="excert" name="excert" class="editor"><?php if(isset($details->excert)){echo outputEscapeString($details->excert);}?></textarea>
                            </div>
                            <div class="single-column">
                            <label class="question-label">Description </label>
                            <?php
                                if(!empty($details->description)){
                                    $cont_txt = outputEscapeString($details->description);
                                }
                                else{
                                    $cont_txt = "";
                                }
                            ?>
                            <textarea id="description" name="description" class="editor"><?php echo $cont_txt;?></textarea>
                        </div>
                        <div class="single-column" >
                                        <label class="question-label">Facebook Link </label>
                                        <input type="text" name="facebook" id="facebook" value="<?php if(isset($details->facebook)){echo $details->facebook; }?>" class="inputinpt validate[optional,custom[url]]" />
                            </div>
                        <div class="single-column" >
                                        <label class="question-label">Twitter Link </label>
                                        <input type="text" name="twitter" id="twitter" value="<?php if(isset($details->twitter)){echo $details->twitter;}?>" class="inputinpt validate[optional,custom[url]]" />
                            </div>
                        <div class="single-column" >
                                        <label class="question-label">Instagram Link </label>
                                        <input type="text" name="instagram" id="instagram" value="<?php if(isset($details->instagram)){echo $details->instagram;}?>" class="inputinpt validate[optional,custom[url]]" />
                            </div>
                        <div class="single-column" >
                                        <label class="question-label">Youtube Link </label>
                                        <input type="text" name="youtube" id="youtube" value="<?php if(isset($details->youtube)){echo $details->youtube;}?>" class="inputinpt validate[optional,custom[url]]" />
                            </div>
                        <div class="single-column" >
                                        <label class="question-label">Google+ Link 	 </label>
                                        <input type="text" name="google_plus" id="google_plus" value="<?php if(isset($details->google_plus)){echo $details->google_plus;}?>" class="inputinpt validate[optional,custom[url]]" />
                            </div>
                    <div class="single-column" >
                                    <label class="question-label">Linkedin Link </label>
                                    <input type="text" name="linkedin" id="linkedin" value="<?php if(isset($details->linkedin)){echo $details->linkedin;}?>" class="inputinpt validate[optional,custom[url]]" />
                            </div>
                    
                            <div class="single-column" >
                                    <label class="question-label">Sequence  </label>
                                    <input type="text" name="is_order" id="is_order" value="<?php if(isset($details->is_order)){echo $details->is_order;}?>" class="inputinpt " />
                            </div>
                            <div class="single-column" >
                                <label class="question-label">Status:<span>*</span></label>
                                <input type="radio" name="is_active" id="is_active" value="1" 
                                <?php echo ((isset($details->is_active) && $details->is_active ==1)?'checked="checked"':'')?>/>
                              &nbsp;Active &nbsp;&nbsp;
                              <input type="radio" name="is_active" id="is_active_1" value="0" <?php echo ((isset($details->is_active) && $details->is_active ==0)?'checked="checked"':'')?> />
                              &nbsp;Inactive &nbsp;&nbsp; 
                            </div>
			<div class="bottonserright" style="padding-bottom:20px;"> 
                            <a href="javascript:void(0);" title="Delete" onClick="rowdelete('<?php echo $details->id; ?>','team_component');" class="web-red-btn" <?php if(isset($details->id) && $details->id >0){}else{echo 'style="display:none;"';}?>> <span>Delete</span> </a> 
                            <a href="javascript:void(0);" class="web-red-btn" onClick="form_submit();"><span>Save</span></a> <?php echo form_close();?> </div>
		</div>
	</div>
	<div class="bodybottom"> </div>
</div>
</div>
</div>
    <div class="clear"></div>
                        <?php $this->load->view($footer); ?>
<script type="text/javascript">
	var editor, html = '';
	if (editor ){
   	editor.destroy();
	editor = null;
	}
    CKEDITOR.replace( 'description' ,{
	width : '95%',
	contentsCss : '<?php echo site_url("public/kaizen/css/style_ck.css");?>',	
	filebrowserBrowseUrl : '<?php echo site_url("public/ckfinder/ckfinder.html");?>',
	filebrowserUploadUrl : '<?php echo site_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files");?>',
	filebrowserImageUploadUrl : '<?php echo site_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images");?>',
	filebrowserFlashUploadUrl : '<?php echo site_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash");?>'
});
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

