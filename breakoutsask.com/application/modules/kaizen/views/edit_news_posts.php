<?php $this->load->view($header); ?>
<?php $this->load->view($left); ?>
<script type="text/javascript" src="<?php echo base_url("public/ckeditor/ckeditor.js");?>"></script>
<link rel="stylesheet" href="<?php echo base_url("public/validator/css/validationEngine.jquery.css");?>" type="text/css"/>
<script src="<?php echo base_url("public/js/jquery-1.8.3.min.js");?>" type="text/javascript"></script>
<script src="<?php echo base_url("public/validator/js/languages/jquery.validationEngine-en.js");?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url("public/validator/js/jquery.validationEngine.js");?>" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url("public/kaizen/css/jquery.ui.all.css");?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url("public/kaizen/js/ui/jquery.ui.core.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/kaizen/js/ui/jquery.ui.datepicker.js");?>"></script>
<script type="text/javascript">
	$(function() {
		$('.datepicker').datepicker({			
			showButtonPanel: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
	</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#cont").validationEngine();
	});
function form_submit(val){
	if(val=="del"){
		if(confirm("Are you sure want to delete?")){
			window.location.href="<?php echo site_url("kaizen/news_posts/dodelete/");?>?deleteid=<?php echo $details->id;?>";
		}
		else{
			return false;
		}
	}
	else{
		if(checkThisForm()!=false)
		{
		$('#cont').submit();
		}
		else{
			return false;
		}
	}
	return true;
}
function goto_page(){
document.location.href = "<?php echo site_url("kaizen/products/");?>";
}
function confirmdel_post(id,page){
	if(confirm("Are you sure want to delete?")){
		window.location.href="<?php echo site_url("kaizen/news_posts/dodelete/");?>?deleteid="+id;
	}
	else{
		return false;
	}
}
</script>
<div class="rightDiv">
  <div class="right-outer">
    <div class="right-outer">
      <h3 class="title">News</h3>
      <div class="bread-crumb">
        <ul>
          <li>
          <li><a href="<?php echo base_url("kaizen/news_posts/doadd/0/");?>">News Post</a></li>
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
		  echo form_open_multipart('kaizen/news_posts/addedit/'.$details->id,$attributes);
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
                <label>Title</label>
                <input type="text" name="title" id="title" value="<?php if(isset($details->title)){echo $details->title;}?>" class="inputinpt validate[required]" />
              </div>
              <div class="single-column">
                <label>Author</label>
                <input type="text" name="posted_by" id="posted_by" value="<?php if(isset($details->posted_by)){echo $details->posted_by;}?>" class="inputinpt" />
              </div>
              <div class="single-column">
                <label>Enter Date</label>
                <input type="text" name="createdate" id="createdate" value="<?php if(isset($details->create_dt)){echo $details->create_dt;}?>" class="inputinpt datepicker validate[required]" />
              </div>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="midtable">
                <tr>
                  <td align="left" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="134" align="left" valign="top"><label class="labelname">Category : <span>*</span></label></td>
                        <td align="left" valign="top" width="349">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><table>
                            <tr>
                              <td><select name="cat_ids[]" id="cat_id" size="10" multiple="multiple" style="width:200px; height:200px;" >
                                  <option value="0" disabled="disabled">Select Category</option>
                                  <?php 	echo $category; 	?>
                                </select></td>
                              <td valign="middle" nowrap="nowrap" style="padding:8px;"><input type="button" name="left" value="=>" id="MoveRight"/>
                                <br />
                                <br />
                                <input type="button" name="right" value="<=" id="MoveLeft" /></td>
                              <td><select name="selected_cat_id[]" id="selected_cat_id" style="width:200px; height:200px;" 
                    multiple="multiple" size="10" class="inplogin">
                                  <?php 
                        echo $selected_category; 
                       ?>
                                </select></td>
                            </tr>
                          </table>
                      </tr>
                    </table></td>
                </tr>
              </table>
               <div class="single-column">
                <label>Post Content</label>
               <textarea id="description" name="description"><?php if(!empty($details->description)){echo outputEscapeString($details->description);}?>
</textarea>
              </div>
            <div class="single-column">
                <label>Post Image:</label>
               <div class="formFields">
							<div class="fileinputs" style="width:350px;">
								<input type="file" class="file" name="htmlfile" onchange="document.getElementById('fakefilepc1').value = this.value;" />
								<div class="fakefile">
									<input id="fakefilepc1" type="text" disabled="disabled" name="newsletterfile" />
									<img src="<?php echo base_url("public/images/browsebtn.jpg");?>" alt="" height="31" width="84" onmouseover="this.src='<?php echo site_url("public/kaizen/images/browsebtn-ho.jpg");?>'" onmouseout="this.src='<?php echo base_url("public/images/browsebtn.jpg");?>'" /> </div>
							</div>
						</div>
						<div class="spacer"></div>
						<p class="sizetxt">Size Requirement:  710 x 365 pixels</p>
              </div>
	
	
	<?php						
	if(!empty($details->banner_photo))
	{						
	?>
    <div class="single-column">
                <label>&nbsp;</label>
              <img src="<?php echo file_upload_base_url()."news_posts/".$details->banner_photo;?>" width="200"  alt="" />
              </div>
	<div class="single-column">
                <label>&nbsp;</label>
             <a href="javascript:void(0);" title="Remove" onclick="confirmdel('<?php echo $details->id;?>','banner_photo');" class="removebtn" >Remove</a>
              </div>
	<?php
					}
					?>
                    <div class="single-column">
                <label>Status</label>
                <div class="news-select">
                  <select id="is_active" name="is_active"  class="inputinpt validate[required]">
                    <option value="">---Select Status---</option>
                    <option value="1" <?php echo ((isset($details->is_active) && $details->is_active ==1)?'selected':'')?>>Active</option>
                    <option value="0" <?php echo ((isset($details->is_active) && $details->is_active ==0)?'selected':'')?>>Inactive</option>
                  </select>
                </div>
              </div>
                    
           <a href="javascript:void(0);" title="Delete" onClick="confirmdel_post('<?php echo $details->id;?>','<?php echo rawurlencode(base_url("kaizen/news_posts"));?>');" class="delete-red-btn" <?php if(isset($details->id) && $details->id >0){}else{echo 'style="display:none;"';}?>> <span>Delete</span> </a> 
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
              <a href="<?php echo site_url("kaizen/news_posts/dolist/");?>" class="temp-btn orange-btn">Cancel</a> <a href="<?php echo site_url("kaizen/news_posts/dolist/");?>" class="temp-btn">Post List</a> <a href="<?php echo site_url("kaizen/news_category/dolist/");?>" class="temp-btn">News Category List</a> </div>
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
		window.location.href="<?php echo site_url("kaizen/news_posts/dodeleteimg/");?>?deleteid="+id+"&field="+field;
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
function checkThisForm() {
	
		var c = document.getElementById("selected_cat_id");
		if(c.options.length==0){
			alert("Please select Category.");
			return false;
		}
		for(indx=0;indx<c.options.length;indx++){	
			c[indx].selected = true;
		}
		
}
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
