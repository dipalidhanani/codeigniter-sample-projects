<?php $this->load->view($header); ?>
<?php $this->load->view($left); ?>

<div class="rightDiv">
	<div class="right-outer">
    	<div class="right-outer">
		<h3 class="title">Homepage Slider</h3>
		<div class="bread-crumb">
        <ul>
          <li>
          <li><a href="<?php echo base_url("kaizen/homepage_slider/doadd/0/");?>"> Add New</a></li>
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
                            
						<div class="clear"></div>
						</div><table cellspacing="0" cellpadding="0" border="0">
                        
						<tbody><tr>
                            <th>Title</th>
                            <th>Slider Image/Video URL</th>
                            <th>Sequence </th>	
                             <th>Status </th>						
							 <th>Actions</th>
							 
                        </tr>
                							<?php 
											if(!empty($records)){
											foreach($records as $row){
				  $i++;				  
			  ?>
              <tr>
                      <td width="120" height="100" align="center" valign="middle"><?php echo $row->title;?></td>
					 
					  
					  
                       <td width="65" align="center" valign="middle">
					   <?php						
	if((!empty($row->slider_image)) && ($row->select_image_or_video == 'Image'))
	{						
	?>
    
              <img src="<?php echo file_upload_base_url()."slider_image/".$row->slider_image;?>" width="150" />            
            
	<?php
					}
					else{
						echo $row->slider_video_url;
						}
					?></td>
                     <td width="65" align="center" valign="middle"><?php echo $row->sequence;?></td>
                     <td width="65" align="center" valign="middle">
				<?php if($row->slider_status=='Active'){ ?>
						<a href="<?php echo site_url("kaizen/homepage_slider/do_changestatus/".$row->id);?>" title="Active"> 
                        <img src="<?php echo base_url("public/images/unlock_icon.gif");?>" alt="Active"/> </a>
				<?php } else{ ?>
						<a href="<?php echo site_url("kaizen/homepage_slider/do_changestatus/".$row->id);?>" title="Inactive"> 
                        <img src="<?php echo base_url("public/images/locked_icon.gif");?>" alt="Inactive"/></a>
                <?php } ?></td>
              
                      <td width="65" align="center" valign="middle"><a href="<?php echo site_url("kaizen/homepage_slider/doedit/".$row->id);?>" title="Edit" class="edit3 edit-btn"><span>Edit</span></a>
                      <a href="<?php echo site_url("kaizen/homepage_slider/dodelete/".$row->id."")?>" title="Delete"  class="delete delete-red-btn"><span>Delete</span></a></td>
                   
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
						<a href="<?php echo site_url("kaizen/homepage_block_setting/");?>" class="temp-btn">Homepage Block Settings</a>
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
/*function confirmdel(id,page,pos){
	if(confirm("Are you sure want to delete?")){
		window.location.href="<?php// echo site_url("kaizen/homepage_slider/dodelete/");?>?deleteid="+id+"&pos="+pos;
	}
	else{
		return false;
	}
}*/
</script>

