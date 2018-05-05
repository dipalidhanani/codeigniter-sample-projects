<div class="nav-container menu">			
			<ul class="menulink">

			<!--<li><a href="<?php echo site_url("dashboard");?>">Dashboard </a></li>-->                  
			<li><a href="<?php echo site_url("kaizen/cms");?>" <?php if(strstr(uri_string(),'cms')){echo 'class="active"';}?>>Pages</a>
            	<ul class="drop">
                                <li><a href="<?php echo site_url("kaizen/other_cms")?>">Inner Pages</a></li>
                </ul>
            </li>
            <?php
				$sel_menu =array('banner','careers','projects');  
				$sel_menu_name=$this->uri->segment(2);	
			?>                
			<li> <a href="#" <?php if (in_array($sel_menu_name,$sel_menu)){echo 'class="active"';}?> >Components</a>
            	<ul class="drop">
	                   
                </ul>
            </li>                   
			<!--<li><a href="#">Blog</a>
	            <ul class="drop">
						<li><a href="<?php echo site_url("news_category/")?>">Category</a></li>
                        <li><a href="<?php echo site_url("news_posts/");?>">News</a></li>
					</ul>
            </li> -->
            
			</ul>
			<div class="clear"></div>
</div>