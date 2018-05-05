<?php echo $this->load->view($header); ?>
    <!--content section start-->
    <div class="content">
    	<div class="wrapper">
            <!--left section start-->
            <div class="inner-left">
                <h2><?php echo $this->data['hooks_meta']->title; ?></h2>
                <?php if(!empty($faq_arr)){ ?>
                <div class="faq-search">
                	<form action="<?php echo site_url("pages/faqs");?>" method="post" id="searchFaq">
                    	<input type="text" placeholder="Enter search keyword" id="keyword" name="keyword"  value="<?php if(!empty($keyword)){echo $keyword;}?>"/>
                        <input type="submit" value="Search" />
                    </form>
                </div>
                <ul class="faq-list">
                    <?php foreach($faq_arr as $faq){ ?>
                	<li>
                    	<a href="#"><?php echo $faq->title; ?></a> 
                        <div class="faq-cont">
                        	 <?php echo outputEscapeString($faq->content); ?>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <?php }else{?>
                <ul class="faq-list">
                	<li>FAQ'S Not available</li>
                </ul>
                <?php } ?>
            </div>
            <!--left section end-->
            
            <?php echo $this->load->view($common_right); ?>
        </div>
    </div>
    <!--content section end-->
<?php echo $this->load->view($footer); ?>