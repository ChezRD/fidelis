<div class="snp-fb snp-newtheme2">
    <header>
	<?php
	if(!empty($POPUP_META['snp_header']))
	{
	    echo '<h2>'.$POPUP_META['snp_header'].'</h2>'; 
	}
	?> 
	<?php
	if(!empty($POPUP_META['snp_img']))
	{
	    echo '<p><img src="'.$POPUP_META['snp_img'].'" alt=""></p>'; 
	}
	?> 
    </header>
	<?php
    if ($POPUP_META['snp_show_cb_button'] == 'yes')
	{
		echo '<a class="snp-close snp_nothanks" href="#"></a>';
	}
	?>
    <div class="snp-newsletter-content">
	<?php
	if(!empty($POPUP_META['snp_subheader']))
	{
	    echo '<h2>'.$POPUP_META['snp_subheader'].'</h2>'; 
	}
	if(!empty($POPUP_META['snp_maintext']))
	{
	    echo '<p>'.$POPUP_META['snp_maintext'].'</p>'; 
	}
	?> 
	<form action="<?php if(snp_get_option('ml_manager') == 'html'){echo snp_get_option('ml_html_url');}else{echo '#';}?>" method="post" class="snp-subscribeform snp_subscribeform"<?php if(snp_get_option('ml_manager') == 'html' && snp_get_option('ml_html_blank')){echo ' target="_blank"';}?>>
	    <?php if(snp_get_option('ml_manager') == 'html'){echo snp_get_option('ml_html_hidden');}?>
            <div>
		<?php
		if(isset($POPUP_META['snp_cf']))
		{
		    $name_field =  '<input type="text" name="'.((snp_get_option('ml_manager') == 'html' && snp_get_option('ml_html_name')) ? snp_get_option('ml_html_name') : 'name').'" id="snp-name" placeholder="'.$POPUP_META['snp_name_placeholder'].'" class="snp-field snp-field-name" />';
		    $email_field = '<input type="text" name="'.((snp_get_option('ml_manager') == 'html' && snp_get_option('ml_html_email')) ? snp_get_option('ml_html_email') : 'email').'" id="snp_email" placeholder="'.$POPUP_META['snp_email_placeholder'].'"  class="snp-field snp-field-email" />';
		    $tpl_field = '%FIELD%';
		     snp_custom_fields(unserialize($POPUP_META['snp_cf']),array(
			 'email_field' => $email_field,
			 'name_field' => $name_field,
			 'tpl_field' => $tpl_field,
			 'snp_name_disable' => $POPUP_META['snp_name_disable']
		     )); 
		}
		?>
            </div>
            <input type="submit" class="snp-subscribe-button snp-submit" data-loading="<?php echo $POPUP_META['snp_submit_button_loading'];?>" data-success="<?php echo $POPUP_META['snp_submit_button_success'];?>" value="<?php echo $POPUP_META['snp_submit_button'];?>">
	</form>
	<?php
	if (!empty($POPUP_META['snp_security_note']))
	{
		echo '<p><small><img src="'.SNP_URL.'themes/newtheme2/img/lock.png" alt="">'.$POPUP_META['snp_security_note'].'</small></p>';
	}
	?>
    </div>
</div>
<?php
if(isset($POPUP_META['snp_header_font']))
{
	$POPUP_META['snp_header_font']=unserialize($POPUP_META['snp_header_font']);
}
if(isset($POPUP_META['snp_subheader_font']))
{
	$POPUP_META['snp_subheader_font']=unserialize($POPUP_META['snp_subheader_font']);
}
if(isset($POPUP_META['snp_maintext_font']))
{
	$POPUP_META['snp_maintext_font']=unserialize($POPUP_META['snp_maintext_font']);
}
echo '<style>';
if (!empty($POPUP_META['snp_width']))
{
	echo '.snp-pop-'.$ID.' .snp-newtheme2 { width: '.$POPUP_META['snp_width'].'px;}'."\n";
}
if (!empty($POPUP_META['snp_height']))
{
	echo '.snp-pop-'.$ID.' .snp-newtheme2 { min-height: '.$POPUP_META['snp_height'].'px;}'."\n";
}
if (!empty($POPUP_META['snp_header_font']['size']))
{
	echo '.snp-pop-'.$ID.' .snp-newtheme2 h2 {font-size: '.$POPUP_META['snp_header_font']['size'].'px; color: '.$POPUP_META['snp_header_font']['color'].';}'."\n";
}
if (!empty($POPUP_META['snp_subheader_font']['size']))
{
	echo '.snp-pop-'.$ID.' .snp-newtheme2 .snp-newsletter-content h2 {font-size: '.$POPUP_META['snp_subheader_font']['size'].'px;}'."\n";
	echo '.snp-pop-'.$ID.' .snp-newtheme2 .snp-newsletter-content h2 {color: '.$POPUP_META['snp_subheader_font']['color'].';}'."\n";
}
if (!empty($POPUP_META['snp_maintext_font']['size']))
{
	echo '.snp-pop-'.$ID.' .snp-newtheme2 .snp-newsletter-content p {font-size: '.$POPUP_META['snp_maintext_font']['size'].'px;}'."\n";
	echo '.snp-pop-'.$ID.' .snp-newtheme2 .snp-newsletter-content p {color: '.$POPUP_META['snp_maintext_font']['color'].';}'."\n";
}
if (!empty($POPUP_META['snp_submit_button_text_color']))
{
    	echo '.snp-pop-'.$ID.' .snp-newtheme2 .snp-submit { color: '.$POPUP_META['snp_submit_button_text_color'].';}'."\n";
}
if (!empty($POPUP_META['snp_submit_button_color']))
{
    	echo '.snp-pop-'.$ID.' .snp-newtheme2 .snp-submit { background-color: '.$POPUP_META['snp_submit_button_color'].';}'."\n";
	echo '.snp-pop-'.$ID.' .snp-newtheme2 .snp-newsletter-content h2:before { background-color: '.$POPUP_META['snp_submit_button_color'].';}'."\n";
}
if (!empty($POPUP_META['snp_submit_button_shadow_color']))
{
    	echo '.snp-pop-'.$ID.' .snp-newtheme2 form input[type="submit"] { -webkit-box-shadow: 4px 4px 0 '.$POPUP_META['snp_submit_button_shadow_color'].'; -moz-box-shadow: 4px 4px 0 '.$POPUP_META['snp_submit_button_shadow_color'].'; box-shadow: 4px 4px 0 '.$POPUP_META['snp_submit_button_shadow_color'].';}'."\n";
	echo '.snp-pop-'.$ID.' .snp-newtheme2 form input[type="submit"]:hover { -webkit-box-shadow: 0 0 0 '.$POPUP_META['snp_submit_button_shadow_color'].'; -moz-box-shadow: 0 0 0 '.$POPUP_META['snp_submit_button_shadow_color'].'; box-shadow: 0 0 0 '.$POPUP_META['snp_submit_button_shadow_color'].';}'."\n";
}

if (!empty($POPUP_META['snp_bg_color1']))
{
    	echo '.snp-pop-'.$ID.' .snp-newtheme2 { background: '.$POPUP_META['snp_bg_color1'].';}'."\n";
}
if (!empty($POPUP_META['snp_bg_color2']))
{
    	echo '.snp-pop-'.$ID.' .snp-newtheme2 header { background: '.$POPUP_META['snp_bg_color2'].';}'."\n";
	echo '.snp-pop-'.$ID.' .snp-newtheme2 { border-bottom: 4px solid '.$POPUP_META['snp_bg_color2'].';}'."\n";
	echo '.snp-pop-'.$ID.' .snp-newtheme2 .snp-newsletter-content:before { border-top: 20px solid '.$POPUP_META['snp_bg_color2'].';}'."\n";
}
if (!empty($POPUP_META['snp_bg_color3']))
{
    	echo '.snp-pop-'.$ID.' .snp-newtheme2 .snp-newsletter-content { background: '.$POPUP_META['snp_bg_color3'].';}'."\n";
	echo '.snp-pop-'.$ID.' .snp-newtheme2 .snp-newsletter-content:before { border-left: 20px solid '.$POPUP_META['snp_bg_color3'].'; border-right: 20px solid '.$POPUP_META['snp_bg_color3'].';}'."\n";
}

echo '</style>';