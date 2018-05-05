
<div style="margin-top:20px;border-style: solid;border-width: 1px;padding: 10px 10px 10px;" id="div_<?php echo $count ?>" >
<a href="javascript:void(0);" onclick="closediv('div_<?php echo $count ?>');" style="margin-left: 720px;font-size: 33px;color: red;">X</a>
<h2 style="margin-bottom:10px;">Social Media</h2>

<div class="spacer" style="margin-top: 10px;"></div>
    <div class="applicatio-com dropdownselect">
        <ul>
            <li class="fullWidth">
                <label class="question-label">Select Link<span style="float:none">*</span></label>
       <div class="dropdown">
       <?php if(!empty($social_menus_arr)){ ?>
       <select id="predifine_link_<?php echo $count ?>" name="predifine_link_<?php echo $count ?>"  class="validate['required']">
            <?php  foreach($social_menus_arr as $social){ $diable = ''; ?>
           <?php if(!empty($social_settings_arr)){ ?>
                    <?php foreach($social_settings_arr as $sas){ ?>
                            <?php $diable = ''; 
                                    if($social->id == $sas->social_menus_id){
                                        $diable = "disabled";
                                        break;  
                                    }
                            ?> 
                    <?php } ?>
           <?php } ?>
           <option value="<?php echo $social->id; ?>" <?php if(!empty($predifine_link) && ($predifine_link == $social->id)){ ?>selected="selected"<?php } ?> <?php echo !empty($diable)?$diable:''; ?> <?php if(!empty($diable)){ ?>style="color:red;"<?php } ?>>
                            <?php echo $social->title; ?>
                    </option>
            <?php } ?>
       </select>
       <?php } ?>
       </div>
           </li>
        </ul>
   </div>
    <div class="single-column" >
    	<label class="question-label">Enter Url<span>*</span></label>
        <input style="width:59%;" type="text" name="url_<?php echo $count ?>" id="url_<?php echo $count ?>" value="<?php if(isset($url)){echo $url;}?>" class="inputinpt validate[required,custom[url]]" />
    </div>
    <div class="single-column" >
    	<label class="question-label">Sequence<span>*</span></label>
        <input style="width:59%;" type="text" name="sequence_<?php echo $count ?>" id="sequence_<?php echo $count ?>" value="<?php if(isset($sequence)){echo $sequence;}?>" class="inputinpt validate[required,custom[number]]" />
    </div>
    
<input type="hidden" id="social_settings_id_<?php echo $count ?>" name="social_settings_id_<?php echo $count ?>"  value="<?php echo !empty($social_settings_id)?$social_settings_id:'';  ?>" />

</div>

<script>
    function closediv(id){
        $('#'+id).remove();
    }
</script>