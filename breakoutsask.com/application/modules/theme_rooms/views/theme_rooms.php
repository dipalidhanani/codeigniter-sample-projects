<?php $this->load->view($header); ?>    
    <!--banner section start-->
     <!--banner section start-->
      <?php if(count($themebanner_arr) != 0){$themeback = file_upload_base_url()."cmspages/".$themebanner_arr[0]->banner_photo; } ?>
    <div class="inner-banner theme-banner" id="inner-banner" style=" <?php if(count($themebanner_arr) != 0 && $themebanner_arr[0]->banner_photo != ''){ ?>background-image:url('<?php echo $themeback; ?>'); background-repeat: no-repeat;<?php } ?>">
        <div class="wrapper">
        	<h1><?php echo $themebanner_arr[0]->title; ?></h1>
        </div>
    </div>
    <!--banner section end-->
    
     <?php 
	 $i=1;
	 foreach($theme_rooms_arr as $row_theme_rooms){
		 
		 if($i%2 == 0){$cls = 'theme-pic-right'; }else{$cls = 'theme-pic-left';}
		  
			$theme_rooms_image = file_upload_base_url()."theme_image/".$row_theme_rooms->theme_image;
			$theme_background_image = file_upload_base_url()."theme_background_image/".$row_theme_rooms->theme_background_image;
			?>
    <!--theme block1 section start-->
    
    <div id="theme-block-<?php echo $i; ?>" class="theme-block-<?php echo $i; ?>" style=" <?php if($row_theme_rooms->theme_background_image != ''){ ?>background-image:url('<?php echo $theme_background_image; ?>'); background-repeat: no-repeat;<?php } ?>">
    
    <?php if($i%2 != 0){ ?>
        <span class="theme-block-one-top"></span>
        <div class="theme-block-one-cont">
        <?php } ?>
        
    	<div class="wrapper">
        	<div class="theme-pic <?php echo $cls; ?>">
            	<img src="<?php echo $theme_rooms_image; ?>" alt="" title="" />
            </div>
            <div class="theme-cont">
            	<h2><?php echo $row_theme_rooms->title; ?></h2>
                <p><?php echo $row_theme_rooms->description; ?> </p>
                <a href="<?php echo $row_theme_rooms->theme_button_link; ?>" target="_blank" class="book-now">Book Now</a>
            </div>
        </div>
        <div class="clear"></div>
        
           <?php if($i%2 != 0){ ?>
            </div>
            
        <span class="theme-block-one-bot"></span>
        <div class="clear"></div>
        <?php } ?>
        
    </div>
    <!--theme block1 section end-->
     <?php $i++; } ?>
    
    
    
    <!--blog section start-->
    <div class="recent-blogs">
    	<div class="wrapper">
        	<h2>Recent Blog Posts</h2>
            <ul>
            	 <?php foreach($recent_blogs_arr as $row_recent_blogs){ 
			
			?>
            	<li>
                	<div class="home-blog-date">
                    	<p><?php echo date('d',strtotime($row_recent_blogs->create_dt)); ?> <span><?php echo date('M',strtotime($row_recent_blogs->create_dt)); ?></span></p>
                    </div>
                    <div class="home-blog-right">
                    	<!--<h4>Praesent volutpat</h4>-->
                        <h3><a href="<?php echo site_url("blog/blog_detail/".$row_recent_blogs->id);?>"><?php echo substr($row_recent_blogs->title, 0, 25)."..."; ?></a></h3>
                        <p><?php
						$string = $row_recent_blogs->description;						
						$striphtml = strip_tags($string);					
                     echo substr($striphtml, 0, 60).'...'; ?></p>
                        <a href="<?php echo site_url("blog/blog_detail/".$row_recent_blogs->id);?>" class="more">MORE</a>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!--blog section end-->
    
    
 
  <?php $this->load->view($footer); ?>  
   