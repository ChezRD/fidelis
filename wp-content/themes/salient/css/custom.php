<?php 

function nectar_custom_css() {
	
	ob_start(); 
	
	$options = get_option('salient');
	
	//boxed css
	if(!empty($options['boxed_layout']) && $options['boxed_layout'] == '1')  {
		
		$attachment = $options["background-attachment"];
		$position = $options["background-position"];
		$repeat = $options["background-repeat"];
		$background_color = $options["background-color"];
		
		echo '<style type="text/css">
		 body {
		 	background-image: url("'.$options["background_image"].'");
			background-position: '.$position.';
			background-repeat: '.$repeat.';
			background-color: '.$background_color.'!important;
			background-attachment: '.$attachment.';';
			if(!empty($options["background-cover"]) && $options["background-cover"] == '1') {
				echo 'background-size: cover;
				-moz-background-size: cover;
				-webkit-background-size: cover;
				-o-background-size: cover;';
			}
			
		 echo '} 
		</style>';
	}
	
	//top nav
	
	$logo_height = (!empty($options['use-logo']) && !empty($options['logo-height'])) ? intval($options['logo-height']) : 30;
	$header_padding = (!empty($options['header-padding'])) ? intval($options['header-padding']) : 28;
	$nav_font_size = (!empty($options['use-custom-fonts']) && $options['use-custom-fonts'] == 1 && !empty($options['navigation_font_size']) && $options['navigation_font_size'] != '-') ? intval(substr($options['navigation_font_size'],0,-2) *1.4 ) : 20;
	$dd_indicator_height = (!empty($options['use-custom-fonts']) && $options['use-custom-fonts'] == 1 && !empty($options['navigation_font_size']) && $options['navigation_font_size'] != '-') ? intval(substr($options['navigation_font_size'],0,-2)) -1 : 20;
	
	$padding_top = ceil(($logo_height/2)) - ceil(($nav_font_size/2));
	$padding_bottom = (ceil(($logo_height/2)) - ceil(($nav_font_size/2))) + $header_padding;
	
	$search_padding_top = ceil(($logo_height/2)) - ceil(21/2) +1;
	$search_padding_bottom =  (ceil(($logo_height/2)) - ceil(21/2));
	
	$using_secondary = (!empty($options['header_layout'])) ? $options['header_layout'] : ' ';
	
	if($using_secondary == 'header_with_secondary'){
	 	$header_space = $logo_height + ($header_padding*2) + 34;
	}
	else {
	 	$header_space = $logo_height + ($header_padding*2);
	}
	
	//woo product title
	$wooSocial = ( !empty($options['woo_social']) && $options['woo_social'] == 1 ) ? '1' : '0';
	$wooSocialCount = 0;
	$wooProductTitlePadding = 0;
	
	if($wooSocial == '1') {
		if(!empty($options['woo-facebook-sharing']) && $options['woo-facebook-sharing'] == 1) $wooSocialCount++;
		if(!empty($options['woo-twitter-sharing']) && $options['woo-twitter-sharing'] == 1) $wooSocialCount++;
		if(!empty($options['woo-pinterest-sharing']) && $options['woo-pinterest-sharing'] == 1) $wooSocialCount++;
		
		$wooProductTitlePadding = ($wooSocialCount*45) + 50;
	}
	
	//legacy WP header changes
	if(floatval(get_bloginfo('version')) < "3.8"){
		echo '<style>
		html .admin-bar #header-outer, html .logged-in.buddypress #header-outer { top: 28px; } html .admin-bar #header-outer[data-using-secondary="1"], html .logged-in.buddypress #header-outer[data-using-secondary="1"] { top: 60px; }
		</style>';
	}
	 
	echo '<style type="text/css">
	  
	  #header-outer { padding-top: '.$header_padding.'px; }
	  
	  #header-outer #logo img { height: ' . $logo_height .'px; }

	  header#top nav > ul > li > a {
	  	padding-bottom: '. $padding_bottom .'px;
		padding-top: '. $padding_top .'px;
	  }
	  
	  header#top nav > ul li#search-btn {
	  	 padding-bottom: '. $search_padding_bottom .'px;
		 padding-top: '. $search_padding_top .'px;
	  }

	  header#top .sf-menu > li.sfHover > ul { top: '.$nav_font_size.'px; }

	 .sf-sub-indicator { height: '.$dd_indicator_height.'px; }

	 #header-space { height: '. $header_space .'px;}
	 
	 body[data-smooth-scrolling="1"] #full_width_portfolio .project-title.parallax-effect { top: '.$header_space.'px; }
	 
	 body.single-product div.product .product_title { padding-right:'.$wooProductTitlePadding.'px; }';
	 
	 
	 //nectar slider font calcs
	 $heading_size = (!empty($options['use-custom-fonts']) && $options['use-custom-fonts'] == 1 && $options['nectar_slider_heading_font_size'] != '-') ? intval($options['nectar_slider_heading_font_size']) : 60;
	 $caption_size = (!empty($options['use-custom-fonts']) && $options['use-custom-fonts'] == 1 && $options['home_slider_caption_font_size'] != '-') ? intval($options['home_slider_caption_font_size']) : 24;
	 
	 echo '@media only screen and (min-width: 1000px) and (max-width: 1300px) {
	    .nectar-slider-wrap[data-full-width="true"] .swiper-slide .content h2, 
	    .nectar-slider-wrap[data-full-width="boxed-full-width"] .swiper-slide .content h2,
	    .full-width-content .vc_span12 .swiper-slide .content h2 {
			font-size: ' .$heading_size*0.75 . 'px!important;
			line-height: '.$heading_size*0.85 .'px!important;
		}

		.nectar-slider-wrap[data-full-width="true"] .swiper-slide .content p, 
		.nectar-slider-wrap[data-full-width="boxed-full-width"] .swiper-slide .content p, 
	    .full-width-content .vc_span12 .swiper-slide .content p {
			font-size: ' .$caption_size *0.75 . 'px!important;
			line-height: '.$caption_size *1.3 .'px!important;
		}
	}
	
	@media only screen and (min-width : 690px) and (max-width : 1000px) {
		.nectar-slider-wrap[data-full-width="true"] .swiper-slide .content h2, 
		.nectar-slider-wrap[data-full-width="boxed-full-width"] .swiper-slide .content h2,
	    .full-width-content .vc_span12 .swiper-slide .content h2 {
			font-size: ' .$heading_size*0.55 . 'px!important;
			line-height: '.$heading_size*0.65 .'px!important;
		}

		.nectar-slider-wrap[data-full-width="true"] .swiper-slide .content p, 
		.nectar-slider-wrap[data-full-width="boxed-full-width"] .swiper-slide .content p, 
	    .full-width-content .vc_span12 .swiper-slide .content p {
			font-size: ' .$caption_size *0.55 . 'px!important;
			line-height: '.$caption_size *1 .'px!important;
		}
	}
	
	@media only screen and (max-width : 690px) {
		.nectar-slider-wrap[data-full-width="true"][data-fullscreen="false"] .swiper-slide .content h2, 
		.nectar-slider-wrap[data-full-width="boxed-full-width"][data-fullscreen="false"] .swiper-slide .content h2,
	    .full-width-content .vc_span12 .nectar-slider-wrap[data-fullscreen="false"] .swiper-slide .content h2 {
			font-size: ' .$heading_size*0.25 . 'px!important;
			line-height: '.$heading_size*0.35 .'px!important;
		}

		.nectar-slider-wrap[data-full-width="true"][data-fullscreen="false"] .swiper-slide .content p, 
		.nectar-slider-wrap[data-full-width="boxed-full-width"][data-fullscreen="false"]  .swiper-slide .content p, 
	    .full-width-content .vc_span12 .nectar-slider-wrap[data-fullscreen="false"] .swiper-slide .content p {
			font-size: ' .$caption_size *0.32 . 'px!important;
			line-height: '.$caption_size *0.73 .'px!important;
		}
	}
	';
	 
	 // header transparent option
	if(!empty($options['transparent-header']) && $options['transparent-header'] == '1') {
		
		global $post;
		
		$starting_color = (empty($options['header-starting-color'])) ? '#ffffff' : $options['header-starting-color'];
		$activate_transparency = using_page_header($post->ID);
		
		if($activate_transparency){
			
			//old IE versions
			echo '.no-rgba #header-space { display: none;  } ';
			
			echo '@media only screen and (min-width: 1000px) {
				
				 #header-space {
				 	 display: none; 
				 } 
				 .nectar-slider-wrap.first-section, .parallax_slider_outer.first-section, .full-width-content.first-section, 
				 .parallax_slider_outer.first-section .swiper-slide .content, .nectar-slider-wrap.first-section .swiper-slide .content, #page-header-bg, .nder-page-header, #page-header-wrap,
				 .full-width-section.first-section {
				 	 margin-top: 0!important;
				 }
				 
				 
				 body #page-header-bg, body #page-header-wrap {
				 	height: '.$header_space.'px;
				 }
				 
				 .swiper-container .slider-prev, .swiper-container .slider-next {
				 	top: 52%!important;	
				 }
				 
				 body #search-outer { z-index: 100000; }
				 
				 #header-outer.transparent header#top #logo, #header-outer.transparent header#top #logo:hover {
				 	color: '.$starting_color.'!important;
				 }

				 #header-outer.transparent header#top nav > ul > li > a, 
				 #header-outer.transparent header#top nav ul #search-btn a span, 
				 #header-outer.transparent .sf-sub-indicator [class^="icon-"], 
				 #header-outer.transparent .sf-sub-indicator [class*=" icon-"],
				 #header-outer.transparent .cart-menu .cart-icon-wrap .icon-salient-cart {
				 	color: '.$starting_color.';
				 	opacity: 0.75;
					transition: opacity 0.2s linear, color 0.2s linear;
				 }
				#header-outer.transparent header#top nav > ul > li > a:hover, #header-outer.transparent header#top nav .sf-menu > li.sfHover > a, #header-outer.transparent header#top nav .sf-menu > li.current_page_ancestor > a, 
				#header-outer.transparent header#top nav .sf-menu > li.current-menu-item > a, #header-outer.transparent header#top nav .sf-menu > li.current-menu-ancestor > a, #header-outer.transparent header#top nav .sf-menu > li.current_page_item > a,
				#header-outer.transparent header#top nav > ul > li > a:hover > .sf-sub-indicator > i, #header-outer.transparent header#top nav > ul > li.sfHover > a i, #header-outer.transparent header#top nav ul #search-btn a:hover span,
				#header-outer.transparent header#top nav .sf-menu > li.current-menu-item > a i, #header-outer.transparent header#top nav .sf-menu > li.current-menu-ancestor > a i {
					opacity: 1!Important;
					color: '.$starting_color.'!important;
				}
		}';
		}


	}
	
	
	 // ext responsive
	global $woocommerce;
	
	if(!empty($options['responsive']) && $options['responsive'] == 1 && !empty($options['ext_responsive']) && $options['ext_responsive'] == '1') {
		echo '@media only screen and (min-width: 1000px) {
			
			    .container {
			      max-width: 1425px; 
				  width: 100%;
				  padding: 0px 90px; 
			    } 
				
				.swiper-slide .content {
				  padding: 0px 90px; 
				}
				
				body .container .container {
					width: 100%!important;
					padding: 0!important;
				}
				
				
				body .carousel-heading .container {
					padding: 0 10px!important;
				}
				body .carousel-heading .container .carousel-next { right: 10px; } body .carousel-heading .container .carousel-prev { right: 35px; }
				.carousel-wrap[data-full-width="true"] .carousel-heading a.portfolio-page-link { left: 90px; }
				.carousel-wrap[data-full-width="true"] .carousel-heading { margin-left: -20px; margin-right: -20px; }
				.carousel-wrap[data-full-width="true"] .carousel-next { right: 90px!important; } .carousel-wrap[data-full-width="true"] .carousel-prev { right: 115px!important; }
				.carousel-wrap[data-full-width="true"] { padding: 0!important; }
				.carousel-wrap[data-full-width="true"] .caroufredsel_wrapper { padding: 20px!important; }
				
				#search-outer #search #close a {
					right: 90px;
				}
	
	
				#boxed, #boxed #header-outer, #boxed #header-secondary-outer, #boxed #page-header-bg[data-parallax="1"], #boxed #featured, #boxed .orbit > div, #boxed #featured article {
				   max-width: 1400px!important;
				   width: 90%!important;
				   min-width: 980px;
				}

				#boxed #search-outer #search #close a {
					right: 0!important;
				}

				#boxed .container {
				  width: 92%;
				  padding: 0;
			    } 
				
				#boxed #footer-outer #footer-widgets, #boxed #footer-outer #copyright {
					padding-left: 0;
					padding-right: 0;
				}

				#boxed .carousel-wrap[data-full-width="true"] .carousel-heading a.portfolio-page-link { left: 35px; }
				#boxed .carousel-wrap[data-full-width="true"] .carousel-next { right: 35px!important; } #boxed .carousel-wrap[data-full-width="true"] .carousel-prev { right: 60px!important; }

				
			 }';
		if($woocommerce && $woocommerce->cart->cart_contents_count > 0 && !empty($options['enable-cart']) && $options['enable-cart'] == '1') {
			echo '@media only screen and (min-width: 1080px) and (max-width: 1475px) {
			    header#top nav > ul {
				  padding-right: 20px!important; 
			    } 
				#boxed header#top nav > ul.product_added {
					padding-right: 0px!important; 
				}
				#search-outer #search #close a {
					right: 110px;
				}
			 }';
		}
		elseif($woocommerce && !empty($options['enable-cart']) && $options['enable-cart'] == '1') {
			echo '@media only screen and (min-width: 1080px) and (max-width: 1475px) {
			    header#top nav > ul.product_added {
				  padding-right: 20px!important; 
			    } 
				#boxed header#top nav > ul.product_added {
					padding-right: 0px!important; 
				}
				#search-outer #search #close a.product_added {
					right: 110px;
				}
			 }';
		 }
  
	} 
	 
	echo '</style>';
	
	
	$dynamic_css = ob_get_contents();
	ob_end_clean();
	
	echo nectar_quick_minify($dynamic_css);	
	
	
	
	//Default fonts with extended chars
	if(!empty($options['extended-theme-font']) && $options['extended-theme-font'] != '0') {
		 echo "<style type='text/css'> @font-face{font-family:OpenSansLight;src:url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Light-webfont.eot');src:url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Light-webfont.eot?#iefix') format('embedded-opentype'),url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Light-webfont.woff') format('woff'),url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Light-webfont.ttf') format('truetype'),url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Light-webfont.svg#OpenSansLight') format('svg')!important}@font-face{font-family:OpenSansRegular;src:url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Regular-webfont.eot');src:url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Regular-webfont.eot?#iefix') format('embedded-opentype'),url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Regular-webfont.woff') format('woff'),url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Regular-webfont.ttf') format('truetype'),url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Regular-webfont.svg#OpenSansRegular') format('svg')!important}@font-face{font-family:OpenSansSemibold;src:url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Semibold-webfont.eot');src:url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Semibold-webfont.eot?#iefix') format('embedded-opentype'),url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Semibold-webfont.woff') format('woff'),url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Semibold-webfont.ttf') format('truetype'),url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Semibold-webfont.svg#OpenSansSemibold') format('svg')!important}@font-face{font-family:OpenSansBold;src:url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Bold-webfont.eot');src:url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Bold-webfont.eot?#iefix') format('embedded-opentype'),url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Bold-webfont.woff') format('woff'),url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Bold-webfont.ttf') format('truetype'),url('".get_template_directory_uri()."/css/fonts/default_ext_chars/OpenSans-Bold-webfont.svg#OpenSansBold') format('svg')!important} </style>
		";
		
	}
	
	
	//custom css
	if(!empty($options["custom-css"])){
		echo '<style type="text/css">' . $options["custom-css"] . '</style>';
	} 
	
	

}

add_action('wp_head', 'nectar_custom_css');

?>