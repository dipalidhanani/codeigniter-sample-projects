<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view($header);
//echo "<pre>";print_r($processcomponent);
?>
 <div class="gray-who-are inner-who">
        	<!--wrapper section start -->
            	<div class="wrapper">
                	<h2>Who We Are</h2>
                     <?php if(!empty($this->data['hooks_meta']->content)) echo outputEscapeString($this->data['hooks_meta']->content);?>
                   
                </div>
            <!--wrapper section end -->
        </div>
<div id="our-team">
             <div class="wrapper">
             	<h2>Our Team</h2>
                <div class="ourTeam">
            	<ul>
                	  <?php if(!empty($teamcomponent)){
					
					foreach($teamcomponent as $val){
					?>
                	<li>
                    	<div class="imgDiv">
                        	<a href="#"><img src="<?php echo base_url(); ?>public/default/images/our-team-1.jpg" alt="" title=""></a>
                        </div>
                        <h3><?php echo $val->title;?> <span><?php echo $val->designation;?></span></h3>
                        <?php echo $val->description;?>
                    </li>
                    <?php }}?> 
                	
                	
                	
                	
                    
                </ul>
            </div>
             </div>
            </div>
<div class="staffPicks">
        	<div class="wrapper">
            	<h2>Staff Picks</h2>
                <img src="<?php echo base_url(); ?>public/default/images/safft-Carousel.jpg">
            </div>
        </div>
<div class="inner-our-process">
        	<div class="wrapper">
                <h2>Our Process</h2>
                <ul class="process-list">
                
                
                	<!--<li><div class="circle"><span class="vision"></span></div><h3>Vision</h3> <p class="right">Fusce lobortis suscipit sem id mattis eros mattis eu. Interdum et malesuada fames ac ante ipsum primis in faucibus donec in nibh massa etiam ut tempor ex nunc mi est, porta vel urna sagittis tincidunt scelerisque velit. Ut pharetra finibus neque in pulvinar sapien bibendum vel.
Nullam ornare laoreet lacus et hendrerit turpis tincidunt.</p></li>-->


 <?php if(!empty($processcomponent)){
					$ps=1;
					foreach($processcomponent as $pval){
					?>
                	<li>
                    	<div class="circle"><span class="create"   style="background: rgba(0, 0, 0, 0) url(<?php echo base_url()?>public/uploads/process_component_photo/<?php echo $pval->regular_icon;?>) no-repeat scroll center center;"></span></div>
                        <h3><?php echo $pval->title;?></h3>
                        <p class="<?php if($ps%2==0) echo "left"; else echo 'right';?>">
                        <?php echo $pval->description;?>
                        </p>
                    </li>
                     <li class="sapa">&nbsp;</li>
                    <?php  $ps++;}}?> 

                  
                </ul>
               
           </div>
        </div>
<div id="lets-begin">
        	<div class="wrapper">
            	<h2>Want to work with us?</h2>
                <a class="readmore" href="services.html">Let’s Begin</a>
            
            </div>
        </div>
<?php
$this->load->view($footer);/*end*/