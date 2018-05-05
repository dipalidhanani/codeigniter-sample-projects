<?php echo $this->load->view($header); ?>
<?php 
//echo $this->data['hooks_meta']->banner_photo;

if(count($this->data['hooks_meta']) != 0){
  
  if(is_file(file_upload_absolute_path()."other_cmspages/".$this->data['hooks_meta']->banner_photo)){
    $aboutback = file_upload_base_url()."other_cmspages/".$this->data['hooks_meta']->banner_photo; 
  }
  else if(is_file(file_upload_absolute_path()."cmspages/".$this->data['hooks_meta']->banner_photo)){
    $aboutback = file_upload_base_url()."cmspages/".$this->data['hooks_meta']->banner_photo; 
  }
  else
      $aboutback = '';  
} ?>
    <div class="inner-banner about-banner" id="inner-banner" style=" <?php if(!empty($aboutback)){ ?>background-image:url('<?php echo $aboutback; ?>'); background-repeat: no-repeat;<?php } ?>">
    	<div class="wrapper">
            <h1><?php echo $this->data['hooks_meta']->title; ?></h1>
        </div>
    </div>
<!--content section start-->
  <div class="content-outer">
    	<div class="content">
        	<div class="wrapper">
            	<div class="content-in">
            <!--left section start-->
            <div class="inner-left">
				<p><?php echo outputEscapeString($this->data['hooks_meta']->content); ?></p>
             </div>
            <!--left section end-->
            <!--right section start-->
          <?php  if($this->data['hooks_meta']->parent_id != 0){?>
         
                    <div class="inner-right blog-right">
                    	<h3><?php echo $parentpage->title; ?></h3>
                        <ul class="right-list">
                        <?php foreach($subpages as $row_subpages){ ?>
                        	<li><a href="<?php echo site_url("pages/".$row_subpages->page_link); ?>"><?php echo $row_subpages->title; ?></a></li>
                            <?php } ?>
                           
                        </ul>
                    </div>
                    <?php } ?>
                    <!--right section end-->
       <div class="clear"></div>
                </div>
            </div>
            <span class="blog-bottom"></span>
        </div>
    </div>
    <?php /*?><div class="content">
    	<div class="wrapper">
            <!--left section start-->
            <div class="inner-left">

                <h2><?php echo $this->data['hooks_meta']->title; ?></h2>
                <?php echo outputEscapeString($this->data['hooks_meta']->content); ?>
                
            </div>
            <!--left section end-->
        </div>
    </div><?php */?>
    <!--content section end -->

<?php echo $this->load->view($footer); ?>