<?php $this->load->view($header); ?>
<?php $this->load->view($left); ?>
<div class="rightDiv">
	<div class="right-outer">
    	<div class="right-outer">
		<h3 class="title">Manage Faq</h3>
		<div class="bread-crumb"><ul><li><a href="<?php echo base_url("kaizen/faq/");?>">Faq</a></li></ul></div>
        <div class="clear"></div>
        <a class="edit-btn" href="<?php echo base_url("kaizen/faq/doadd/0/");?>"><span>Add</span></a>
        
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
        <div class="application-table-area">
        	<div class="mid-block">
            	<div class="members-table">
					
                    <div class="table-top">
							<div class="table-top-lt"><h3>News Post List</h3></div>
						<div class="clear"></div>
						</div>
            <table cellspacing="0" cellpadding="0" border="0">
                        
						<tbody><tr>
                            <th>Title</th>                           
                            <th>Category</th>
                             <th>Sequence</th>
                             <th>Status </th>
                             <th>Actions</th>
                        </tr>
                							<?php 
											if(!empty($records)){
											foreach($records as $row){
                        if($row->is_active != "Deleted"){
			  ?>
							
										<tr>
											<td>	<?php echo $row->title;?></td>											
                      <?
                      $this->load->model('modelfaq','custom_m');
                      if(!empty($row->cat_id)){
                  		  $update_where=array(		
                  		    'id'=>$row->cat_id
                  		  );
                        $category_details = $this->custom_m->select_row('faqcategories',$update_where);
                        $faq_category = $category_details[0]->faqcategories_title;
                      }
                      else{
                        $faq_category = 'Un-categorised';
                      }
                      ?>
                      <td><?php echo $faq_category ;?></td>
                      <td ><?php echo $row->display_order;?></td>
											<td ><?php if($row->is_active=="Active"){ ?>
												<a href="<?php echo site_url("kaizen/faq/do_changestatus/Inactive/".$row->id);?>" title="Active"> <img src="<?php echo base_url("public/kaizen/images/unlock_icon.gif");?>" alt="Active"/> </a>
												<?php } else if($row->is_active=="Inactive"){ ?>
												<a href="<?php echo site_url("kaizen/faq/do_changestatus/Active/".$row->id);?>" title="Inactive"> <img src="<?php echo base_url("public/kaizen/images/locked_icon.gif");?>" alt="Inactive"/></a>
												<?php } ?></td>
											<td>
                        <a href="<?php echo site_url("kaizen/faq/doedit/".$row->id);?>" title="Edit" class="edit3 edit-btn"><span>Edit</span></a>
                        <a href="javascript:void(0);" title="Delete" onClick="confirmdel('<?php echo site_url("kaizen/faq/do_changestatus/Deleted/".$row->id);?>');" class="delete3 delete-red-btn"><span>Delete</span></a></td>
										</tr>
									
							<?php
            }
			  }
			  }
			  ?>
                			  
						
                    </tbody></table>
            	</div>
                <?php $this->load->view($copyright); ?>
          </div>
             
             <div class="rt-block">
             	<div class="rt-bg-block">
                    <div class="rt-column search-side">
						<a href="<?php echo site_url("kaizen/faq/dolist/");?>" class="temp-btn">Faq List</a>
						<a href="<?php echo site_url("kaizen/faq/list_categories/");?>" class="temp-btn">Faq Categories</a>            
                    </div>
                            
                </div>
                 	
             </div>
        </div>
        
    </div>
    </div>
</div>
<script type="text/javascript">
function confirmdel(page){
	if(confirm("Are you sure want to delete?")){
		window.location.href=page
	}
	else{
		return false;
	}
}
</script>
