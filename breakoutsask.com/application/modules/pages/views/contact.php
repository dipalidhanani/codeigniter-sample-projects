<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view($header);
?>
 <div class="inner-wrappr-outer">
    	<div class="wrapper">
        	<ul class="contact-list">
                <?php if(!empty($contact->phone)){ ?>
                    <li>
                        <img class="contact-icon" title="" alt="" src="<?php echo base_url() ?>public/default/images/contact-phn-icon.png">
                        <p><?php echo $contact->phone; ?></p>
                    </li>
                <?php } ?>
                <?php if(!empty($contact->email)){ ?>
                    <li>
                        <img class="contact-icon" title="" alt="" src="<?php echo base_url() ?>public/default/images/contact-email-icon.png">
                        <p><?php echo $contact->email; ?></p>
                    </li>
                <?php } ?>
                <?php if(!empty($contact->address)){ ?>
                    <li>
                        <img class="contact-icon" title="" alt="" src="<?php echo base_url() ?>public/default/images/contact-map-icon.png">
                        <p><?php echo nl2br($contact->address); ?></p>
                    </li>
                <?php } ?>
            </ul>
        <?php if(!empty($contact->is_shown_map)){ ?>
            <!--map section start -->
           <div class="map-sec">
                   <iframe src="<?php echo site_url("common/google_map/");?>" frameborder="0" style="border:0; width: 100%;height: 100%;" allowfullscreen></iframe>
           </div>
            <!--map section start -->
        <?php } ?>
         <!--form section start -->
         	<div class="contact-form">
            	<h3><?php echo outputEscapeString($this->data['hooks_meta']->content); ?></h3>
                <form action="#" method="post">
                <div class="com-se">
                	<input type="text" id="name" name="name" value="First name *">
                	<input type="text" id="lname" name="lname" value="Last name *">
                	<input type="email" id="email" name="email" value="Email *">
                </div>
                 <div class="com-se">
                 	<textarea id="message" name="message">Message</textarea>
                 </div>
                <?php /*?><?php if(!empty($interestedoption)){ ?>
                  <div class="com-se">
                  	<label>I am interested in...</label>
                  </div>
                  <div class="com-se">
                      
                    <?php foreach($interestedoption as $intc){ ?>
                        <div class="checkBox">
                            <label>
                                <input type="checkbox" id="checkbox<?php echo $intc->id; ?>" name="checkbox<?php echo $intc->id; ?>">
                                    <?php echo $intc->title; ?>
                            </label>
                        </div>
                    <?php } ?>
                   
                  </div>
                <?php } ?><?php */?>
                   <div class="submit-button-sec">
                    	<input type="submit" class="submit-button" value="Send">
                    </div>
                </form>
            </div>
         <!--form section end -->
         <!--join us section start -->
         	<div class="join-us">
            	<h3>Join us around the web</h3>
                 <ul class="ft-social">
                     <?php echo socialLinks(); ?>
                </ul>
            </div>
         <!--join us section -->
        </div>
        </div>
<?php
$this->load->view($footer);/*end*/