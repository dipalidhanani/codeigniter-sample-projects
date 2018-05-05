<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view($header);

?>
 <div class="gray-who-are inner-who" style="min-height: 300px;">
        	<!--wrapper section start -->
            	<div class="wrapper">
                	<h2><?php echo $page_data->title; ?></h2>
                     <p>   <?php if(!empty($page_data->content)) echo outputEscapeString($page_data->content);?></p>
                   
                </div>
            <!--wrapper section end -->
        </div>
<?php
$this->load->view($footer);/*end*/