<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package donald
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
    
</head>

<body <?php body_class( '' ); ?> >

    <?php if(donald_get_option('preload')){ ?>
    <div class="images-preloader">
      <div class="preloader4"></div>
    </div>
    <?php } ?>
    
    <div id="page">
        <!-- Mobile Menu -->
        <nav id="menu">
            <?php
                $topmenu = array(
                'theme_location'  => 'primary',
                'menu'            => '',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => '',
                'menu_id'         => '',
                'echo'            => true,
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 0,
            );
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( $topmenu );
            }
            ?>
        </nav>
        
        <header  id="header-home-2" class="header-home bg-transparent fixed">
            <h1 class="logo">
                <?php $logo = get_template_directory_uri().'/images/logo-on-dark.png'; ?>
                <a href="<?php echo esc_url( home_url('/') ); ?>">
                    <img src="<?php echo esc_url($logo); ?>" class="img-responsive" alt="">
                </a>
            </h1>
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
            
            <nav id="main-nav" class="main-nav">
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
            <a href="#menu" class="btn-menu-mobile"><span class="lnr lnr-menu"></span></a>
        </header>