<?php
/**
 * Redux Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package donald
 */


if ( ! function_exists( 'donald_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function donald_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Redux Theme, use a find and replace
	 * to change 'donald' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'donald', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' ); 

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'donald' ),
		'footer' => esc_html__( 'Footer Menu', 'donald' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'comment-form',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'audio',
		'image',
		'video',
		'gallery',
	) );
	add_image_size( 'career-thumb', 70, 82, array( 'left', 'top' ) );
	
}
endif; // donald_setup
add_action( 'after_setup_theme', 'donald_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function donald_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'donald_content_width', 640 );
}
add_action( 'after_setup_theme', 'donald_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function donald_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'donald' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Appears in the sidebar section of the site.', 'donald' ),  
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'donald' ),
		'id'            => 'shop-sidebar',
		'description'   => esc_html__( 'Appears in the sidebar section of the site.', 'donald' ),  
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer One Widget Area', 'donald' ),
		'id'            => 'footer-area-1',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'donald' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Two Widget Area', 'donald' ),
		'id'            => 'footer-area-2',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'donald' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Three Widget Area', 'donald' ),
		'id'            => 'footer-area-3',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'donald' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Fourth Widget Area', 'donald' ),
		'id'            => 'footer-area-4',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'donald' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) ); 

	
}
add_action( 'widgets_init', 'donald_widgets_init' );

/**
 * Enqueue Google fonts.
 */
function donald_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $popin = _x( 'on', 'Poppins font: on or off', 'donald' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $lato = _x( 'on', 'Lato font: on or off', 'donald' );  
 
    if ( 'off' !== $popin || 'off' !== $lato ) {
        $font_families = array();

        if ( 'off' !== $popin ) {
            $font_families[] = 'Poppins:300,400,500,600,700';
        }        
 
        if ( 'off' !== $lato ) {
            $font_families[] = '400,100,100italic,300,300italic,400italic,700,700italic,900,900italic';
        }     
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}


/**
 * Enqueue scripts and styles.
 */
function donald_scripts() {

	$protocol = is_ssl() ? 'https' : 'http';

	// Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'donald-fonts', donald_fonts_url(), array(), null );

    /** All frontend css files **/ 
    wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css');
    wp_enqueue_style( 'mmenu', get_template_directory_uri().'/css/jquery.mmenu.all.css');
    wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/fonts/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style( 'magnific', get_template_directory_uri().'/css/magnific-popup.css');
    wp_enqueue_style( 'linearicon', get_template_directory_uri().'/fonts/linearicon/style.css');
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/css/owl.carousel.css');

	if( class_exists('Woocommerce') ) {
		wp_enqueue_style( 'donald-woo', get_template_directory_uri().'/css/woocommerce.css');
	}

	wp_enqueue_style( 'donald-style', get_stylesheet_uri() );
	if(donald_get_option('dark')){
		wp_enqueue_style( 'donald-dark', get_template_directory_uri().'/css/dark.css');
	}	

	/** All frontend js files **/
	wp_enqueue_script("mapapi", "$protocol://maps.google.com/maps/api/js?key=AIzaSyAvpnlHRidMIU374bKM5-sx8ruc01OvDjI",array(),false,false); 
	wp_enqueue_script("bootstrap", get_template_directory_uri()."/js/plugins/bootstrap.js",array('jquery'),false,true);    
	wp_enqueue_script("mmenu", get_template_directory_uri()."/js/plugins/jquery.mmenu.all.min.js",array('jquery'),false,true);
    wp_enqueue_script("mobilemenu", get_template_directory_uri()."/js/plugins/mobilemenu.js",array('jquery'),false,true);
    wp_enqueue_script("owl-carousel", get_template_directory_uri()."/js/plugins/owl.carousel.js",array('jquery'),false,false);
	wp_enqueue_script("isotope", get_template_directory_uri()."/js/plugins/isotope.pkgd.min.js",array('jquery'),false,true);
	wp_enqueue_script("imagesloaded", get_template_directory_uri()."/js/plugins/imagesloaded.pkgd.js",array('jquery'),false,true);
	wp_enqueue_script("magnific", get_template_directory_uri()."/js/plugins/jquery.magnific-popup.min.js",array('jquery'),false,true);
	wp_enqueue_script("waypoints", get_template_directory_uri()."/js/plugins/jquery.waypoints.min.js",array('jquery'),false,true);
	wp_enqueue_script("counterup", get_template_directory_uri()."/js/plugins/jquery.counterup.min.js",array('jquery'),false,true);
	wp_enqueue_script("masonry", get_template_directory_uri()."/js/plugins/masonry.pkgd.min.js",array('jquery'),false,true);
	if(donald_get_option('sticky') && !is_page_template('page-templates/template-header.php')){
	wp_enqueue_script("sticky-kit", get_template_directory_uri()."/js/plugins/jquery.sticky-kit.min.js",array('jquery'),false,true);
    }
	wp_enqueue_script("donald-isotope", get_template_directory_uri()."/js/plugins/custom-isotope.js",array('jquery'),false,true);
    wp_enqueue_script("donald-js", get_template_directory_uri()."/js/plugins/template.js",array('jquery'),false,true);
}
add_action( 'wp_enqueue_scripts', 'donald_scripts' );


/**
 * Implement the Custom Meta Boxs.
 */
require get_template_directory() . '/framework/meta-boxes.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/framework/template-tags.php';
require get_template_directory() . '/framework/BFI_Thumb.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/framework/widget/flickr.php';
/**
 * Custom shortcode plugin visual composer.
 */
require_once get_template_directory() . '/shortcodes.php';
require_once get_template_directory() . '/vc_shortcode.php';
require_once get_template_directory() . '/framework/customizer.php';
/**
 * Customizer Menu.
 */
require get_template_directory() . '/framework/wp_bootstrap_navwalker.php';
/**
 * Enqueue Style
 */
require get_template_directory() . '/framework/color.php';
require get_template_directory() . '/framework/styling.php';
/**
 * Customizer Shop.
 */
require get_template_directory() . '/framework/woocommerce-customize.php';


//Code Visual Composer.
// Add new Param in Row
if(function_exists('vc_add_param')){
	vc_add_param('vc_row', array(
								"type" => "dropdown",
								"heading" => esc_html__('Setup Full Width', 'donald'),
								"param_name" => "fullwidth",
								"value" => array(   
								                esc_html__('No', 'donald') => 'no',  
								                esc_html__('Yes', 'donald') => 'yes',                                                                                
								              ),
								"description" => esc_html__("Select Full width for row : yes or not, Default: No fullwidth", "donald"),      
					        )
    );
    vc_add_param('vc_row',array(
                              	"type" => "checkbox",
                              	"heading" => esc_html__('Boxed Section', 'donald'),
                              	"param_name" => "boxed",     
                            ) 
    );
    vc_add_param('vc_row',array(
                              	"type" => "checkbox",
                              	"heading" => esc_html__('Background Parallax', 'donald'),
                              	"param_name" => "parallax_bg",     
                            ) 
    );
    vc_add_param('vc_row', array(
								"type" => "dropdown",
								"heading" => esc_html__('Top Line', 'donald'),
								"param_name" => "line",
								"value" => array(   
								                esc_html__('None', 'donald')  => 'none',  
								                esc_html__('Left', 'donald')  => 'left',  
								                esc_html__('Right', 'donald') => 'right',                                                                                
								              ),
								"description" => esc_html__("Select position the top line solid.", "donald"),      
					        )
    );
}

if(function_exists('vc_remove_param')){
	vc_remove_param( "vc_row", "parallax" );
	vc_remove_param( "vc_row", "parallax_image" );
	vc_remove_param( "vc_row", "parallax_speed_bg" );
	vc_remove_param( "vc_row", "parallax_speed_video" );
	vc_remove_param( "vc_row", "full_width" );
	vc_remove_param( "vc_row", "full_height" );
	vc_remove_param( "vc_row", "video_bg" );
	vc_remove_param( "vc_row", "video_bg_parallax" );
	vc_remove_param( "vc_row", "video_bg_url" );
	vc_remove_param( "vc_row", "columns_placement" );
	vc_remove_param( "vc_row", "gap" );	
}	

/**
 * Require plugins install for this theme.
 *
 * @since Split Vcard 1.0
 */
require_once get_template_directory() . '/framework/plugin-requires.php';


