<?php $this->load->view($header); 
echo link_tag("public/validator/css/validationEngine.jquery.css")."\n"; 

?>  
<script src="<?php echo base_url("public/validator/js/languages/jquery.validationEngine-en.js");?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url("public/validator/js/jquery.validationEngine.js");?>" type="text/javascript" charset="utf-8"></script>  
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
   <?php if(count($contactbanner_arr) != 0){$contactback = file_upload_base_url()."cmspages/".$contactbanner_arr[0]->banner_photo; } ?>
    <div class="inner-banner contact-banner" id="inner-banner" 
    style=" <?php if(count($contactbanner_arr) != 0 && $contactbanner_arr[0]->banner_photo != ''){ ?>background-image:url('<?php echo $contactback; ?>'); background-repeat: no-repeat;<?php } ?>">
        <div class="wrapper">
        	<h1><?php echo $contactbanner_arr[0]->title; ?></h1>
        </div>
    </div>
    <!--banner section end-->
    
    <!--content section start-->
    <div class="content-outer">
    	<div class="content">
        	<div class="wrapper">
            	<div class="content-in">
                	<!--left section start-->
                    <div class="contact-left">
                    	<h2><?php echo $contact_background[0]->title; ?></h2>
                        <?php echo outputEscapeString($contact_background[0]->description); ?>
                        <div class="contact-form" id="comment_message">
                        	<form method="post" action="<?php echo site_url("home/sendMail/");?>" name="commentForm" id="commentForm">
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
                            	<input type="text" placeholder="Name" id="name" name="name" class="validate[required]"/>
                                <input type="text" placeholder="Email" id="email" name="email" class="validate[required,custom[email]]"/>
                                <input type="text" placeholder="Phone" id="phone" name="phone" class="validate[required]"/>
                                <input type="hidden" value="1" id="redirect" name="redirect" />
                                <textarea id="comment" name="comment" class="validate[required]" placeholder="Comments"></textarea>
                                <div class="contact-submit">
                                    <div class="checkbox">
                                        <div id="recaptcha1"></div>
                                    </div>
                                    <span class="submit"><input type="submit" value="submit" onClick="form_submit();"/></span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--left section end-->
                    
                    <!--right section start-->
                    <div class="contact-right">
                    	<h2>Contact Information</h2>
                        <ul>
                          <li>
                        	<span class="contact-icon contact-icon1"></span>
                        	<p><span>Contact:</span><?php echo $contact_arr[0]->fname.' '.$contact_arr[0]->lname; ?></p>
                        </li>
                        <li>
                        	<span class="contact-icon contact-icon2" style="height: 45px;"></span>
                        	<p><span>Address:</span><p><?php echo $contact_arr[0]->address; ?></p></p>
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
                    <!--right section end-->
                    
                    <div class="clear"></div>
                    
                    <!--map section start-->
                    <?php if(($contact_arr[0]->is_shown_map == '1') && ($contact_arr[0]->latitude != '') && ($contact_arr[0]->longitude != '')){ ?>
                    <div class="contact-map">
                    	<div class="contact-map-in">
                        	<div id="map"></div>
                        </div>
                    </div>
                    <?php } ?>
                    <!--map section end-->
                	<div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
    <!--content section end-->
    
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
    <!--contact section end-->
    <script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>
        <script>
          var recaptcha1;
          var myCallBack = function() {        
            //Render the recaptcha2 on the element with ID "recaptcha2"
            recaptcha1 = grecaptcha.render('recaptcha1', {
              'sitekey' : '6LeZzxcUAAAAAH2TphorKhFSoBH7YUcLgimkOfm0', //Replace this with your Site key
              'theme' : 'light'
            });
          };
        </script>
          
          <script type="text/javascript">
          $(document).ready(function(){
          	$("#commentForm").validationEngine();
          	});
          function form_submit(){
            var recaptcha = $('#g-recaptcha-response').val();
            if(recaptcha == ""){
                    alert("Please check the captcha checkbox.");
                    return false;
            }else{
              $('#commentForm').submit();
            } 
          }
          </script>
          
    
          
          
  <?php $this->load->view($footer); ?>  
   