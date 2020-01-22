<?php 

//Custom Style Frontend
if(!function_exists('donald_color_scheme')){
    function donald_color_scheme(){
        $main_color = '';

        //Main Color
        if(donald_get_option('main_color')){
            $main_color = 
            '/*Background Color*/ 
            
			.ot-btn-classic,
			.main-nav > ul > li > ul li:hover > a,.main-nav > ul > li > ul li:focus > a,.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus,
			.left-nav > ul > li:after,
			.widget_product_tag_cloud a:hover,
			.widget_nav_menu ul li:hover a,.widget_nav_menu ul li.current-menu-item a,
			.widget-prochures li a:hover,
			.owl-page-h .owl-controls .owl-dot:after,
			.owl-page-h .owl-controls .owl-dot.active,
			.owl-page-top-right .owl-controls .owl-dot.active,
			.page-pagination.style-1 li a:hover,.page-pagination.style-1 li span:hover,
			.page-pagination.style-1 li span:after,
			.page-pagination.style-1 li span.current,
			.product .product-buttons:hover a,
			.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.checkout-button,.woocommerce .added_to_cart,
			.summary.entry-summary .single_add_to_cart_button,
			.woocommerce a.remove:hover,
			.fixbtt,
			.custom.horizontal .tp-bullet.selected,
			.custom.horizontal .tp-bullet:after,
			.custom.vertical .tp-bullet.selected,
			.custom.vertical .tp-bullet:after{background-color: '.donald_get_option('main_color').';}

			/*Border Color*/ 

			.custom-select:focus, 
			blockquote, 
			.border-dark:hover:after,.border-dark:hover:before, 
			.border-theme:before, 
			.border-theme:after, 
			.border-theme:hover:after,.border-theme:hover:before, 
			.ot-btn-border-classic:hover,.ot-btn-border-classic:focus, 
			.btn-style-2:before, 
			.btn-style-2:after, 
			.btn-style-2:hover:before, 
			.btn-style-2:hover:after, 
			.owl-page-h .owl-controls .owl-dot.active, 
			.owl-page-top-right .owl-controls .owl-dot.active, 
			.page-pagination.style-1 li a:hover,.page-pagination.style-1 li span:hover, 
			.page-pagination.style-1 li span.current, 
			.comment-form .contact-input:hover,.comment-form .contact-input:focus, 
			.comment-form .textarea-contact:hover,.comment-form .textarea-contact:focus, 
			.custom.horizontal .tp-bullet.selected, 
			.custom.vertical .tp-bullet.selected{border-color: '.donald_get_option('main_color').';}

			/*Border Top*/ 

			.top_cart_list_product{border-top-color: '.donald_get_option('main_color').';}

			/*Border Left*/ 

			.preloader4{border-left-color: '.donald_get_option('main_color').';}

			/*Border Right*/ 

			.preloader4{border-right-color: '.donald_get_option('main_color').';}

			/*Border Bottom*/ 

			.form-search-navi .form-control, 
			.contact-input:hover,.contact-input:focus, 
			.textarea-contact:hover,.textarea-contact:focus, 
			.preloader4{border-bottom-color: '.donald_get_option('main_color').';}
			
			/*Color*/

			.border-dark:hover, 
			.ot-btn-border-classic:hover,.ot-btn-border-classic:focus, 
			.btn-style-2, 
			.btn-style-2:hover, 
			.btn-search-header:hover,.btn-search-header:focus,
			.form-search-navi .form-control, 
			.acc-box a:hover, 
			.icon-cart:hover, 
			.top_cart_list_product .product-detail a:hover, 
			.btn-menu-mobile:hover,.btn-menu-mobile:focus, 
			.main-nav > ul > li:hover > a,.main-nav > ul > li:focus > a, 
			.main-nav > ul > li.active > a, 
			.left-nav > ul > li > a:hover,.left-nav > ul > li > a:focus, 
			.left-nav > ul > li.active > a,.left-nav > ul > li.current-menu-parent > a, 
			.left-nav > ul > li > ul li:hover > a, 
			.widget li a:hover, 
			.widget_product_search .search-form button:hover, 
			.widget_product_categories li.active a,.widget_product_sort li.active a,.widget_product_price li.active a,.widget_recent_comments li.active a,.widget_pages li.active a,.widget_recent_entries li.active a,.widget_archive li.active a,.widget_categories li.active a,.widget_meta li.active a, 
			.widget_search button:hover, 
			.comment-author-link a.url, 
			.widget-contact-info span, 
			.color-theme,.vc_custom_heading b, 
			.owl-page-h .owl-controls .owl-dot:before, 
			.btn-1:hover, 
			.current-page, 
			.page-pagination.style-2 li a:hover, 
			.page-pagination.style-2 li span.current, 
			.widget-social-list li a:hover, 
			.widget-social-list-2 li a:hover, 
			.experience-year span, 
			.on-dark .ot-btn:hover, 
			.portfolio-home2-item .btn-detail-project, 
			.portfolio-home2-item h4 a:hover, 
			.footer-portfolio .ot-btn:hover, 
			.item-latest-post h4 a:hover, 
			.contact-form-home2 .ot-btn:hover, 
			.sub-header .breadcrumb span > span, 
			.item-post h4 a:hover, 
			.item-post .meta a:hover, 
			.meta-single-post a:hover, 
			.nav-links a:hover, 
			.list-comments .comment-reply-link, 
			.logged-in-as a, 
			.table-detail-project a:hover, 
			.title-block-number .big-number, 
			.tabs-left > li.active a, 
			.projectFilter a:hover,.projectFilter a.current, 
			.warp-404 strong, 
			.warp-comingsoon-inner strong, 
			.product h3 a:hover, 
			.product .price, 
			.special-product .product-detail h3 a:hover, 
			.woocommerce table.shop_table a:hover, 
			.woocommerce a.remove, 
			.product_meta a:hover, 
			.nav-tabs > li.active > a,.nav-tabs > li.active > a:hover,.nav-tabs > li.active > a:focus, 
			.woocommerce p.stars a:hover, 
			.woocommerce ul.product_list_widget li .price, 
			.woocommerce .star-rating span, 
			.icon-box-inline-sm span, 
			.footer-link li a:hover,.footer-link li a:focus, 
			.widget address strong, .product-detail h3:hover,
			.rev_slider .ot-btn:hover, 
			.custom.horizontal .tp-bullet:before, 
			.custom.vertical .tp-bullet:before, 
			div.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active>a{color: '.donald_get_option('main_color').';}
			';
        }

        if(! empty($main_color)){
			echo '<style type="text/css">'.$main_color.'</style>';
		}
    }
}
add_action('wp_head', 'donald_color_scheme');