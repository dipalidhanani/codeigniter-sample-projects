
 <!--ftnav section start-->
    <div class="ftinfo">
    	<div class="wrapper">
        	<div class="ftninfo-left">
            	<ul>
              
                	<li class="addrs"><p><?php echo $this->data['default_contact'][0]->address; ?></p></li>
                    <li class="call"><p><?php echo $this->data['default_contact'][0]->phone; ?></p></li>
                </ul>
            </div>
            <ul class="ftnav">
            	<?php echo $hooks_footerpages_list; ?>
                <li><a href="<?php echo $this->data['site_settings']->book_online_link; ?>" class="book-online">Book Online</a></li>
            </ul>
        </div>
    </div>
    <!--ftnav section end-->
    
    <!--footer section start-->
    <div class="footer">
    	<span class="footer-top"></span>
        <div class="footer-bottom">
        	<div class="wrapper">
            	<ul class="ftsocial">
                 <?php 
				
			foreach($this->data['social_links'] as $row_social){
				
				if($row_social->social_menus_id == '1'){
				$fb_link = $row_social->link; ?>
				<li><a href="<?php echo $fb_link; ?>" class="fb"></a></li>
				<?php 
				}
				else if($row_social->social_menus_id == '2'){
				$twitter_link = $row_social->link; ?>
                 <li><a href="<?php echo $twitter_link; ?>" class="twit"></a></li>
                <?php
				}
				else if($row_social->social_menus_id == '3'){
				$in_link = $row_social->link; ?>
                 <li><a href="<?php echo $in_link; ?>" class="in"></a></li>
                <?php
				}
				else if($row_social->social_menus_id == '4'){
				$google_link = $row_social->link; ?>
                <li><a href="<?php echo $google_link; ?>" class="google"></a></li>
                <?php
				}
				else if($row_social->social_menus_id == '5'){
				$utube_link = $row_social->link; ?>
                 <li><a href="<?php echo $utube_link; ?>" class="utube"></a></li>
                <?php
				}
				else if($row_social->social_menus_id == '6'){
				$insta_link = $row_social->link; ?>
                 <li><a href="<?php echo $insta_link; ?>" class="pint"></a></li>
                <?php
				}
				else if($row_social->social_menus_id == '7'){
				$tumblr_link = $row_social->link;
				}
			}
			
			?> 
                	
                   
                   
                    
                   
                   
                </ul>
            	<p class="copytext">Copyright <?php echo date('Y'); ?> – <?php echo $this->data['site_settings']->copy_right; ?> &nbsp;| <a href="<?php echo base_url("pages/privacy-policy"); ?>">&nbsp;Privacy Policy</a></p>
                <p class="designby">Website Design & Developed by <a href="//www.2webdesign.com" rel="nofollow">2 Web Design</a></p>
            </div>
        </div>
    	<div class="clear"></div>
    </div>
    <!--footer section end-->
<?php if(!empty($this->data['site_settings']->analytics_code)){ ?>
<?php echo $this->data['site_settings']->analytics_code; ?>
<?php } ?>
</body>
</html>

