<?php
/**
 * Donald theme customizer
 *
 * @package Donald
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Donald_Customize {
	/**
	 * Customize settings
	 *
	 * @var array
	 */
	protected $config = array();

	/**
	 * The class constructor
	 *
	 * @param array $config
	 */
	public function __construct( $config ) {
		$this->config = $config;

		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		$this->register();
	}

	/**
	 * Register settings
	 */
	public function register() {
		/**
		 * Add the theme configuration
		 */
		if ( ! empty( $this->config['theme'] ) ) {
			Kirki::add_config(
				$this->config['theme'], array(
					'capability'  => 'edit_theme_options',
					'option_type' => 'theme_mod',
				)
			);
		}

		/**
		 * Add panels
		 */
		if ( ! empty( $this->config['panels'] ) ) {
			foreach ( $this->config['panels'] as $panel => $settings ) {
				Kirki::add_panel( $panel, $settings );
			}
		}

		/**
		 * Add sections
		 */
		if ( ! empty( $this->config['sections'] ) ) {
			foreach ( $this->config['sections'] as $section => $settings ) {
				Kirki::add_section( $section, $settings );
			}
		}

		/**
		 * Add fields
		 */
		if ( ! empty( $this->config['theme'] ) && ! empty( $this->config['fields'] ) ) {
			foreach ( $this->config['fields'] as $name => $settings ) {
				if ( ! isset( $settings['settings'] ) ) {
					$settings['settings'] = $name;
				}

				Kirki::add_field( $this->config['theme'], $settings );
			}
		}
	}

	/**
	 * Get config ID
	 *
	 * @return string
	 */
	public function get_theme() {
		return $this->config['theme'];
	}

	/**
	 * Get customize setting value
	 *
	 * @param string $name
	 *
	 * @return bool|string
	 */
	public function get_option( $name ) {
		if ( ! isset( $this->config['fields'][$name] ) ) {
			return false;
		}

		$default = isset( $this->config['fields'][$name]['default'] ) ? $this->config['fields'][$name]['default'] : false;

		return get_theme_mod( $name, $default );
	}
}

/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function donald_get_option( $name ) {
	global $donald_customize;

	if ( empty( $donald_customize ) ) {
		return false;
	}

	if ( class_exists( 'Kirki' ) ) {
		$value = Kirki::get_option( $donald_customize->get_theme(), $name );
	} else {
		$value = $donald_customize->get_option( $name );
	}

	return apply_filters( 'donald_get_option', $value, $name );
}

/**
 * Move some default sections to `general` panel that registered by theme
 *
 * @param object $wp_customize
 */
function donald_customize_modify( $wp_customize ) {
	$wp_customize->get_section( 'title_tagline' )->panel     = 'general';
	$wp_customize->get_section( 'static_front_page' )->panel = 'general';
}

add_action( 'customize_register', 'donald_customize_modify' );

/**
 * Customizer configuration
 */
$donald_customize = new Donald_Customize(
	array(
		'theme'    => 'donald',

		'panels'   => array(
			'general' => array(
				'priority' => 10,
				'title'    => esc_html__( 'General', 'donald' ),
			),
			'header'  => array(
				'priority' => 11,
				'title'    => esc_html__( 'Header', 'donald' ),
			),
			'socials'  => array(
				'priority' => 210,
				'title'    => esc_html__( 'Socials', 'donald' ),
			),
		),

		'sections' => array(

			// Panel Header
			'header'      => array(
				'title'       => esc_html__( 'Navigation', 'donald' ),
				'description' => '',
				'priority'    => 10,
				'capability'  => 'edit_theme_options',
				'panel'       => 'header',
			),
			'logo'        => array(
				'title'       => esc_html__( 'Site Logo', 'donald' ),
				'description' => '',
				'priority'    => 50,
				'capability'  => 'edit_theme_options',
				'panel'       => 'header',
			),
			'page_header' => array(
				'title'       => esc_html__( 'Page Header', 'donald' ),
				'description' => '',
				'priority'    => 15,
				'capability'  => 'edit_theme_options',
			),

			// Panel Socials
			'socials'      => array(
				'title'       => esc_html__( 'Socials', 'donald' ),
				'description' => '',
				'priority'    => 220,
				'capability'  => 'edit_theme_options',
			),

			
			// Panel Content
			'content'     => array(
				'title'       => esc_html__( 'Blog', 'donald' ),
				'description' => '',
				'priority'    => 240,
				'capability'  => 'edit_theme_options',
			),

			// Panel Footer
			'footer'     => array(
				'title'       => esc_html__( 'Footer', 'donald' ),
				'description' => '',
				'priority'    => 240,
				'capability'  => 'edit_theme_options',
			),

			// 404
			'error'     => array(
				'title'       => esc_html__( '404 Error', 'donald' ),
				'description' => '',
				'priority'    => 245,
				'capability'  => 'edit_theme_options',
			),

			// Coming Soon
			'csoon'     => array(
				'title'       => esc_html__( 'Coming Soon', 'donald' ),
				'description' => '',
				'priority'    => 245,
				'capability'  => 'edit_theme_options',
			),

			// Panel Styling
			'styling'     => array(
				'title'       => esc_html__( 'Miscellaneous', 'donald' ),
				'description' => '',
				'priority'    => 250,
				'capability'  => 'edit_theme_options',
			),
		),

		'fields'   => array(
			
			// Header layout
			'header_layout'  => array(
				'type'     => 'select',
				'label'    => esc_html__( 'Header Layout', 'donald' ),
				'section'  => 'header',
				'default'  => '1',
				'priority' => 10,
				'choices'  => array(
					'1' 	=> esc_html__( 'Header v1', 'donald' ),
					'2' 	=> esc_html__( 'Header v2', 'donald' ),
					'3' 	=> esc_html__( 'Header v3', 'donald' ),
					'4' 	=> esc_html__( 'Header v4', 'donald' ),
					'5' 	=> esc_html__( 'Header v5', 'donald' ),
					'6' 	=> esc_html__( 'Header v6', 'donald' ),
					'7' 	=> esc_html__( 'Header v7', 'donald' ),
					'8' 	=> esc_html__( 'Header v8', 'donald' ),
					'9' 	=> esc_html__( 'Header v9', 'donald' ),
					'left'  => esc_html__( 'Side Navigation', 'donald' ),
				),
			),
			'header_trans' => array(
				'type'     => 'toggle',
				'label'    => esc_html__( 'Header Transparent', 'donald' ),
				'section'  => 'header',
				'default'  => '0',
				'priority' => 10,
				'active_callback' => array(
					array(
					  	'setting'  => 'header_layout',
					  	'operator' => 'in',
					  	'value'    => array( '1', '2', '3', '4', '5', '6' ),
				 	),
				),
			),
			'bg_menu'    => array(
				'type'     => 'color',
				'label'    => esc_html__( 'Background Main Menu', 'donald' ),
				'section'  => 'header',
				'default'  => '',
				'priority' => 10,
				'active_callback' => array(
				 	array(
					  	'setting'  => 'header_trans',
					  	'operator' => '==',
					  	'value'    => 0,
				 	),
				),
			),
			'color_menu'    => array(
				'type'     => 'color',
				'label'    => esc_html__( 'Color Text Menu', 'donald' ),
				'section'  => 'header',
				'default'  => '',
				'priority' => 10,
			),			
			'sticky'     => array(
				'type'     => 'toggle',
				'label'    => esc_html__( 'Sticky Header', 'donald' ),
				'section'  => 'header',
				'default'  => '1',
				'priority' => 10,
				'active_callback' => array(
				 	array(
					  	'setting'  => 'header_trans',
					  	'operator' => '==',
					  	'value'    => 0,
				 	),
				),
			),
			'search'     => array(
				'type'     => 'toggle',
				'label'    => esc_html__( 'Search', 'donald' ),
				'section'  => 'header',
				'default'  => '1',
				'priority' => 10,
				'active_callback' => array(
					array(
					  	'setting'  => 'header_layout',
					  	'operator' => 'in',
					  	'value'    => array( '1', '2', '9', 'left' ),
				 	),
				),
			),
			'cart'     => array(
				'type'     => 'toggle',
				'label'    => esc_html__( 'Cart', 'donald' ),
				'section'  => 'header',
				'default'  => '1',
				'priority' => 10,
				'active_callback' => array(
					array(
					  	'setting'  => 'header_layout',
					  	'operator' => 'in',
					  	'value'    => array( '4', '6', '7', '8', '9' ),
				 	),
				),
			),
			'link_cart'     => array(
				'type'     => 'text',
				'label'    => esc_html__( 'Link To Cart', 'donald' ),
				'section'  => 'header',
				'default'  => '',
				'priority' => 10,
				'active_callback' => array(
					array(
					  	'setting'  => 'cart',
					  	'operator' => '==',
					  	'value'    => 1,
				 	),
				 	array(
					  	'setting'  => 'header_layout',
					  	'operator' => 'in',
					  	'value'    => array( '4', '6', '7', '8', '9' ),
				 	),
				),
			),
			'buttons'     => array(
				'type'     => 'toggle',
				'label'    => esc_html__( 'Login and Register', 'donald' ),
				'section'  => 'header',
				'default'  => '1',
				'priority' => 10,
				'active_callback' => array(
					array(
					  	'setting'  => 'header_layout',
					  	'operator' => 'in',
					  	'value'    => array( '4', '6', '7', '8', '9' ),
				 	),
				),
			),
			'link_log'     => array(
				'type'     => 'text',
				'label'    => esc_html__( 'Link To Login', 'donald' ),
				'section'  => 'header',
				'default'  => '',
				'priority' => 10,
				'active_callback' => array(
					array(
					  	'setting'  => 'buttons',
					  	'operator' => '==',
					  	'value'    => 1,
				 	),
				 	array(
					  	'setting'  => 'header_layout',
					  	'operator' => 'in',
					  	'value'    => array( '4', '6', '7', '8', '9' ),
				 	),
				),
			),
			'link_reg'     => array(
				'type'     => 'text',
				'label'    => esc_html__( 'Link To Register', 'donald' ),
				'section'  => 'header',
				'default'  => '',
				'priority' => 10,
				'active_callback' => array(
					array(
					  	'setting'  => 'buttons',
					  	'operator' => '==',
					  	'value'    => 1,
				 	),
				 	array(
					  	'setting'  => 'header_layout',
					  	'operator' => 'in',
					  	'value'    => array( '4', '6', '7', '8', '9' ),
				 	),
				),
			),
			'socials'     => array(
				'type'     => 'repeater',
				'label'    => esc_html__( 'Socials', 'donald' ),
				'section'  => 'header',
				'priority' => 10,
				'default'  => array(),
				'fields'   => array(
					'icon' => array(
						'type'        => 'text',
						'label'       => esc_html__( 'Icon Class', 'donald' ),
						'description' => esc_html__( 'This will be the social icon: http://fontawesome.io/icons/', 'donald' ),
						'default'     => '',
					),
					'link' => array(
						'type'        => 'text',
						'label'       => esc_html__( 'Link URL', 'donald' ),
						'description' => esc_html__( 'This will be the social link', 'donald' ),
						'default'     => '',
					),
				),
				'active_callback' => array(
					array(
					  	'setting'  => 'header_layout',
					  	'operator' => 'in',
					  	'value'    => array( '3', '5', '7', 'left' ),
				 	),
				),
			),

			// Logo
			'logo'           => array(
				'type'     => 'image',
				'label'    => esc_html__( 'Logo', 'donald' ),
				'section'  => 'logo',
				'default'  => '',
				'priority' => 10,
			),
			'logo_width'     => array(
				'type'     => 'number',
				'label'    => esc_html__( 'Logo Width', 'donald' ),
				'section'  => 'logo',
				'default'  => '',
				'priority' => 10,
			),
			'logo_height'    => array(
				'type'     => 'number',
				'label'    => esc_html__( 'Logo Height', 'donald' ),
				'section'  => 'logo',
				'default'  => '',
				'priority' => 10,
			),
			'logo_position'  => array(
				'type'     => 'spacing',
				'label'    => esc_html__( 'Logo Margin', 'donald' ),
				'section'  => 'logo',
				'priority' => 10,
				'default'  => array(
					'top'    => '20px',
					'bottom' => '20px',
					'left'   => '0',
					'right'  => '0',
				),
			),
			

			// Page Header
			'page_header'    => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Page Header', 'donald' ),
				'description' => esc_html__( 'Enable to show page header on whole site', 'donald' ),
				'section'     => 'page_header',
				'default'     => '1',
				'priority'    => 10,
			),
			'sheader_layout'  => array(
				'type'     => 'select',
				'label'    => esc_html__( 'Page Header Layout', 'donald' ),
				'section'  => 'page_header',
				'default'  => '1',
				'priority' => 10,
				'choices'  => array(
					'1' => esc_html__( 'Layout 1', 'donald' ),
					'2' => esc_html__( 'Layout 2', 'donald' ),
					'3' => esc_html__( 'Layout 3', 'donald' ),
				),
				'active_callback' => array(
					array(
					  	'setting'  => 'page_header',
					  	'operator' => '==',
					  	'value'    => 1,
				 	),
				),
			),
			'page_header_bg' => array(
				'type'        => 'image',
				'label'       => esc_html__( 'Background Image', 'donald' ),
				'description' => esc_html__( 'Upload a page header background image', 'donald' ),
				'section'     => 'page_header',
				'default'     => '',
				'priority'    => 10,
				'active_callback' => array(
				 	array(
					  	'setting'  => 'page_header',
					  	'operator' => '==',
					  	'value'    => 1,
				 	),
				),
			),

			'breadcrumb'     => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Breadcrumb', 'donald' ),
				'description' => esc_html__( 'Enable to show a breadcrumb bellow the site header', 'donald' ),
				'section'     => 'page_header',
				'default'     => '1',
				'priority'    => 10,
				'active_callback' => array(
					array(
					  	'setting'  => 'page_header',
					  	'operator' => '==',
					  	'value'    => 1,
				 	),
				),
			),


			// Content
			
			'excerpt_length' => array(
				'type'    => 'number',
				'label'   => esc_html__( 'Excerpt Length', 'donald' ),
				'section' => 'content',
				'default' => 30,
				'choices' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
			),
			'single_related'     => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Show Related Posts', 'donald' ),
				'description' => esc_html__( 'Display related posts for each post on single page', 'donald' ),
				'section'     => 'content',
				'default'     => '1',
				'priority'    => 11,
			),

			//Footer
			'bg_footer'    => array(
				'type'     => 'color',
				'label'    => esc_html__( 'Background Color Footer', 'donald' ),
				'section'  => 'footer',
				'default'  => '',
				'priority' => 10,
			),
			'color_footer'    => array(
				'type'     => 'color',
				'label'    => esc_html__( 'Color Text Footer', 'donald' ),
				'section'  => 'footer',
				'default'  => '',
				'priority' => 10,
			),
			'color_ftitle'    => array(
				'type'     => 'color',
				'label'    => esc_html__( 'Color Title Widget', 'donald' ),
				'section'  => 'footer',
				'default'  => '',
				'priority' => 10,
			),
			'bfooter'     => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Footer Bottom', 'donald' ),
				'section'     => 'footer',
				'default'     => '1',
				'priority'    => 10,
			),
			'bg_bottom'    => array(
				'type'     => 'color',
				'label'    => esc_html__( 'Background Bottom Footer', 'donald' ),
				'section'  => 'footer',
				'default'  => '',
				'priority' => 10,
				'active_callback' => array(
					array(
					  	'setting'  => 'bfooter',
					  	'operator' => '==',
					  	'value'    => 1,
				 	),
				),
			),
			'color_bottom' => array(
				'type'     => 'color',
				'label'    => esc_html__( 'Color Text Footer', 'donald' ),
				'section'  => 'footer',
				'default'  => '',
				'priority' => 10,
				'active_callback' => array(
					array(
					  	'setting'  => 'bfooter',
					  	'operator' => '==',
					  	'value'    => 1,
				 	),
				),
			),
			'logo_footer'    => array(
				'type'     => 'image',
				'label'    => esc_html__( 'Logo Footer', 'donald' ),
				'section'  => 'footer',
				'default'  => '',
				'priority' => 10,
			),
			'fsocials'     => array(
				'type'     => 'repeater',
				'label'    => esc_html__( 'Socials', 'donald' ),
				'section'  => 'footer',
				'priority' => 10,
				'default'  => array(),
				'fields'   => array(
					'icon' => array(
						'type'        => 'text',
						'label'       => esc_html__( 'Icon Class', 'donald' ),
						'description' => esc_html__( 'This will be the social icon: http://fontawesome.io/icons/', 'donald' ),
						'default'     => '',
					),
					'link' => array(
						'type'        => 'text',
						'label'       => esc_html__( 'Link URL', 'donald' ),
						'description' => esc_html__( 'This will be the social link', 'donald' ),
						'default'     => '',
					),
				),
			),
			'copy_right'     => array(
				'type'        => 'code',
				'label'       => esc_html__( 'Copy Right Text', 'donald' ),
				'section'     => 'footer',
				'default'     => '',
				'priority'    => 10,
			),

			// 404
			'bgi_error'        => array(
				'type'     => 'image',
				'label'    => esc_html__( 'Background Image', 'donald' ),
				'section'  => 'error',
				'default'  => '',
				'priority' => 10,
			),
			'bgc_error'        => array(
				'type'     => 'color',
				'label'    => esc_html__( 'Background Color', 'donald' ),
				'section'  => 'error',
				'default'  => '',
				'priority' => 10,
			),

			// Coming Soon
			'logocms'           => array(
				'type'     => 'image',
				'label'    => esc_html__( 'Logo', 'donald' ),
				'section'  => 'csoon',
				'default'  => '',
				'priority' => 10,
			),
			'bgcms'           => array(
				'type'     => 'image',
				'label'    => esc_html__( 'Background Image', 'donald' ),
				'section'  => 'csoon',
				'default'  => '',
				'priority' => 10,
			),
			'time_date'           => array(
				'type'     => 'datepicker',
				'label'    => esc_html__( 'Date Time', 'donald' ),
				'section'  => 'csoon',
				'default'  => '10/30/2017',
				'description' => esc_html__( 'Date format: dd/mm/yyyy. Example: 10/25/2017', 'donald' ),
				'priority' => 10,
			),
			'cs_socials'     => array(
				'type'     => 'repeater',
				'label'    => esc_html__( 'Socials', 'donald' ),
				'section'  => 'csoon',
				'priority' => 10,
				'default'  => array(),
				'fields'   => array(
					'icon' => array(
						'type'        => 'text',
						'label'       => esc_html__( 'Icon Class', 'donald' ),
						'description' => esc_html__( 'This will be the social icon: http://fontawesome.io/icons/', 'donald' ),
						'default'     => '',
					),
					'link' => array(
						'type'        => 'text',
						'label'       => esc_html__( 'Link URL', 'donald' ),
						'description' => esc_html__( 'This will be the social link', 'donald' ),
						'default'     => '',
					),
				),
			),

			//Styling
			'dark'     => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Dark Version', 'donald' ),
				'section'     => 'styling',
				'default'     => '0',
				'priority'    => 10,
			),
			'bg_body'    => array(
				'type'     => 'color',
				'label'    => esc_html__( 'Background Body', 'donald' ),
				'section'  => 'styling',
				'default'  => '',
				'priority' => 10,
			),
			'preload'     => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Preloader', 'donald' ),
				'section'     => 'styling',
				'default'     => '1',
				'priority'    => 10,
			),
			'main_color'    => array(
				'type'     => 'color',
				'label'    => esc_html__( 'Primary Color', 'donald' ),
				'section'  => 'styling',
				'default'  => '#73c026',
				'priority' => 10,
			),
			'custom_css'     => array(
				'type'        => 'code',
				'label'       => esc_html__( 'Custom Code', 'donald' ),
				'description' => esc_html__( 'Add more js, css, html... code here.', 'donald' ),
				'section'     => 'styling',
				'default'     => '',
				'priority'    => 10,
			),
		),
	)
);