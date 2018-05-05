<?php $this->load->view($header); ?>    

     <!--banner section start-->
    <div class="inner-banner blog-banner" id="inner-banner">
        <div class="wrapper">
            <h1>Blog</h1>
        </div>
    </div>
    <!--banner section end-->
    
    <!--content section start-->
    <div class="content-outer">
    	<div class="content">
        	<div class="wrapper">
            	<div class="content-in">
                	<!--left section start-->
                    <div class="inner-left blog-left">
                       	<h2><?php echo $single_blog_arr[0]->title; ?></h2>
                        <ul class="blog-catlist">
                        	<li><?php echo date('M d, Y',strtotime($single_blog_arr[0]->create_dt)); ?></li>
                            <li>|</li>
                            <li><?php echo $single_blog_arr[0]->posted_by; ?></li>
                        </ul>
                        <?php if($single_blog_arr[0]->banner_photo != ''){ ?>
                        <img src="<?php echo file_upload_base_url()."news_posts/".$single_blog_arr[0]->banner_photo; ?>" alt="" title="" class="blog-detail-pic" />
                        <?php } ?>
                        <p><?php echo $single_blog_arr[0]->description; ?></p>
                        <div class="blog-detail-but">
                        <?php 
						$nextquery = $this->db->get_where($this->db->dbprefix('news_post'), array('id' => ($single_blog_arr[0]->id+1)));
				
						$next_no_record=$nextquery->num_rows();
						
						$prevquery = $this->db->get_where($this->db->dbprefix('news_post'), array('id' => ($single_blog_arr[0]->id-1)));
				
						$prev_no_record=$prevquery->num_rows();
					
						 ?>
                        	<?php if($prev_no_record > 0){ ?> <a href="<?php echo site_url("blog/blog_detail/".($single_blog_arr[0]->id-1));?>" class="prev">Previous</a><?php } ?>
                           <?php if($next_no_record > 0){ ?> <a href="<?php echo site_url("blog/blog_detail/".($single_blog_arr[0]->id+1));?>" class="next">Next</a> <?php } ?>
                        </div>
                    </div>
                    <!--left section end-->
                    
                    <!--right section start-->
                    <div class="inner-right blog-right">
                    	<a href="<?php echo site_url("blog");?>"><h3>Categories</h3></a>
                        <ul class="right-list">
                         <?php foreach($blog_category_arr as $row_blog_category){ ?>
                        	<li><a href="<?php echo site_url("blog/category/".$row_blog_category->id);?>"><?php echo $row_blog_category->title; ?></a></li>
                         <?php } ?>                           
                        </ul>
                    </div>
                    <!--right section end-->
                    
                	<div class="clear"></div>
                </div>
            </div>
            <span class="blog-bottom"></span>
        </div>
    </div>
    <!--content section end-->
  <?php $this->load->view($footer); ?>  
   