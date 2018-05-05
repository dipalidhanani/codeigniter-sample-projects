<?php $this->load->view($header); ?>    
<script type="text/javascript">
// JavaScript Document

window.onload = function () {

   	var latlng = new google.maps.LatLng(<?php echo $contact_arr[0]->latitude; ?>, <?php echo $contact_arr[0]->longitude; ?>);

   	var styles = [
		{"featureType":"water","elementType":"geometry","stylers":[
			{"color":"#bfbfbf"},
			{"lightness":0}
			]
		},
		{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f0f0f0"},{"lightness":0}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#929292"},{"lightness":0}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#bfbfbf"},{"lightness":0},{"weight":1}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#bfbfbf"},{"lightness":0}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#bfbfbf"},{"lightness":0}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#e3e3e3"},{"lightness":0}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"},{"color":"#484848"},{"lightness":0}]},{"elementType":"labels.text.fill","stylers":[{"saturation":0},{"color":"#4c4b48"},{"lightness":0}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f0f0f0"},{"lightness":0}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#bfbfbf"},{"lightness":0}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#f0f0f0"},{"lightness":0},{"weight":1.2}]}]


	var isDraggable = $(document).width() > 480 ? true : false; 


   	var myOptions = {
		draggable: isDraggable, 
		zoom: 14,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		disableDefaultUI: true,
		styles: styles,
		scrollwheel: isDraggable
   	};
   
   	map = new google.maps.Map(document.getElementById('map'), myOptions);
   
   	var marker = new google.maps.Marker({
		position: latlng,
		icon: '<?php echo file_upload_base_url()."contact_photo/thumb_".$contact_arr[0]->map_marker; ?>',
		map: map,
		title:"Break Out"
	});
	
	var iw = new google.maps.InfoWindow({
       content: "<?php echo preg_replace('#\R+#', '<br>', $contact_arr[0]->marker) ?>"
     });
     google.maps.event.addListener(marker, "click", function (e) { iw.open(map, this); });
	

}


//$(window).resize(function() {
//	
//	$(document).width() > 480 ? true : false; 
//			 
//	var myOptions = {
//		scrollwheel: false
//   	};
//		
//		
//});




</script>
    <!--banner section start-->
    <div class="banner">   
    	<ul class="rslides">
        <?php foreach($homepageslider_arr as $row_homepageslider){ ?>
        	<li>            
            <?php if($row_homepageslider->select_image_or_video == 'Image'){ ?>
            	<img src="<?php echo file_upload_base_url()."slider_image/".$row_homepageslider->slider_image;?>" alt="" title="" />
                
                 <div class="wrapper">
                    <div class="banner-cont">
                        <h2><?php echo $row_homepageslider->heading_line1; ?></h2>
                        <h1><?php echo $row_homepageslider->heading_line2; ?></h1>
                        
                        <?php if(($row_homepageslider->button_text)){ ?>
                        <a href="<?php echo $row_homepageslider->url_link; ?>" class="banner-but"><?php echo $row_homepageslider->button_text; ?></a>
                        <?php } ?>
                    </div>
                </div>
                
                <?php }elseif($row_homepageslider->select_image_or_video == 'Video'){ ?>
                <img src="<?php echo file_upload_base_url()."slider_image/banner_img.jpg";?>" alt="" title="" />
                <div class="video">
                  <?
                  if(!empty($row_homepageslider->slider_video_url)){
                    $pieces = explode("/", $row_homepageslider->slider_video_url);
                    $reversed = array_reverse($pieces);
                    $videourl = $row_homepageslider->slider_video_url."?autoplay=1&loop=1&playlist=".$reversed[0];
                    
                    //?autoplay=1&loop=1
                  ?>
                <iframe width="2000" height="1490" src="<?php echo $videourl; ?>" frameborder="0" allowfullscreen id="hardik_test";?>"></iframe>
                <? } ?>
                </div>
                <?php } ?>
               
            </li>
            <?php } ?>
           
        </ul>
        <a href="#breakout" class="scroll-but">Scroll Down</a>
    </div>
    <!--banner section end-->
    
    <!--breakout section start-->
    <?php if(count($about_background) != 0){$aboutback = file_upload_base_url()."homepage_background_image/"."bg_".$about_background[0]->block_background_image; } ?>
    <div class="breakout" id="breakout" style=" <?php if(count($calltoaction_background) != 0 && $about_background[0]->block_background_image != ''){ ?>background-image:url('<?php echo $aboutback; ?>'); background-repeat: no-repeat;<?php } ?>">
    	<div class="wrapper">
            <h2 class="heading"><?php echo $about_background[0]->title; ?></h2>
            <p><?php echo $about_background[0]->description; ?></p> 
            
            <ul>
            <?php foreach($about_featuredblocks_arr as $row_about_featuredblocks){ 
			$aboutback_icon = file_upload_base_url()."featured_block_image/"."thumb_".$row_about_featuredblocks->featured_block_image;
			
			?>
            	<li>
                	<div class="breakout-block">
                    	<div class="breakout-blockin">
                        	<h3 class="time" style=" <?php if($row_about_featuredblocks->featured_block_image != ''){ ?>background-image:url('<?php echo $aboutback_icon; ?>'); background-repeat: no-repeat; <?php } ?>"><?php echo $row_about_featuredblocks->title; ?></h3>
                           <?php echo outputEscapeString($row_about_featuredblocks->description); ?>
                        </div>
                    </div>
                </li>
                <?php } ?>
              
            </ul>
            <a href="<?php echo $about_background[0]->about_read_more_link; ?>" class="banner-but">Read More</a>
        </div>
    </div>
    <!--breakout section end-->
    
    <!--something new section start-->
     <?php if(count($calltoaction_background) != 0){$calltoactionback = file_upload_base_url()."homepage_background_image/".$calltoaction_background[0]->block_background_image; } 
	 ?>
    <div class="something-new" id="something-new" 
    style=" <?php if(count($calltoaction_background) != 0 && $calltoaction_background[0]->block_background_image != ''){ ?> background-image:url('<?php echo $calltoactionback; ?>'); background-repeat: no-repeat; <?php } ?>">
    	<div class="wrapper">
        	  <h2 class="heading"><?php echo $calltoaction_background[0]->title; ?></h2>
            <p><?php echo $calltoaction_background[0]->description; ?></p> 
            <ul>
             <?php foreach($calltoaction_featuredblocks_arr as $row_calltoaction_featuredblocks){ 
			$calltoaction_icon = file_upload_base_url()."featured_block_image/"."thumb_".$row_calltoaction_featuredblocks->featured_block_image;
			
			?>
            	<li>
                	<div class="new-pic">
                    	<img src="<?php echo $calltoaction_icon; ?>" alt="" title="" />
                    </div>
                    <h3><?php echo $row_calltoaction_featuredblocks->title; ?></h3>
                   <p> <?php echo outputEscapeString($row_calltoaction_featuredblocks->featured_excerpt); ?></p>
                   <?php if(($row_calltoaction_featuredblocks->block_url_link != '') && ($row_calltoaction_featuredblocks->block_button_text != '')){ ?> <a href="<?php echo $row_calltoaction_featuredblocks->block_url_link; ?>" class="more"><?php echo $row_calltoaction_featuredblocks->block_button_text; ?></a><?php } ?>
                </li>
               <?php } ?>
            </ul>
        </div>
    </div>
    <!--something new section end-->
    
    <!--blog section start-->
    <?php if(count($recentblogs_background) != 0){$blogback = file_upload_base_url()."homepage_background_image/"."bg_".$recentblogs_background[0]->block_background_image; } ?>
    <div class="home-blog" style=" <?php if(count($recentblogs_background) != 0 && $recentblogs_background[0]->block_background_image != ''){ ?> background-image:url('<?php echo $blogback; ?>'); background-repeat: no-repeat; <?php } ?>">
    	<div class="wrapper">
        	<h2 class="heading"><?php echo $recentblogs_background[0]->title; ?></h2>
            <p><?php echo $recentblogs_background[0]->description; ?></p> 
            <ul>
            <?php foreach($recent_blogs_arr as $row_recent_blogs){ 
			
			?>
            	<li>
                	<div class="home-blog-date">
                    	<p><?php echo date('d',strtotime($row_recent_blogs->create_dt)); ?> <span><?php echo date('M',strtotime($row_recent_blogs->create_dt)); ?></span></p>
                    </div>
                    <div class="home-blog-right">
                    	<!--<h4>Praesent volutpat</h4>-->
                        <h3><a href="<?php echo site_url("blog/blog_detail/".$row_recent_blogs->id);?>"><?php echo substr($row_recent_blogs->title, 0, 40)."..."; ?></a></h3>
                       <?php
						$string = $row_recent_blogs->description;						
						$striphtml = strip_tags($string);					
                     echo '<p>'.substr($striphtml, 0, 130).'...'.'</p>'; ?>
                        <a href="<?php echo site_url("blog/blog_detail/".$row_recent_blogs->id);?>" class="more">MORE</a>
                    </div>
                </li>
                <?php } ?>
               
                
            </ul>
        </div>
    </div>
    <!--blog section end-->
    
    <!--contact section start-->
     <?php if(count($contact_background) != 0){$contactback = file_upload_base_url()."homepage_background_image/"."bg_".$contact_background[0]->block_background_image; } ?>
    <div class="home-contact" id="home-contact" style=" <?php if(count($contact_background) != 0 && $contact_background[0]->block_background_image != ''){ ?> background-image:url('<?php echo $contactback; ?>'); background-repeat: no-repeat; <?php } ?>">
    	<div class="wrapper">
        	<h2 class="heading"><?php echo $contact_background[0]->title; ?></h2>
            <?php echo outputEscapeString($contact_background[0]->description); ?>
            <div class="contact-info-section">
            	<?php if(($contact_arr[0]->is_shown_map == '1') && ($contact_arr[0]->latitude != '') && ($contact_arr[0]->longitude != '')){ ?>
                <div class="home-map-outer">
                	<div class="home-map">
                    	<div id="map"></div>
                    </div>
                </div>
                <?php } ?>
                
                <div class="home-contact-form">
                	<h3>Get In Touch</h3>
                    <form method="post" action="<?php echo site_url("home/sendMail/");?>">
                    <?php 
						if($this->session->userdata('ERROR_MSG')==TRUE){
							echo '<div class="notific_error">
									<h2 align="center" style="color:red;">'.$this->session->userdata('ERROR_MSG').'</h1></div>';
							$this->session->unset_userdata('ERROR_MSG');
						}
					
						if($this->session->userdata('SUCC_MSG')==TRUE){
							echo '<div class="notific_suc"><h2 align="center" style="color:green;">'.$this->session->userdata('SUCC_MSG').'</h1></div>';
							$this->session->unset_userdata('SUCC_MSG');
						} ?>
                    	<input type="text" value="Name" id="name" name="name" />
                        <input type="text" value="Email" id="email" name="email" />
                        <input type="text" value="Phone" id="phone" name="phone" />
                        <textarea id="comment" name="comment">Comment</textarea>
                        <span class="submit"><input type="submit" value="submit" /></span>
                    </form>
                </div>
                <div class="home-contact-info">
                	<h3>Contact Information</h3>
                    <ul>
                    	<li>
                        	<span class="contact-icon contact-icon1"></span>
                        	<p><span>Contact:</span><?php echo $contact_arr[0]->fname.' '.$contact_arr[0]->lname; ?></p>
                        </li>
                        <li>
                        	<span class="contact-icon contact-icon2"></span>
                        	<p><span>Address:</span><?php echo $contact_arr[0]->address; ?></p>
                        </li>
                        <li>
                        	<span class="contact-icon contact-icon3"></span>
                        	<p><span>Phone:</span><?php echo $contact_arr[0]->phone; ?></p>
                        </li>
                        <li>
                        	<span class="contact-icon contact-icon4"></span>
                        	<p><span>Email:</span><?php echo $contact_arr[0]->email; ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--contact section end-->
  <?php $this->load->view($footer); ?>  
   