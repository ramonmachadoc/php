<?php 
/**** WooCommerce custom functions ****/

if (class_exists('Woocommerce')) {
	
    add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}    

    // Display 12 products per page. Goes in functions.php
    add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20 );

    // breadcrumb woocommerce
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

    // Remove link before and after product
    remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

	add_filter( 'woocommerce_output_related_products_args', 'donald_related_products_args' );
	function donald_related_products_args( $args ) {
		$args['posts_per_page'] = 3; // 4 related products
		$args['columns'] = 3; // arranged in 2 columns
		return $args;
	}

	// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
	add_filter( 'woocommerce_add_to_cart_fragments', 'donald_header_add_to_cart_fragment' );
	function donald_header_add_to_cart_fragment( $fragments ) {
		ob_start();

		?>

		<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="btn btn-shopping-cart" data-toggle="dropdown" ><i class="glyphicon glyphicon-shopping-cart"></i> Cart - <span class="mini-cart-counter"><?php echo WC()->cart->get_cart_contents_count(); ?></span></a>	
			
	<?php
		$fragments['a.btn-shopping-cart'] = ob_get_clean();
		return $fragments;
	}

}
?>