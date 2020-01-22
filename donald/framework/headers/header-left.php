<header class="sidebar-nav">
	<h1 class="logo">
		<?php $logo = donald_get_option( 'logo' ) ? donald_get_option( 'logo' ) : get_template_directory_uri().'/images/logo-2.png'; ?>
        <a href="<?php echo esc_url( home_url('/') ); ?>">
            <img src="<?php echo esc_url($logo); ?>" class="img-responsive" alt="">
        </a>
	</h1>
	<nav class="left-nav">
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
	
	<?php $socials = donald_get_option( 'socials', array() ); ?>
    <?php if($socials) { ?>
    <ul class="widget-social-list">
        <?php foreach ( $socials as $social ) { ?>
        <li><a href="<?php echo esc_url($social['link']); ?>"><i class="fa <?php echo esc_attr($social['icon']); ?>" aria-hidden="true"></i></a></li>
        <?php } ?>
    </ul>
    <?php } ?>

    <?php if(donald_get_option( 'search' )) { ?>
	<div class="widget_search search-header">
		<?php get_search_form(); ?>
	</div>
	<?php } ?>
</header>

<div class="header-on-sm hidden-lg">
	<h1 class="logo">
		<?php $logo = donald_get_option( 'logo' ) ? donald_get_option( 'logo' ) : get_template_directory_uri().'/images/logo.png'; ?>
        <a href="<?php echo esc_url( home_url('/') ); ?>">
            <img src="<?php echo esc_url($logo); ?>" class="img-responsive" alt="">
        </a>
	</h1>
	<a href="#menu" class="btn-menu-mobile"><span class="lnr lnr-menu"></span></a>
</div>