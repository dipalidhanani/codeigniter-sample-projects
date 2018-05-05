<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view($header);
//echo "<pre>";print_r($servicecomponent);
?>
<div class="ser-cont">
        	<ul>
            
            
             <?php if(!empty($servicecomponent)){
					$ps=1;
					foreach($servicecomponent as $pval){
						
						if($ps%2!=0){
					?>
            	<li>
                    <div class="ser-cont-left">
                    <?php if($pval->service_component_image!=''){?>
                    	<img src="<?php echo base_url(); ?>public/default/images/<?php echo $pval->service_component_image;?>">
                    <?php }else if($pval->service_component_video!=''){?>
                    <div class="video-iframe-right"><iframe frameborder="0" allowtransparency="1" allowfullscreen="1" src="http://<?php echo $pval->service_component_video;?>"></iframe></div>
                     <?php }?>
                    </div>
                    <div class="ser-cont-right">
                    	<div class="portfolio-detail-right">
                            <div class="portfolio-detail-outer">
                                <div class="portfolio-detail-middle">
                                    <div class="portfolio-detail-in">
                                        <h2><span><?php echo $pval->title;?></span>Design</h2>
                                       <?php echo $pval->description;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </li>
               
                <?php }else{
					?>
               
               
            	<li>
                    <div class="ser-cont-left">
                    	<div class="portfolio-detail-left">
                            <div class="portfolio-detail-outer">
                                <div class="portfolio-detail-middle">
                                    <div class="portfolio-detail-in">
                                        <h2><?php echo $pval->title;?></h2>
                                        <?php echo $pval->description;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ser-cont-right">
                    	 <?php if($pval->service_component_image!=''){?>
                    	<img src="<?php echo base_url(); ?>public/default/images/<?php echo $pval->service_component_image;?>">
                    <?php }else if($pval->service_component_video!=''){?>
                    <div class="video-iframe-right"><iframe frameborder="0" allowtransparency="1" allowfullscreen="1" src="http://<?php echo $pval->service_component_video;?>"></iframe></div>
                     <?php }?>
                    </div>
               </li>
               
               
                <?php }$ps++;}}?>
               
            </ul>
        </div>
<div class="service-lets-begin" id="lets-begin">
        	<div class="wrapper">
            	<h2>Interested in our services?</h2>
                <div class="form-section">
                    <form action="#" method="post">
                   	<div class="com-sec-serivce">
                    	<input type="text" id="name" name="name" value="Name *">
                    	<input type="text" id="email" name="email" value="Email *">
                    	<input type="text" id="phone" name="phone" value="Phone">
                    </div>
                  <div class="com-sec-serivce">
                  	<textarea name="message" id="message">Message</textarea>
                  </div>
                  <div class="com-sec-serivce captasec">
                  	<div class="captcha">
                    	<img src="<?php echo base_url(); ?>public/default/images/capta.jpg">
                    </div>
                    <input type="submit" value="Submit" class="submit-button">
                  </div>
                   </form>
           		  </div>
            </div>
        </div>
<?php
$this->load->view($footer);/*end*/