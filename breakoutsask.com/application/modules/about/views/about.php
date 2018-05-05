<?php $this->load->view($header); ?>    
    <!--banner section start-->
     <?php if(count($aboutbanner_arr) != 0){$aboutback = file_upload_base_url()."cmspages/".$aboutbanner_arr[0]->banner_photo; } ?>
    <div class="inner-banner about-banner" id="inner-banner" style=" <?php if(count($aboutbanner_arr) != 0 && $aboutbanner_arr[0]->banner_photo != ''){ ?>background-image:url('<?php echo $aboutback; ?>'); background-repeat: no-repeat;<?php } ?>">
    	<div class="wrapper">
            <h1><?php echo $aboutbanner_arr[0]->title; ?></h1>
        </div>
    </div>
    <!--banner section end-->
    
    <!--one team one room section start-->
    <div class="one-team-room">
    	<span class="one-team-top"></span>
        <div class="one-team-cont">
    	<div class="wrapper">
        	<h2><?php echo $about_background[0]->title; ?></h2>
            <p><?php echo $about_background[0]->description; ?> </p>
            <ul>
             <?php foreach($about_featuredblocks_arr as $row_about_featuredblocks){ 
			$aboutback_icon = file_upload_base_url()."featured_block_image/"."thumb_".$row_about_featuredblocks->featured_block_image;
			
			?>
            	<li>
                	<h3><span class="time" style=" <?php if($row_about_featuredblocks->featured_block_image != ''){ ?>background-image:url('<?php echo $aboutback_icon; ?>'); background-repeat: no-repeat; <?php } ?>"><?php echo $row_about_featuredblocks->title; ?></span></h3>
                   <?php echo outputEscapeString($row_about_featuredblocks->description); ?>
                </li>
                 <?php } ?>
             
            </ul>
        </div>
         <div class="clear"></div>
    	</div>
        <span class="one-team-bot"></span>
    </div>
    <!--one team one room section end-->
    <?php $i = 1; ?>
    <?php foreach($calltoaction_featuredblocks_arr as $row_calltoaction_featuredblocks){ 
			$calltoaction_icon = file_upload_base_url()."featured_block_image/"."thumb_".$row_calltoaction_featuredblocks->featured_block_image;
			if(count($row_calltoaction_featuredblocks) != 0){$aboutback = file_upload_base_url()."featured_block_background_image/".$row_calltoaction_featuredblocks->featured_block_background_image; }
			
			if($i == 1){$class_id = 'about-try-new';}
			else if($i == 2){$class_id = 'team-building';}
			else if($i == 3){$class_id = 'special-event';}
			
			?>
    <!--something new section start-->
    <div class="<?php echo $class_id; ?>" id="<?php echo $class_id; ?>" <?php if(count($row_calltoaction_featuredblocks) != 0 && $row_calltoaction_featuredblocks->featured_block_background_image != ''){ ?> style="background-image:url('<?php echo $aboutback; ?>'); background-repeat: no-repeat;"<?php } ?>>
    	<!--<span class="team-building-top"></span>-->
        <?php if($i == 2) {?>
        <span class="team-building-top"></span>
        <div class="team-building-cont">
        <?php } ?>
    	<div class="wrapper">
        	<div class="about-trynew-left">
        		<h2><?php echo $row_calltoaction_featuredblocks->title; ?></h2>
                <?php echo outputEscapeString($row_calltoaction_featuredblocks->description); ?>
            </div>
           <?php if($row_calltoaction_featuredblocks->block_button_text != ''){ ?>
            <a href="<?php echo $row_calltoaction_featuredblocks->block_url_link; ?>" class="view-but"><?php echo $row_calltoaction_featuredblocks->block_button_text; ?></a>
            <?php } ?>
        </div>
        
         <?php if($i == 2) {?>
        <div class="clear"></div>
        </div>
        
        <?php } ?>
        <span class="team-building-bot"></span>
    </div>
    
      <?php if($i == 3){$i = 0;} $i++;} ?>
    <!--something new section end-->

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
   