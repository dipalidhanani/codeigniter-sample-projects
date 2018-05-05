<?php $this->load->view($header); ?>    

    <!--banner section start-->
     <?php if(count($blogbanner_arr) != 0){$blogback = file_upload_base_url()."cmspages/".$blogbanner_arr[0]->banner_photo; } ?>
    <div class="inner-banner blog-banner" id="inner-banner"  style=" <?php if(count($blogbanner_arr) != 0 && $blogbanner_arr[0]->banner_photo != ''){ ?>background-image:url('<?php echo $blogback; ?>'); background-repeat: no-repeat;<?php } ?>">
        <div class="wrapper">
            <h1><?php echo $blogbanner_arr[0]->title; ?></h1>
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
                        <ul class="blog-list" id="itemContainer">
                         <?php foreach($blogs_arr as $row_recent_blogs){ ?>
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
                        <ul class="pagination"></ul>
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
    
        
<?php if(!empty($blogs_arr) && count($blogs_arr) > 6){ ?>
<script type="text/javascript" src="<?php echo base_url("public/js/highlight.pack.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/js/tabifier.js");?>"></script>
<script src="<?php echo base_url("public/js/jPages.js");?>"></script>
<script type="text/javascript">

$(function() {    
$("ul.pagination").jPages({
    containerID: "itemContainer",	
    perPage : 6,
    previous : 'Previous',
    next : 'Next',
    first: 'First',
    last: 'Last',
    minHeight: false
});
});

</script>
<?php } ?>

    <!--content section end-->
  <?php $this->load->view($footer); ?>  
   