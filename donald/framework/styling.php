<?php 

//Custom Style Frontend
if(!function_exists('donald_custom_frontend_style')){
    function donald_custom_frontend_style(){
    	$style_css 	= '';
        $bg_h 		= '';
        $color_m 	= '';

        $logo_mar 	= '';
        $logo_w 	= '';
        $logo_h 	= '';

        $bg_ft		= '';
        $color_ft	= '';
        $color_fti	= '';
        $bg_bt		= '';
        $color_bt	= '';

        $bg_bd      = '';

        $hleft		= '';

        $bgcms      = '';
        $bgi_error  = '';
        $bgc_error 	= '';


        if(donald_get_option('bg_menu')){
        	$bg_h = 'header{ background: '.donald_get_option('bg_menu').'; }';
        }
        if(donald_get_option('color_menu')){
        	$color_m = '.main-nav > ul > li > a, .acc-box a, .icon-cart, .widget-social-list li a, .btn-menu-mobile, .btn-search-header{ color: '.donald_get_option('color_menu').'; } .navi-warp-h2 .navi-level-1 a:after{ opacity: 0.7; }';
        }

        //Logo
        if(donald_get_option('logo_width')){
        	$logo_w = '.logo .img-responsive{ width: '.donald_get_option('logo_width').'px; }';
        }
        if(donald_get_option('logo_height')){
        	$logo_h = '.logo .img-responsive{ height: '.donald_get_option('logo_height').'px; }';
        }
        if(donald_get_option('logo_position')){
        	$space = donald_get_option('logo_position');
        	$logo_mar = '.logo .img-responsive{ margin: '.$space["top"].' '.$space["right"].' '.$space["bottom"].' '.$space["left"].'; }';
        }

        //Coming Soon
        if(donald_get_option('bgcms')){
        	$bgcms = '.bgcms{ background-image: url('.donald_get_option('bgcms').'); }';
        }

        //404
        if(donald_get_option('bgi_error')){
            $bgi_error = '.bg-error{ background-image: url('.donald_get_option('bgi_error').'); }';
        }
        if(donald_get_option('bgc_error')){
            $bgc_error = '.bg-error{ background-color: '.donald_get_option('bgc_error').'; }';
        }

        //Footer
        if(donald_get_option('bg_footer')){
        	$bg_ft = '.top-widget{ background: '.donald_get_option('bg_footer').'; }';
        }
        if(donald_get_option('color_footer')){
        	$color_ft = '.top-widget, .footer-widget a, .footer-widget li a{ color: '.donald_get_option('color_footer').'; }';
        }
        if(donald_get_option('color_ftitle')){
        	$color_fti = '.footer-widget h3{ color: '.donald_get_option('color_ftitle').'; }';
        }
        if(donald_get_option('bg_bottom')){
        	$bg_bt = '.footer-home-1 .footer-inner{ background: '.donald_get_option('bg_bottom').'; }';
        }
        if(donald_get_option('color_bottom')){
        	$color_bt = '.footer-inner, .widget-social-list li a, .footer-link-2 li a, .footer-inner a{ color: '.donald_get_option('color_bottom').'; }';
        }

        //Styling
        if(donald_get_option('header_layout') == 'left'){
        	$hleft = 'body section.boxed.bg-img, body .meta-single-post{ margin: 0; } .line-top-right, .line-top-left{ display: none; }';
        }
        if(donald_get_option('bg_body')){
        	$bg_bd = 'body{ background-color: '.donald_get_option('bg_body').'; }';
        }


        $style_css .= donald_get_option('custom_css');
        $style_css .= $bg_h;
        $style_css .= $color_m;

        $style_css .= $logo_w;
        $style_css .= $logo_h;
        $style_css .= $logo_mar;

        $style_css .= $bgcms;
        $style_css .= $bgi_error;
        $style_css .= $bgc_error;

        $style_css .= $bg_ft;
        $style_css .= $color_ft;
        $style_css .= $color_fti;
        $style_css .= $bg_bt;
        $style_css .= $color_bt;
        
        $style_css .= $bg_bd;
        $style_css .= $hleft;
        if(! empty($style_css)){
			echo '<style type="text/css">'.$style_css.'</style>';
		}
    }
}
add_action('wp_head', 'donald_custom_frontend_style');