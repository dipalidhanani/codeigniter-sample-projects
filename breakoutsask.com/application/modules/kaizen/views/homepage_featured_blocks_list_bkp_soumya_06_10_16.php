<?php $this->load->view($header); ?>
<?php $this->load->view($left); ?>
<div class="rightDiv">
	<div class="right-outer">
    	<div class="right-outer">
		<h3 class="title">Homepage Featured Blocks</h3>
		<div class="bread-crumb">
        <ul>
          <li>
          <li><a href="<?php echo base_url("kaizen/homepage_component/doadd/0/");?>">Add New</a></li>
        </ul>
      </div>
        <div class="clear"></div>
        
        
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
        
        <!--Search area end-->
        <div class="padbot40">
        	<div class="mid-block">
            	<div class="members-table">
					
                    <div class="table-top">
							<div class="table-top-lt"><h3>Featured Blocks List</h3></div>
                            <div class="table-top-rt" style="width: 16.5%;">
                            <form method="get" id="frmsearch" name="frmsearch" action="<?php echo site_url("kaizen/homepage_component/dolist/");?>">
                            <input type="radio" name="rdosection_type" value="" onclick="submitform();" <?php if($_GET['rdosection_type'] == ''){echo "checked";} ?> /> All&nbsp; 
                            <input type="radio" name="rdosection_type" value="About" onclick="submitform();" <?php if($_GET['rdosection_type'] == 'About'){echo "checked";} ?>/> About&nbsp; 
                            <input type="radio" name="rdosection_type" value="Calltoaction" onclick="submitform();" <?php if($_GET['rdosection_type'] == 'Calltoaction'){echo "checked";} ?> /> Call to action 
                            </form>
                            </div>
						<div class="clear"></div>
						</div><table cellspacing="0" cellpadding="0" border="0">
                        
						<tbody><tr>
                            <th>Title</th>
                            <th>Block Type</th>
                            <th>Block Image/Icon</th>
                            <th>Display Order </th>	
                             <th> Is featured? </th>	
                             <th>Status </th>								
							 <th>Actions</th>
							 
                        </tr>
                							<?php 
											
											if($this->input->get('rdosection_type') == 'About'){$records = $records_about;}
											else if($this->input->get('rdosection_type') == 'Calltoaction'){$records = $records_calltoaction;}
											else{$records = array_merge($records_about,$records_calltoaction);}
											
											
											if(!empty($records)){
											foreach($records as $row){
				  $i++;				  
			  ?>
              <tr>
                      <td width="120" height="100" align="center" valign="middle"><?php echo $row->title;?></td>
					 
					   <td width="120" height="100" align="center" valign="middle"><?php echo $row->block_section_type;?></td>
					  
                       <td width="65" align="center" valign="middle"><?php						
	if(!empty($row->featured_block_image))
	{	if($row->featured_image_type == 'icon'){$w = '32';}	else{$w = '150';}				
	?>
    
              <img src="<?php echo file_upload_base_url()."featured_block_image/"."thumb_".$row->featured_block_image;?>" width="<?php echo $w; ?>" />            
            
	<?php
					}
					?></td>
                     <td width="120" height="100" align="center" valign="middle"><?php echo $row->display_order;?></td>
                     
                       <td width="120" height="100" align="center" valign="middle" id="result<?php echo $row->id; ?>">
                       <input type="checkbox" name="is_featured" value="<?php echo $row->is_featured;?>" <?php if($row->is_featured == '1'){echo "checked";} ?> 
                       onclick="ajaxchange_featured(this.value,<?php echo $row->id; ?>,'<?php echo $row->block_section_type; ?>');" /></td>
                     
                     <td width="65" align="center" valign="middle">
				<?php if($row->featured_block_status=='Active'){ ?>
						<a href="<?php echo site_url("kaizen/homepage_component/do_changestatus/".$row->id);?>" title="Active"> 
                        <img src="<?php echo base_url("public/images/unlock_icon.gif");?>" alt="Active"/> </a>
				<?php } else{ ?>
						<a href="<?php echo site_url("kaizen/homepage_component/do_changestatus/".$row->id);?>" title="Inactive"> 
                        <img src="<?php echo base_url("public/images/locked_icon.gif");?>" alt="Inactive"/></a>
                <?php } ?></td>
              
                      <td width="65" align="center" valign="middle"><a href="<?php echo site_url("kaizen/homepage_component/doedit/".$row->id);?>" title="Edit" class="edit3 edit-btn"><span>Edit</span></a>
                      <a href="<?php echo site_url("kaizen/homepage_component/dodelete/".$row->id."")?>" title="Delete"  class="delete delete-red-btn"><span>Delete</span></a></td>
                   
              </tr>
              <?php
			  }
			  }else{?>
              <tr><td><?php echo $empty_msg; ?></td></tr>
              <?php }
			  ?>
                			  
						
                    </tbody></table>
            	</div>
               
          </div>
             
             <div class="rt-block">
             	<div class="rt-bg-block">
                    <div class="rt-column search-side">                
                        <a  href="<?php echo site_url("kaizen/homepage_slider/");?>" class="temp-btn " >Sliding Image and Video Banner</a>
                        <a href="<?php echo site_url("kaizen/homepage_component/");?>" class="temp-btn">Featured Blocks (About us & Call to action)</a>
						<a href="<?php echo site_url("kaizen/homepage_block_setting/");?>" class="temp-btn">Homepage Block Settings</a> </div>
                    </div>
                    
                   


                </div>
             </div>
        </div>
         <?php $this->load->view($copyright); ?>
    </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function(){

 $(".delete").click(function(event){
     alert("Delete?");
     var href = $(this).attr("href")
     var btn = this;

      $.ajax({
        type: "GET",
        url: href,
        success: function(response) {

          if (response == "Success")
          {
            $(btn).closest('tr').fadeOut("slow");
          }
          else
          {
            alert("Error");
          }

        }
      });
     event.preventDefault();
  })
});

function submitform(){
	window.frmsearch.submit();
	}
	
function ajaxchange_featured(is_featured,id,section_type){
	
	
	
	$.ajax({
			 type: 'POST',			
			 data: {is_featured: is_featured,id:id,section_type:section_type}, //POST parameter to be sent with the tournament id
			  url: '<?php echo base_url('kaizen/homepage_component/featured_fun'); ?>', //We are going to make the request to the method "list_dropdown" in the match controller
			 success: function(result) { //When the request is successfully completed, this function will be executed
			 //Activate and fill in the matches list
	
			 $('#result'+id).html(result); //With the ".html()" method we include the html code returned by AJAX into the matches list
			 }
		 });
	
	}
/*function confirmdel(id,page,pos){
	if(confirm("Are you sure want to delete?")){
		window.location.href="<?php //echo site_url("kaizen/homepage_component/dodelete/");?>?deleteid="+id+"&pos="+pos;
	}
	else{
		return false;
	}
}
*/</script>

