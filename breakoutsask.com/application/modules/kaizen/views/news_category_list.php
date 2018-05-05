<?php $this->load->view($header); ?>
<?php $this->load->view($left); ?>
<script>
function showdata(){
	$('#search_frm').submit();
	}
  function resetsearch(){
    $('#projects_category option:eq(0)').attr('selected','selected');
  }
</script>
<div class="rightDiv">
	<div class="right-outer">
    	<div class="right-outer">
        <?php //$this->load->view($cms_header); ?>
		<h3 class="title">News Category</h3>
		<div class="bread-crumb"><ul><li><a href="#">Manage News Category</a></li></ul></div>
        <div class="clear"></div>
        
        <!--Search area end-->
        <div class="application-table-area">
        	<div class="mid-block">
            	<div class="members-table">
					
                    
                    
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
        
                    <div class="table-top">
							<div class="table-top-lt"><h3>News Category List</h3></div>
						<div class="clear"></div>
						</div><table  border="0" cellspacing="0" cellpadding="0">
							<tbody>
							<tr>
								
											<th >Title</th>
											<th >Sequence</th>
											<th >Status</th>
											<th >Edit</th>
											<th>Delete</th>
									
							</tr>
							<?php
			  if(isset($empty_msg)){
				  ?>
							<tr>
								<td align="center" valign="top"><b><?php echo $empty_msg;?></b><br /></td>
							</tr>
							<?php
			  }
			  else{
			  $i=0;
			  foreach($records as $row){
				  $i++;				  
			  ?>
							<tr>
											<td ><?php echo $row->title;?></td>
											<td ><?php echo $row->display_order;?></td>
											<td ><?php if($row->is_active==1){ ?>
												<a href="<?php echo site_url("kaizen/news_category/do_changestatus/".$row->id);?>" title="Active"> <img src="<?php echo base_url("public/images/unlock_icon.gif");?>" alt="Active"/> </a>
												<?php } else{ ?>
												<a href="<?php echo site_url("kaizen/news_category/do_changestatus/".$row->id);?>" title="Inactive"> <img src="<?php echo base_url("public/images/locked_icon.gif");?>" alt="Inactive"/></a>
												<?php } ?></td>
			<td  ><a href="<?php echo site_url("kaizen/news_category/doedit/".$row->id);?>" title="Edit" class="edit-btn"><span>Edit</span></a></td>
											<td   class="nobr"><a href="javascript:void(0);" title="Delete" onClick="confirmdel('<?php echo $row->id;?>','<?php echo rawurlencode(current_url());?>','');" class="delete3 delete-red-btn"><span>Delete</span></a></td>
										</tr>
									
							
							<?php
			  }
			  }
			  ?>
              </tbody>
						</table>
            	</div>
                
                <?php $this->load->view($copyright); ?>
               
          </div>
             
            
             <div class="rt-block">
             	<div class="rt-bg-block">
                    <div class="rt-column search-side">
                        <a class="temp-btn" href="<?php echo base_url("kaizen/news_category/doadd/0/");?>"><span>Add</span></a>
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
function confirmdel(id,page,pos){
	if(confirm("Are you sure want to delete?")){
		window.location.href="<?php echo site_url("kaizen/news_category/dodelete/");?>?deleteid="+id+"&pos="+pos;
	}
	else{
		return false;
	}
}

var base_url = '<?php echo site_url(); ?>';
function showdata(value){
	$.ajax({
			url : base_url+"kaizen/news_category/dolist",
			type : "POST",
			data : {cat_id:value},
			
			success : function(data){
                            $('#news_category_div').html(data);
                        }
		});
}

</script>

