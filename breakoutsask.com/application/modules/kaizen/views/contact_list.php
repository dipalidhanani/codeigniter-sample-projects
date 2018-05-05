<?php $this->load->view($header); ?>
<?php $this->load->view($left); ?>
<div class="rightDiv">
	<div class="right-outer">
		<h3 class="title">Contact List</h3>
		
        <div class="clear"></div>
        <div class="member-lt-block">
        	<div class="mid-block member-search">
					<div class="mid-bg-block">
					
					<form method="post">
                    	<div class="news-select">
                            <select name="">
                                <option>Status</option>
                                <option>---</option>
                                <option>---</option>
                                <option>---</option>
                            </select>
                         </div>
                            
                    	<div id="search">
                    	<input type="text" name="Search Box" id="search-box" value="Search Box">
                        <input type="submit" value="Submit" name="">
                        </div>
                        </form>
                	<div class="clear"></div>
                    </div>
                </div>
       
        <!--Search area end-->
       
        	<div class="mid-block member-search padbot40">
            	<div class="members-table member-group">
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
			
			
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							
							<tr>
								<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											
											<th width="89" align="center" valign="top">Title<span class="listing-arrow"></span></th>
                                            <th width="89" align="center" valign="top">Name<span class="listing-arrow"></span></th>
                                            <th width="60" align="center" valign="top"> Is default? </th>	
											<!--<th width="65" align="center" valign="top">Status<span class="listing-arrow"></span></th>-->
											<th width="65" align="center" valign="top">Edit<span class="listing-arrow"></span></th>
											<!--<th width="65" align="center" valign="top" class="nobr">Delete<span class="listing-arrow"></span></th>-->
										</tr>
									</table></td>
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
								<td align="left" valign="top" <?php if($i%2==0){echo 'class="graybg"';}?>><table width="100%" border="0" cellspacing="0" cellpadding="0" class="withbr">
										<tr>
											<td width="89" align="center" valign="middle"><?php echo $row->title; ?></td>
											<td width="89" align="center" valign="middle"><?php echo $row->fname.' '.$row->lname;?></td>
                                            
                                             <td width="89" height="100" align="center" valign="middle" id="result<?php echo $row->id; ?>" style="text-align:center;">
                       <input type="checkbox" name="is_default" value="<?php echo $row->is_default;?>" <?php if($row->is_default == '1'){echo "checked";} ?> 
                       onclick="ajaxchange_default(this.value,<?php echo $row->id; ?>);" /></td>
                       
<!--											<td width="65" align="center" valign="middle"><?php if($row->is_active==1){ ?>
												<a href="<?php echo site_url("kaizen/".$this->router->fetch_class()."/statusChange/".$row->id."/contact");?>" title="Active"> <img src="<?php echo site_url("public/images/unlock_icon.gif");?>" alt="Active"/> </a>
												<?php } else{ ?>
												<a href="<?php echo site_url("kaizen/".$this->router->fetch_class()."/statusChange/".$row->id."/contact");?>" title="Inactive"> <img src="<?php echo site_url("public/images/locked_icon.gif");?>" alt="Inactive"/></a>
												<?php } ?></td>-->
											<td width="65" align="center" valign="middle"><a href="<?php echo site_url("kaizen/contact/doedit/".$row->id);?>" title="Edit" class="block-btn glass-view-btn"><span>View</span></a></td>
											<!--<td width="65" align="center" valign="middle" class="nobr"><a href="javascript:void(0);" title="Delete" onClick="rowdelete('<?php echo $details->id; ?>','contact');" class="block-btn glass-view-btn"><span>Delete</span></a></td>-->
										</tr>
									</table></td>
							</tr>
							<tr>
								<td align="left" valign="top"></td>
							</tr>
							<?php
			  }
			  }
			  ?>
						</table>
					</div>
				</div>
                 <?php $this->load->view($footer); ?>
			</div>
          
                        <div class="rt-block">
                           <?php //$this->load->view($right); ?>
                        </div>
                          
 <script type="text/javascript">
 function ajaxchange_default(is_default,id){
	
	
	
	$.ajax({
			 type: 'POST',			
			 data: {is_default: is_default,id:id}, //POST parameter to be sent with the tournament id
			  url: '<?php echo base_url('kaizen/homepage_component/default_fun'); ?>', //We are going to make the request to the method "list_dropdown" in the match controller
			 success: function(result) { //When the request is successfully completed, this function will be executed
			 //Activate and fill in the matches list
	
			 $('#result'+id).html(result); //With the ".html()" method we include the html code returned by AJAX into the matches list
			 }
		 });
	
	}
 </script>       
			</div>
			</div>
                        
			<ul class="pagination" style="margin-bottom:20px;">
				<?php echo $pagination; ?>
			</ul>
			<div class="spacer"></div>
		</div>
	</div>
	<div class="bodybottom"> </div>
</div>


