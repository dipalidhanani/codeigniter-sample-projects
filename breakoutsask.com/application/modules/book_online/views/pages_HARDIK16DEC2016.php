<?php echo $this->load->view($header); ?>
<?php if(count($this->data['hooks_meta']) != 0){$aboutback = file_upload_base_url()."other_cmspages/".$this->data['hooks_meta']->banner_photo; } ?>
    <div class="inner-banner about-banner" id="inner-banner" style=" <?php if(count($this->data['hooks_meta']) != 0 && $this->data['hooks_meta']->banner_photo != ''){ ?>background-image:url('<?php echo $aboutback; ?>'); background-repeat: no-repeat;<?php } ?>">
    	<div class="wrapper">
            <h1><?php echo $this->data['hooks_meta']->title; ?></h1>
        </div>
    </div>
<!--content section start-->
<div class="content-outer">
<div class="content">
    	<div class="wrapper">
            <!--left section start-->
<div class="content-in">
	<div class="content-wrap online-form">
		<script type="text/javascript" src="https://bookeo.com/widget.js?a=415534KHA6H15107E39485"></script>
        </div>
        <div class="content-wrap">
        <br/><br/>
        <p><?php echo outputEscapeString($this->data['hooks_meta']->content); ?></p>

	</div>

            <!--left section end-->
        </div>
    </div></div></div>
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