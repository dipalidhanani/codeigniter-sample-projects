<?php $this->load->view($header); ?>
<?php $this->load->view($left); ?>

<div class="rightDiv">
	<div class="right-outer">
    	<div class="right-outer">
		<h3 class="title">News Post</h3>
		<div class="bread-crumb"><ul><li><a href="#">Manage News</a></li><li><a href="#">Create News</a></li></ul></div>
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
							<div class="table-top-lt"><h3>News Post List</h3></div>
						<div class="clear"></div>
						</div><table cellspacing="0" cellpadding="0" border="0">
                        
						<tbody><tr>
                            <th>Title</th>
                            <th>Published</th>
							 <th>Status </th>
							 <th>Edit</th>
							 <th>Delete</th>
                        </tr>
                							<?php 
											if(!empty($records)){
											foreach($records as $row){
				  $i++;				  
			  ?>
              <tr>
                      <td width="120" height="100" align="center" valign="middle"><?php echo $row->title;?></td>
					  <td width="75" align="center" valign="middle">
					  <?php
					  $date = new DateTime($row->create_dt);
					  echo  $date->format('F j, Y');
					  ?>
					  </td>
					  
					  
                       <td width="65" align="center" valign="middle">
				<?php if($row->is_active==1){ ?>
						<a href="<?php echo site_url("kaizen/news_posts/do_changestatus/".$row->id);?>" title="Active"> 
                        <img src="<?php echo base_url("public/images/unlock_icon.gif");?>" alt="Active"/> </a>
				<?php } else{ ?>
						<a href="<?php echo site_url("kaizen/news_posts/do_changestatus/".$row->id);?>" title="Inactive"> 
                        <img src="<?php echo base_url("public/images/locked_icon.gif");?>" alt="Inactive"/></a>
                <?php } ?></td>
              
                      <td width="65" align="center" valign="middle"><a href="<?php echo site_url("kaizen/news_posts/doedit/".$row->id);?>" title="Edit" class="edit3 edit-btn"><span>Edit</span></a></td>
                      <td width="65" align="center" valign="middle" class="nobr"><a href="javascript:void(0);" title="Delete" onClick="confirmdel('<?php echo $row->id;?>','<?php echo rawurlencode(current_url());?>','');" class="delete3 delete-red-btn"><span>Delete</span></a></td>
                   
              </tr>
              <?php
			  }
			  }
			  ?>
                			  
						
                    </tbody></table>
            	</div>
               
          </div>
             
             <div class="rt-block">
             	<div class="rt-bg-block">
                    <div class="rt-column search-side">
                      <!--  <a href="<?php echo site_url("kaizen/news_posts/doadd/0/");?>" class="temp-btn ">Add New</a>-->
                        <a  href="<?php echo base_url("kaizen/news_posts/doadd/0/");?>" class="temp-btn " ><span>Add</span></a>
                        <a href="<?php echo site_url("kaizen/news_category/dolist/");?>" class="temp-btn">News Category List</a>
						<a href="<?php echo site_url("kaizen/news_posts/dolist/");?>" class="temp-btn">Post List</a>
                    </div>
                    
                   


                </div>
             </div>
        </div>
         <?php $this->load->view($copyright); ?>
    </div>
    </div>
</div>

<script type="text/javascript">
function confirmdel(id,page,pos){
	if(confirm("Are you sure want to delete?")){
		window.location.href="<?php echo site_url("kaizen/news_posts/dodelete/");?>?deleteid="+id+"&pos="+pos;
	}
	else{
		return false;
	}
}
</script>

