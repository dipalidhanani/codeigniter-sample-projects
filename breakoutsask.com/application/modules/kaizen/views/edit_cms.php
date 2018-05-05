<?php 
$this->load->view($header); 
$this->load->view($left); 
echo link_tag("public/validator/css/validationEngine.jquery.css")."\n";
?>

<script type="text/javascript" src="<?php echo base_url("public/ckeditor/ckeditor.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/ckeditor/adapters/jquery.js");?>"></script>
<script src="<?php echo base_url("public/validator/js/languages/jquery.validationEngine-en.js");?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url("public/validator/js/jquery.validationEngine.js");?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url("public/js/jquery.form.js");?>"></script>

<script>
$(document).ready(function(){
	<?php 
	if(!empty($details->id)){
	?>
	openpage('<?php echo base_url("kaizen/cms/doeditajax/1");?>');
	<?php
	}
	else{
	?>
	openpage('<?php echo base_url("kaizen/cms/doeditajax/0/");?>');
	<?php
	}
	?>
});	
function openpage(x)
{
	$.ajaxSetup ({cache: false});
	var ajax_load2 = "<div align='center'><br style='clear:both;' />Processing.....</div>";
	$("#member-form").html(ajax_load2);
	$.ajax({
	  type: "GET",
	  cache: false,
	  url: x,
	  dataType:"html",
	  data:'',
	  success:function(responseText){			
		  $("#member-form").html(responseText);			
	  },
	  error:function (request, status, error)	{
		  $("#member-form").html(error);
	  }    
  });
}
function changecls(x){
	$("#"+x).addClass("active1").siblings().removeClass("active1");
	$('.topnav>li>ul>li.active1 a').attr('style', 'background: #F3F3F3 !important');
	$('.topnav>li>ul>li>ul>li a').attr('style', 'background: #F3F3F3 !important');	
}
function getParentValue(){
  return $("#content_show").val();
}
function getParentValue2(){
  return $("#banner_content_show").val();
}
function previewget(ids){
	var val2 = CKEDITOR.instances['contents'].getData();
	//alert(ids);
	var contents 			= $('#content_show').val(val2);
	 /* if(ids==1){
		var draft_url = '<?php echo site_url("draft_home/index/1");?>';
	}
	else{
		var draft_url = '<?php echo site_url("draft/index");?>/'+ids;
	} */
	var draft_url = '<?php echo base_url("draft/index");?>/'+ids;
	var mywin = window.open(draft_url, "ckeditor_preview", "location=0,status=0,scrollbars=1,width=1024,height=768");
	//$(mywin.document.body).html(contents);
}
function confirmdel(id){
	if(confirm("Are you sure want to delete image?")){
		window.location.href="<?php echo base_url("kaizen/cms/dodeleteimg/");?>?deleteid="+id;
	}
	else{
		return false;
	}
}

function showdiv(id){
	$('.showhide'+id).fadeIn('slow');
}
function hidediv(id){
	$('.showhide'+id).fadeOut('slow');
}
function form_submit(val){
	var cur_id = $("#cms_id").val();	
	if(cur_id == 1)
	{
		//var ContentFromEditorB = CKEDITOR.instances.banner_texts.getData();
		//$("#banner_text").val(ContentFromEditorB);	
	}
	var ContentFromEditor = CKEDITOR.instances.contents.getData();
	$("#content").val(ContentFromEditor);	
	if(val=="del"){
		if(confirm("Are you sure want to delete?")){
			window.location.href="<?php echo base_url("kaizen/cms/dodelete/");?>?deleteid=<?php echo $details->id; ?>&ref=<?php echo base_url("cms/");?>";
		}
		else{
			return false;
		}
	}
	else if(val=="draft"){
		$("#save_draft").val(1);
		$('#cont').submit();
	}
	else{
		$('#cont').submit();
	}
	return true;
}
function goto_page(url){
	if(url==""){
		window.location.href = "<?php echo base_url("kaizen/cms/listing/0/");?>";
	}
	else{
		window.location.href = url;
	}
}
	
</script>
<!--right column start-->
<div class="rightDiv">
	
	<!--<div class="right-outer">-->
    	<div class="right-outer">
        <!--<h3 class="title">Welcome</h3>-->
		<div class="clear"></div>
        <div class="mid-block padbot40">
	        <div class="mid-content web-cont-mid">
	            <div id="webcont-form">
        		<div id="member-form" class="midarea"> 
                
                        </div>
                    </div>
                </div>
        </div>
        
                
        <div class="rt-block">
            <a class="add-page" href="<?php echo site_url("kaizen/cms/doadd/0"); ?>">Add Page</a>
        </div>
        <?php
           // pre($cms_list);
            
        ?>
        <?php if(!empty($cms_list)){ ?>
                <div class="rt-block manage-box">
                    <div class="rt-bg-block">
                        <ul class="web-cont-rt-list">
                            <?php 
                            foreach($cms_list as $cms){ 
                                ?>
                            <li id="cms<?php echo $cms->id; ?>">
                                <a onclick="javascript:openpage('<?php echo site_url("kaizen/cms/doeditajax/".$cms->id);?>')" href="javascript:void(0);">
                                    <?php echo $cms->title; ?>
                                </a>
                            <?php
                                $where = array(
                                            'site_id' => 1,
                                            'parent_id'    => $cms->id
                                        
                                        );
                                $order_by = array('id' => 'asc');
                                $sub_pages = $this->modelcms->select_row('cms_pages',$where,$order_by);
                                if(!empty($sub_pages)){
                                ?>
                                <img src="<?php echo site_url("public/images/plus-icon.png"); ?>" style="float: right;margin-top: -29px;width: 20px;">
                                <ul style="display:none;">
                                    <?php foreach($sub_pages as $s_pages){ ?>
                                    <li id="cms<?php echo $s_pages->id; ?>">
                                        <a onclick="javascript:openpage('<?php echo site_url("kaizen/cms/doeditajax/".$s_pages->id);?>')" href="javascript:void(0);">
                                            ----<?php echo $s_pages->title; ?>
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <?php } ?>
                            <li>
                            <?php 
                            
                            }
                            ?>
                        </ul>
                    </div>
                </div>
        <?php } ?>
           
        <div class="clear"></div>
		
    <?php $this->load->view($copyright); ?>
                </div>
        
        
       

</div>
<div class="clear"></div>

<script>
	function sublitCaseForm(){		
		$("#membershipform").submit();
	}
        $(function(){
            $('.web-cont-rt-list li').click(function(event){
                event.preventDefault();
                var inexId = $('.web-cont-rt-list li').index(this);
                $('.web-cont-rt-list li ul').hide();
                $('.web-cont-rt-list li:eq('+inexId+') ul').toggle();
            });
        });
        jQuery(document).ready(function(){
  				setTimeout(function(){ 
  					var docum = $(document).height()-60;
  					$('.leftDiv').height(docum);	
                  $('.rightDiv').height(docum); return false;}, 300);
        });
</script>
</body>
</html>