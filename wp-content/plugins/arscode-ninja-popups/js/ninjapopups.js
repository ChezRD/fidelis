/*!
 * Ninja Popups for WordPress
 * http://codecanyon.net/item/ninja-popups-for-wordpress/3476479?ref=arscode
 *
 * Copyright 2014, ARSCode
 */
function snp_set_cookie(name,value,expires)
{
	if(expires!=-1)
	{
		expires=expires*1;
		var args = {path: '/', expires: expires};
	}
	else
	{
		var args = {path: '/'};
	}
	if (!snp_ignore_cookies)
	{
		jQuery.cookie(name, value, args);
	}
}
function snp_onsubmit(form)
{
	var popup=jQuery('#snp_popup').val();
	var popup_ID=parseInt(jQuery('#snp_popup_id').val());
	if(!popup_ID)
	{
		popup_ID=form.parents('.snppopup').find('.snp_popup_id').val();
	}
	var snp_optin_redirect_url=form.parents('.snppopup').find('.snp_optin_redirect_url').val();
	if(form.attr('action')=='#')
	{
		var submit_button = jQuery(":submit",form);
		var submit_button_width = jQuery(":submit",form).outerWidth();
		var text_loading = submit_button.data('loading');
		var text_success = submit_button.data('success');
		var text_submit = submit_button.text() ? submit_button.text() : submit_button.val();
		if(text_loading)
		{
		    submit_button.css('min-width',submit_button_width);
		    submit_button.text(text_loading);
		    submit_button.val(text_loading);
		}
		data = {};
		data['action'] = 'snp_popup_submit';
		data['popup_ID'] = popup_ID;
		jQuery('input, select, textarea', form).each(function(key) 
		{
			data[this.name] = this.value;
		});
		jQuery.ajax({
			url: snp_ajax_url, 
			type: 'POST',
			dataType: 'json',
			data: data, 
			success: function(data){
				jQuery("input",form).removeClass('snp-error');
				if(data.Ok==true)
				{
					snp_onconvert('optin',popup_ID);
					if(snp_optin_redirect_url)
					{
						document.location.href=snp_optin_redirect_url;
					}
					if(text_success)
					{
					    submit_button.text(text_success);
					    submit_button.val(text_success);
					    setTimeout("jQuery.fancybox2.close();", 800);
					}
					else
					{
					    jQuery.fancybox2.close();
					}
				}
				else
				{
					if(data.Errors)
					{
						jQuery.each(data.Errors, function(index, value) { 
							jQuery("input[name='"+index+"']",form).addClass('snp-error');
						});	
					}
					if(text_loading)
					{
					    submit_button.text(text_submit);
					    submit_button.val(text_submit);
					}
				}
			}
		});
		return false;
	}
	else
	{
		var Error=0;
		jQuery('input[type="text"]', form).each(function(key) 
		{
			if(!this.value)
			{
				Error=1;
				jQuery(this).addClass('snp-error');
			}
			else
			{
				jQuery(this).removeClass('snp-error');
			}
		});
		if(Error==1)
		{
			return false;
		}
		if(form.attr('target')=='_blank')
		{
			jQuery.fancybox2.close();
		}
		if(snp_optin_redirect_url)
		{
			document.location.href=snp_optin_redirect_url;
		}
		snp_onconvert('optin',popup_ID);
		return true;
	}
}
function snp_onconvert(type,popup_ID)
{
	var popup=jQuery('#snp_popup').val();
	if(!popup_ID)
	{
		var popup_ID=parseInt(jQuery('#snp_popup_id').val());
	}
	if(popup)
	{
		var cookie_conversion=jQuery('#'+popup+' .snp_cookie_conversion').val();
		if(!cookie_conversion)
		{
			cookie_conversion=30;
		}
		snp_set_cookie('snp_'+popup, '1',cookie_conversion);
	}
	jQuery.post(
	snp_ajax_url, 
	{
		'action': 'snp_popup_stats',
		'type': type,
		'popup_ID' : popup_ID
	});
	if(type!='optin')
	{
		var snp_optin_redirect_url=jQuery('#'+popup).find('.snp_optin_redirect_url').val();
		if(snp_optin_redirect_url)
		{
			document.location.href=snp_optin_redirect_url;
		}
	}
	jQuery.fancybox2.close();
}
function snp_onshare_li()
{
	snp_onconvert('li',0);
}
function snp_onshare_gp()
{
	snp_onconvert('gp',0);
}
function snp_onclose_popup()
{
	var popup=jQuery('#snp_popup').val();
	var cookie_close=jQuery('#'+jQuery('#snp_popup').val()+' .snp_cookie_close').val();
	if(!jQuery.cookie('snp_'+popup))
	{
		if(!cookie_close)
		{
			cookie_close=-1;	
		}
		snp_set_cookie('snp_'+popup, '1', cookie_close);
	}
	if(jQuery('#snp_exithref').val())
	{
		// exit popup
		//if(jQuery('#snp_exittarget').val()=='_blank')
		//{
		//	window.open(jQuery('#snp_exithref').val());	
		//}
		//else
		//{
		document.location.href=jQuery('#snp_exithref').val();
		//}
	}
	jQuery('.fancybox-overlay').removeClass('snp-pop-'+jQuery('#snp_popup_id').val()+'-overlay');
	jQuery('.snp-wrap').removeClass('snp-pop-'+jQuery('#snp_popup_id').val()+'-wrap');
	jQuery('#snp_popup_theme').val('');
	jQuery('#snp_popup').val('');
	jQuery('#snp_popup_id').val('');
	jQuery('#snp_exithref').val('');
	jQuery('#snp_exittarget').val('');
}
function snp_onstart_popup()
{
	jQuery('.fancybox-overlay').addClass('snp-pop-'+jQuery('#snp_popup_id').val()+'-overlay');
	jQuery('.snp-wrap').addClass('snp-pop-'+jQuery('#snp_popup_id').val()+'-wrap');
	jQuery('.snp-wrap').addClass('snp-pop-'+jQuery('#snp_popup_theme').val()+'-wrap');
	jQuery.post(
	snp_ajax_url, 
	{
		'action': 'snp_popup_stats',
		'type': 'view',
		'popup_ID' : jQuery('#snp_popup_id').val()
	});
}
function snp_open_popup(href,target,popup,type)
{
	if(jQuery.fancybox2.isOpen)
	{
		return;
	}
	if (snp_ignore_cookies || type=='content')
	{
	}
	else
	{
		if(jQuery.cookie('snp_'+popup)==1){return true;}
	}
	var snp_autoclose=parseInt(jQuery('#'+popup+' .snp_autoclose').val());
	var snp_show_cb_button=jQuery('#'+popup+' .snp_show_cb_button').val();
	if(snp_autoclose)
	{
		snp_timer=setTimeout("jQuery.fancybox2.close()",snp_autoclose*1000);
		jQuery('#'+popup+' input').focus(function() {clearTimeout(snp_timer);});
	}
	var snp_overlay=jQuery('#'+popup+' .snp_overlay').val();
	jQuery('#snp_popup').val(popup);
	jQuery('#snp_popup_id').val(jQuery('#'+popup+' >  .snp_popup_id').val());
	jQuery('#snp_popup_theme').val(jQuery('#'+popup+' >  .snp_popup_theme').val());
	jQuery('#snp_exithref').val(href);
	jQuery('#snp_exittarget').val(target);
	var overlay_css = {};
	if(snp_overlay=='disabled')
	{	
		overlay_css.background='none';
	}
	jQuery.fancybox2({
		'href' : '#'+popup,
		'helpers': {
			'overlay' : {
				'locked' : false,
				'closeClick' : false,
				'showEarly' : false,
				'speedOut'   : 5,
				'css' : overlay_css
			}
		},
		'padding': 0,
		'centerOnScroll' : true,
		'autoDimensions' : true,
		'titleShow' : false,
		//'openEffect': 'none',
		'closeBtn' : (snp_show_cb_button=='yes' ? true : false),
		'keys' : {
			'close'  : (snp_show_cb_button=='yes' ? [27] : '')
		},
		'showNavArrows' : false,
		'wrapCSS' : 'snp-wrap',
		'afterClose' : function (){return snp_onclose_popup()},
		'beforeShow' : function (){return snp_onstart_popup()}
	});
	if(jQuery('#'+popup+' .snp-subscribe-social').length>0)
	{
		if (typeof FB != 'undefined') {
			FB.Event.subscribe('edge.create',function() {
				snp_onconvert('fb',0);
			});
		}
		if (typeof twttr != 'undefined') {
			twttr.events.bind('tweet', function(event) {
				snp_onconvert('tw_t',0);
			});
			twttr.events.bind('follow', function(event) {
				snp_onconvert('tw_f',0);
			});
		}
		jQuery("#"+popup+" a.pin-it-button").click(function(){
			snp_onconvert('pi',0);
		});
	}
	return false;
}