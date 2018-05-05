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

<?php 
$val_array = array("\n","\r\n");
?>
<script type="text/javascript">
function getParentValue(){
  return $("#content_show").val();
}
function previewget(ids){
	var val2 = CKEDITOR.instances['contents'].getData();
	//alert(val2);
	var contents 			= $('#content_show').val(val2);
	var draft_url = '<?php echo base_url("draft/index");?>/'+ids;
	var mywin = window.open(draft_url, "ckeditor_preview", "location=0,status=0,scrollbars=1,width=1024,height=768");
	//$(mywin.document.body).html(contents);
}
function confirmdel(id){
	if(confirm("Are you sure want to delete image?")){
		window.location.href="<?php echo base_url("kaizen/other_cms/dodeleteimg/");?>?deleteid="+id;
	}
	else{
		return false;
	}
}
function confirmdel2(id){
	if(confirm("Are you sure want to delete image?")){
		window.location.href="<?php echo base_url("other_cms/dodeleteimg/");?>?back_img=1&deleteid="+id;
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
function openpage(x)
{
	$.ajaxSetup ({cache: false});
	var ajax_load2 = "<div align='center'><br style='clear:both;' />Processing.....</div>";
	$("#showcms").html(ajax_load2);
	$.ajax({
	  type: "GET",
	  cache: false,
	  url: x,
	  dataType:"html",
	  data:'',
	  success:function(responseText){			
		  $("#showcms").html(responseText);			
	  },
	  error:function (request, status, error)	{
		  $("#showcms").html(error);
	  }    
  });
}
function changecls(x){
	$("#"+x).addClass("active1").siblings().removeClass("active1");
	$('.topnav>li>ul>li.active1 a').attr('style', 'background: #F3F3F3 !important');
	$('.topnav>li>ul>li>ul>li a').attr('style', 'background: #F3F3F3 !important');	
}
$(document).ready(function(){
	<?php
	if(!empty($details->id)){
	?>
	openpage('<?php echo base_url("kaizen/other_cms/doeditajax/".$details->id);?>');
	<?php
	}
	else{
	?>
	openpage('<?php echo base_url("kaizen/other_cms/doeditajax/0/");?>');
	<?php
	}
	?>
	
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
	
	}
	
	
	
});	
function form_submit(val){
	var ContentFromEditor = CKEDITOR.instances.contents.getData();
	$("#content").val(ContentFromEditor);	
	if($("#cms_id").val() == '7'){
	var ContentFromEditor = CKEDITOR.instances.contents1.getData();
	$("#content1").val(ContentFromEditor);
	}
	
	if(val=="del"){
		if(confirm("Are you sure want to delete?")){
			window.location.href="<?php echo base_url("kaizen/other_cms/dodelete/");?>?deleteid=<?php echo $details->id ;?>&ref=<?php echo base_url("other_cms/");?>";
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
	return false;
}
function goto_page(url){
	if(url==""){
		window.location.href = "<?php echo base_url("kaizen/other_cms/listing/0/");?>";
	}
	else{
		window.location.href = url;
	}
}
	function setPublish(id)
	{
		document.getElementById('publish_msg').innerHTML = "";
		var publish	=	document.getElementById('publish').checked+"";
		if(publish != "")
		{
			$.ajax({
			   type: "POST",
				url : '<?php echo base_url("kaizen/other_cms/set_publish/");?>',
				data: 'id='+id,
				dataType : "html",
				success: function(data)
				{
					if(data)
					{
						document.getElementById('publish_msg').style.display = "";
						document.getElementById('publish_msg').innerHTML = data;
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
	}
</script>
<div class="rightDiv">
		
            
    	<div class="right-outer">
        <!--<h3 class="title">Welcome</h3>-->
		<div class="clear"></div>
        <div class="mid-block padbot40">
	        <div class="mid-content web-cont-mid">
               
	            <div id="webcont-form">
                     <div class="midarea" id="showcms"> </div>
        		
            </div>
        </div>
		</div>
        <div class="rt-block">
            <a class="add-page" href="<?php echo site_url("kaizen/other_cms/doadd/0"); ?>">Add Page</a>
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
                                <a onclick="javascript:openpage('<?php echo site_url("kaizen/other_cms/doeditajax/".$cms->id);?>')" href="javascript:void(0);">
                                    <?php echo $cms->title; ?>
                                </a>
                            <?php
                                $where = array(
                                            'site_id' => $this->session->userdata('SITE_ID'),
                                            'parent_id'    => $cms->id
                                        
                                        );
                                $order_by = array('id' => 'asc');
                                $sub_pages = $this->modelother_cms->select_row('other_cms_pages',$where,$order_by);
                                if(!empty($sub_pages)){
                                ?>
                                <img src="<?php echo site_url("public/images/plus-icon.png"); ?>" style="float: right;margin-top: -29px;width: 20px;">
                                <ul style="display:none;">
                                    <?php foreach($sub_pages as $s_pages){ ?>
                                    <li id="cms<?php echo $s_pages->id; ?>">
                                        <a onclick="javascript:openpage('<?php echo site_url("kaizen/other_cms/doeditajax/".$s_pages->id);?>')" href="javascript:void(0);">
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
		<?php //$this->load->view($left_menu); ?> <!--<a class="add-page" href="#">Add Page</a>-->
        </div>
        <?php $this->load->view($copyright); ?>

</div><div class="clear"></div>

<input type="hidden" name="content_show" id="content_show" value="" />
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
</script>
<?php //$this->load->view($footer); ?>
