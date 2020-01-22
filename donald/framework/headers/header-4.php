<header  id="<?php if(donald_get_option('header_trans')) echo 'header-home-2';else echo 'stick'; ?>" class="header-4 <?php if(donald_get_option('header_trans')) echo 'bg-transparent fixed'; ?>">
	<h1  class="logo">
		<?php $logo = donald_get_option( 'logo' ) ? donald_get_option( 'logo' ) : get_template_directory_uri().'/images/logo.png'; ?>
        <a href="<?php echo esc_url( home_url('/') ); ?>">
            <img src="<?php echo esc_url($logo); ?>" class="img-responsive" alt="">
        </a>
	</h1>
	<a href="#menu" class="btn-menu-mobile"><span class="lnr lnr-menu"></span></a>
	<?php if(donald_get_option( 'cart' ) && class_exists('Woocommerce')) { ?>
	<div class="cart-button">
		<a href="<?php echo esc_url(donald_get_option( 'link_cart' )); ?>" class="icon-cart">
			<span class="lnr lnr-cart"></span>
			<span class="mini-cart-counter"></span>
		</a>
	</div>
	<?php } ?>
	<?php if(donald_get_option( 'buttons' )) { ?>
    <?php if ( is_user_logged_in() ) { ?>
    <div class="acc-box">
        <a href="<?php echo wp_logout_url( home_url() ); ?>" class="ot-btn border-dark"><?php echo esc_html__('LOG OUT', 'donald'); ?></a>
    </div>
    <?php }else{ ?>
    <div class="acc-box">
        <a href="<?php echo esc_url(donald_get_option( 'link_log' )); ?>"><?php echo esc_html__('LOG IN', 'donald'); ?></a>
        <a href="<?php echo esc_url(donald_get_option( 'link_reg' )); ?>" class="ot-btn border-dark"><?php echo esc_html__('SIGN UP', 'donald'); ?></a>
    </div>
    <?php } } ?>

</header>