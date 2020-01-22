<header class="header-10">	
	<h1  class="logo">
		<?php $logo = donald_get_option( 'logo' ) ? donald_get_option( 'logo' ) : get_template_directory_uri().'/images/logo.png'; ?>
        <a href="<?php echo esc_url( home_url('/') ); ?>">
            <img src="<?php echo esc_url($logo); ?>" class="img-responsive" alt="">
        </a>
	</h1>
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

	<nav class="main-nav">
        <?php if(donald_get_option( 'search' )) { ?>
        <div class="btn-search-header">
            <span class="lnr lnr-magnifier"></span>
            <div class="search-popup">
                <form class="form-search-navi" action="<?php echo esc_url(home_url( '/' )); ?>">
                    <div class="input-group">
                        <input class="form-control" name="s" placeholder="<?php echo esc_html__('Type & Search', 'donald'); ?>" type="text">
                        <button><span class="lnr lnr-magnifier"></span></button>
                    </div>
                    <!-- /input-group -->
                </form>
            </div>
        </div>
        <?php } ?>
		<?php
            $primary = array(
                'theme_location'  => 'primary',
                'menu'            => '',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => '',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'donald_bootstrap_navwalker::fallback',
                'walker'          => new donald_bootstrap_navwalker(),
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul class="navi-level-1">%3$s</ul>',
                'depth'           => 0,
            );
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( $primary );
            }
        ?>
	</nav>

</header>