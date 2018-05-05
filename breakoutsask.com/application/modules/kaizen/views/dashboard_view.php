<?php echo $this->load->view($header); ?>
<?php echo $this->load->view($left); ?>
<?php 
$profileid = '115273163';
?>
<div class="rightDiv">
	<div class="right-outer">
    	<div class="right-outer">
		    <h3 class="title">Dashboard</h3>
        <div class="clear"></div>
        <div class="padbot40">
        	<div class="mid-block">
            <div class="members-table" style="padding-top:20px;">
         			<div style="width:100%; text-align:left; border:0px solid red;">
                     <iframe src="http://2webdesign.com/2webanalytics/analytics.php?profile=<?php echo $profileid;?>" scrolling="0" frameborder="0" align="middle" width="95%" height="900" style="margin-left:25px;"></iframe>
         			</div>
            </div>
          </div>
        </div>
        <?php echo $this->load->view($footer); ?>
       </div>
    </div>
</div>
<?php //$this->load->view($cms_header); ?>

    
