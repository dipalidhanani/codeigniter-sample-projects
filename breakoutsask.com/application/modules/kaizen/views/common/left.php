<?php 
$fetch_class =  $this->router->fetch_class(); 
$comp_arr = array(
                    'calltoaction' => 'calltoaction',
                    'contact' => 'contact',
                    'service_component' => 'service_component',
                    'commonbanner' => 'commonbanner',
                    'interestedoption' => 'interestedoption',
                    
            );
$active_cls = '';
if(in_array($fetch_class,$comp_arr)){
    $active_cls = "active";
}

?>
<div class="leftDiv">
	<ul class="cat-list">
                    <li class="listing-dashboard">
                        <a href="<?php echo site_url("kaizen/main/"); ?>" <?php if(!empty($fetch_class) && $fetch_class == "main"){ ?> class="active" <?php } ?>  >Dashboard</a>
                    </li>
                    
                   
                    <li class="listing-web">
                    	<a href="<?php echo site_url("kaizen/cms/");?>" <?php if(!empty($fetch_class) && $fetch_class == "cms"){ ?> class="active" <?php } ?>>Pages</a>
                        
                    </li>
                    <li class="listing-web">
                    	<a href="<?php echo site_url("kaizen/other_cms/");?>" <?php if(!empty($fetch_class) && $fetch_class == "other_cms"){ ?> class="active" <?php } ?>>Inner Pages</a>
                        
                    </li>
                    <li class="listing-web">
                    	<a href="<?php echo site_url("kaizen/settings/");?>" class="setting <?php if(!empty($fetch_class) && $fetch_class == "settings"){ echo "active" ; } ?>">Website Settings</a>
                        
                    </li>
                    <li class="listing-communication">
                    	<a href="javascript:void(0)">Components<span class="listing-arrow"></span></a>
                        <div style="<?php if(!empty($active_cls)){ echo 'display:block;'; }?>" class="cat-cont">
                            <ul class="category_sub_list">
                             <li><a href="<?php echo site_url("kaizen/homepage_component/dolist"); ?>" class="<?php if(!empty($active_cls) && ($fetch_class == "homepage_component")){ echo "active" ; } ?>">Homepage Component</a></li>
                             <li><a href="<?php echo site_url("kaizen/theme_rooms/dolist"); ?>" class="<?php if(!empty($active_cls) && ($fetch_class == "theme_rooms")){ echo "active" ; } ?>">Theme Rooms</a></li>                               
                                <li><a href="<?php echo site_url("kaizen/contact"); ?>" class="<?php if(!empty($active_cls) && ($fetch_class == "contact")){ echo "active" ; } ?>">Contact</a></li>                                
                             
                            </ul>
                        </div>
                    </li>
                    <li class="listing-members">
                    	<a href="javascript:void(0)">News<span class="listing-arrow"></span></a>
                        <div class="cat-cont" style="">
                        	<ul class="category_sub_list">
                                <li><a href="<?php echo site_url("kaizen/news_posts"); ?>">News</a></li>
                                <li><a href="<?php echo site_url("kaizen/news_category/dolist/");?>">News Category</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="listing-web">
                    	<a href="<?php echo site_url("kaizen/faq"); ?>" <?php if(!empty($fetch_class) && $fetch_class == "faq"){ ?> class="active" <?php } ?>>FAQs</a>
                    </li>
                </ul>
</div>

<!--left column end-->