<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if(!empty($meta_title))
{
	echo '<title>'.$meta_title.'</title>'."\n";
}
else if(!empty($this->data['hooks_meta']->meta_title))
{
	echo '<title>'.$this->data['hooks_meta']->meta_title.'</title>'."\n";
}
else
{
	echo '<title>'.$this->data['site_settings']->meta_title.'</title>'."\n";
}
if(!empty($meta_keyword))
{
	$meta_keywords= $meta_keyword;
}
else if(!empty($this->data['hooks_meta']->meta_keyword))
{
	$meta_keywords= $this->data['hooks_meta']->meta_keyword;
}
else
{
	$meta_keywords= $this->data['site_settings']->meta_keyword;
}

if(!empty($meta_description))
{
	$meta_descriptions= $meta_description;
}
else if(!empty($this->data['hooks_meta']->meta_description))
{
	$meta_descriptions= $this->data['hooks_meta']->meta_description;
}
else
{
	$meta_descriptions= $this->data['site_settings']->meta_description;
}	
$meta = array(
        array('name' => 'robots', 'content' => 'index, follow, all'),
        array('name' => 'description', 'content' => $meta_descriptions),
        array('name' => 'keywords', 'content' => $meta_keywords),
		array('name' => 'X-UA-Compatible', 'content' => 'IE=edge', 'type' => 'equiv'),
		array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'),
        array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
    );

	echo meta($meta);
?>
<meta name="format-detection" content="telephone=no" />
<?
 	

        if(!empty($this->data['site_settings']->site_verification)){
          echo '<meta name="google-site-verification" content="'.$this->data['site_settings']->site_verification.'" />';
        }
?>
<!--font section start-->
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Oswald:400,300,700' rel='stylesheet' type='text/css'>
<!--font section end-->

<!--css section start-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url("public/default/css/style.css"); ?>" />
<link href="<?php echo base_url("public/default/css/flexnav.css"); ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url("public/default/css/slider.css"); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url("public/default/css/media.css"); ?>" />
<!--css section end-->

<!--script section start-->
<script src="<?php echo base_url("public/default/js/jquery-1.8.3.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/default/js/jquery.flexnav.min.js"); ?>"></script>
<script type="text/javascript">
	$(function() {
		$(".flexnav").flexNav();
	});
</script>
<script src="<?php echo base_url("public/default/js/responsiveslides.min.js"); ?>"></script>
<script>
  $(function() {
    $(".rslides").responsiveSlides({
		pager: false,
		auto: true,
		nav: true,
speed: 1000,            // Integer: Speed of the transition, in milliseconds
  timeout: 8000          // Integer: Time between slide transitions, in milliseconds
      
		});
  });
</script>
<script type='text/javascript' src='<?php echo base_url("public/default/js/custom.js"); ?>'></script>
<script type="text/javascript" src="//maps.google.com/maps/api/js"></script>
<!--<script type='text/javascript' src='<?php echo base_url("public/default/js/map.js"); ?>'></script> -->
<!--script section end-->
<script>
function bookonlinelink(){
window.location.href = "<?php echo $this->data['site_settings']->book_online_link; ?>";
	
	}
</script>
</head>

<body>
	<!--header section start-->
    <div class="header">
    	<div class="header-top">
        	<div class="wrapper">
            
            	<a href="<?php echo base_url("home"); ?>"><img src="<?php echo file_upload_base_url()."setting_photo/".$this->data['site_settings']->logo_photo;?>" alt="Breakout Escape Rooms" title="Breakout Escape Rooms" class="logo" /></a>
                <!--navigation start-->
                <div class="navigation">
                	<div class="menu-button">Menu</div>
                   
                        
                        <nav> <?php echo $hooks_cmspages_list; ?> 
                         
                        </nav>
                       
                    </nav>
                </div>
                <!--navigation end-->
            </div>
            <div class="clear"></div>
        </div>
        <span class="header-bottom"></span>
    	<div class="clear"></div>
    </div>
    <!--header section end-->
