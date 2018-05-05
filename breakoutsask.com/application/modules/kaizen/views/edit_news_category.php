<?php $this->load->view($header); ?>
<?php $this->load->view($left); ?>
<script type="text/javascript" src="<?php echo base_url("public/ckeditor/ckeditor.js");?>"></script>
<link rel="stylesheet" href="<?php echo base_url("public/validator/css/validationEngine.jquery.css");?>" type="text/css"/>
<script src="<?php echo base_url("public/js/jquery-1.8.3.min.js");?>" type="text/javascript"></script>
<script src="<?php echo base_url("public/validator/js/languages/jquery.validationEngine-en.js");?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url("public/validator/js/jquery.validationEngine.js");?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#cont").validationEngine();
	});
function form_submit(){
$('#cont').submit();
}
function goto_page(){
document.location.href = "<?php echo site_url("kaizen/news_category/");?>";
}
function confirmdel_news_category(id,page){
	if(confirm("Are you sure want to delete?")){
		window.location.href="<?php echo site_url("kaizen/news_category/dodelete/");?>?deleteid="+id;
	}
	else{
		return false;
	}
}
</script>

<div class="rightDiv">
  <div class="right-outer">
    <div class="right-outer">
      <h3 class="title">News</h3><div class="bread-crumb"><ul><li><a href="<?php echo base_url('kaizen/news_category');?>">News Categories</a></li><li><a href="<?php echo base_url("kaizen/news_category/doadd/0/");?>">Create New</a></li></ul></div>
      <div class="clear"></div>
      
      <!--Search area end-->
      <div class="application-table-area">
        <div class="mid-block">
          <div class="mid-content"> 
            <!--<h3>Edit User</h3>-->
            <div id="member-form">
              <?php 
		  $attributes = array('name' => 'cont', 'id' => 'cont');
		  echo form_open_multipart('kaizen/news_category/addedit/'.$details->id,$attributes);
		  echo form_hidden('news_category_id', $details->id);
		  
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
                <input type="text" name="news_category_title" id="news_category_title" value="<?php if(isset($details->title)){echo $details->title;}?>" class="inputinpt validate[required]" />
              </div>
              <div class="single-column">
                <label>Sequence</label>
                <input type="text" name="display_order" id="display_order" value="<?php if(isset($details->display_order)){echo $details->display_order;}?>" class="inputinpt validate[required]" />
              </div>
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
               <a href="javascript:void(0);" title="Delete" onClick="confirmdel_news_category('<?php echo $details->id;?>','<?php echo rawurlencode(base_url("kaizen/news_category"));?>');" class="delete-red-btn" <?php if(isset($details->id) && $details->id >0){}else{echo 'style="display:none;"';}?>> <span>Delete</span> </a> 
        <a href="javascript:void(0);" class="edit-btn" onClick="form_submit();"><span>Save</span></a> 
        <?php echo form_close();?>
            </div>
          </div>
          <?php $this->load->view($copyright); ?>
        </div>
        <div class="rt-block">
          <div class="rt-bg-block">
            <div class="rt-column search-side"> 
              <!--<form id="sidebar-search">
                            <input type="text" id="search-box" name="Search Box" value="Search Box">
                            <input type="submit" value="Submit" name="">
                      </form>-->
              
              <div class="clear"></div>
            
              <a href="<?php echo site_url("kaizen/news_category/dolist/");?>" class="temp-btn orange-btn">Cancel</a> 
              <a href="<?php echo site_url("kaizen/news_category/dolist/");?>" class="temp-btn">News Category List</a> 
              <a href="<?php echo site_url("kaizen/news_posts/dolist/");?>" class="temp-btn">Post List</a> 
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	var editor, html = '';
	if (editor ){
   	editor.destroy();
	editor = null;
	}
    CKEDITOR.replace( 'content' ,{
	width : '95%',
	contentsCss : '<?php echo base_url("public/kaizen/css/style_ck.css");?>',	
	filebrowserBrowseUrl : '<?php echo base_url("public/ckfinder/ckfinder.html");?>',
	filebrowserUploadUrl : '<?php echo base_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files");?>',
	filebrowserImageUploadUrl : '<?php echo base_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images");?>',
	filebrowserFlashUploadUrl : '<?php echo base_url("public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash");?>'
});
function confirmdel(id){
	if(confirm("Are you sure want to delete image?")){
		window.location.href="<?php echo site_url("kaizen/news_category/dodeleteimg/");?>?deleteid="+id;
	}
	else{
		return false;
	}
}
</script> 
