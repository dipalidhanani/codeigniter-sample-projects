<?php $this->load->view($header); ?>    
   <!--banner section start-->
   <?php if(count($faqbanner_arr) != 0){$faqback = file_upload_base_url()."cmspages/".$faqbanner_arr[0]->banner_photo; } ?>
    <div class="inner-banner faq-banner" id="inner-banner" 
     style=" <?php if(count($faqbanner_arr) != 0 && $faqbanner_arr[0]->banner_photo != ''){ ?>background-image:url('<?php echo $faqback; ?>'); background-repeat: no-repeat;<?php } ?>">
    	<div class="wrapper">
        	<h1><?php echo $faqbanner_arr[0]->title; ?></h1>
        </div>
    </div>
    <!--banner section end-->
    
    <!--content section start-->
    <div class="content-outer">
    	<div class="content">
        	<div class="wrapper">
            	<div class="content-in">
                	<!--left section start-->
                    <div class="inner-left">
                    	<h2>Frequently Asked Questions ?</h2>
                        
                        <?php foreach($faq_categories_arr as $row_faq_categories){ ?>
                        <div class="faq-blocks">
                        	<h3><?php echo $row_faq_categories->faqcategories_title; ?></h3>
                            <?php $query = $this->db->query("SELECT * FROM `".$this->db->dbprefix('faq')."` where is_active = 'Active' and cat_id = '".$row_faq_categories->id."' order by display_order asc");
							$arr_faqs = $query->result();
							if(count($arr_faqs) > 0){
							 ?>
                            <ul class="faq-list">
                            <?php
							foreach($arr_faqs as $row_faqs){
							
							?>
                            	<li>
                                	<a href="#"><?php echo $row_faqs->title; ?></a>
                                    <div class="faq-cont">
                                    	<p><?php echo $row_faqs->content; ?></p>
                                    </div>
                                </li>
                           <?php } ?>
                            </ul>
                            <?php } ?>
                        </div>
                        
                        <?php } ?>
                        
                    </div>
                    <!--left section end-->
                    
                    <!--right section start-->
                    <div class="inner-right">
                    	<a href="<?php echo site_url('faq'); ?>" ><h3>FAQ Categories</h3></a>
                        <ul class="right-list">
                        <?php foreach($allfaq_categories_arr as $row_allfaq_categories){ ?>
                        	<li><a href="<?php echo site_url('faq/index/'.$row_allfaq_categories->id); ?>" ><?php echo $row_allfaq_categories->faqcategories_title; ?></a></li>
                         <?php } ?>
                        </ul>
                    </div>
                    <!--right section end-->
                    
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
       
 
  <?php $this->load->view($footer); ?>  
   