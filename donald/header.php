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
    
    <div id="page" class="<?php if(donald_get_option('header_layout')=="left") echo 'left-navigation'; ?>">
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
        
        <?php 
            if( donald_get_option('header_layout')=="2" ){
                get_template_part('framework/headers/header-2');
            }
            elseif( donald_get_option('header_layout')=="3" ){
                get_template_part('framework/headers/header-3');
            }
            elseif( donald_get_option('header_layout')=="4" ){
                get_template_part('framework/headers/header-4');
            }
            elseif( donald_get_option('header_layout')=="5" ){
                get_template_part('framework/headers/header-5');
            }
            elseif( donald_get_option('header_layout')=="6" ){
                get_template_part('framework/headers/header-6');
            }
            elseif( donald_get_option('header_layout')=="7" ){
                get_template_part('framework/headers/header-7');
            }
            elseif( donald_get_option('header_layout')=="8" ){
                get_template_part('framework/headers/header-8');
            }
            elseif( donald_get_option('header_layout')=="9" ){
                get_template_part('framework/headers/header-9');
            }elseif( donald_get_option('header_layout')=="left" ){
                get_template_part('framework/headers/header-left');
            }else{
                get_template_part('framework/headers/header-1'); 
            }
        ?>
    <?php if(donald_get_option('header_layout')=="left") echo '<div class="content-right">';