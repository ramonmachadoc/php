<?php

/**
 * Register meta boxes
 *
 * @since 1.0
 *
 * @param array $meta_boxes
 *
 * @return array
 */

function donald_register_meta_boxes( $meta_boxes ) {

	$prefix = '_cmb_';
	$meta_boxes[] = array(

		'id'       => 'format_detail',

		'title'    => esc_html__( 'Format Details', 'donald' ),

		'pages'    => array( 'post' ),

		'context'  => 'normal',

		'priority' => 'high',

		'autosave' => true,

		'fields'   => array(

			array(

				'name'             => esc_html__( 'Image', 'donald' ),

				'id'               => $prefix . 'image',

				'type'             => 'image_advanced',

				'class'            => 'image',

				'max_file_uploads' => 1,

			),

			array(

				'name'  => esc_html__( 'Gallery', 'donald' ),

				'id'    => $prefix . 'images',

				'type'  => 'image_advanced',

				'class' => 'gallery',

			),			

			array(

				'name'  => esc_html__( 'Audio', 'donald' ),

				'id'    => $prefix . 'link_audio',

				'type'  => 'oembed',

				'cols'  => 20,

				'rows'  => 2,

				'class' => 'audio',

				'desc' => 'Ex: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759',

			),

			array(

				'name'  => esc_html__( 'Video', 'donald' ),

				'id'    => $prefix . 'link_video',

				'type'  => 'oembed',

				'cols'  => 20,

				'rows'  => 2,

				'class' => 'video',

				'desc' => 'Example: <b>http://www.youtube.com/watch?v=pbZzfZQQuro</b>',

			),			

		),

	);

	$meta_boxes[] = array(
		'id'       => 'project_settings',
		'title'    => esc_html__( 'Projects Settings', 'donald' ),
		'pages'    => array( 'portfolio' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
            array(
                'name' => 'Background Header',
                'id'   => $prefix . 'bg_prjheader',
                'type' => 'image_advanced',
            ),
            array(
                'name' => 'Image Slider',
                'id'   => $prefix . 'image_slider',
                'type' => 'image_advanced',
                'desc' => 'Image show on slider portfolio.',
            ),
            array(

				'name'  => esc_html__( 'Excerpt', 'donald' ),

				'id'    => $prefix . 'exc_slider',

				'type'  => 'textarea',

				'cols'  => 20,

				'rows'  => 2,

				'class' => 'audio',

				'desc' => 'Text show on slider portfolio',

			),
			array(

				'name'  => esc_html__( 'Video Popup Link', 'donald' ),

				'id'    => $prefix . 'popup_video',

				'type'  => 'oembed',

				'cols'  => 20,

				'rows'  => 2,

				'class' => 'video',

				'desc' => 'Example: <b>http://www.youtube.com/watch?v=pbZzfZQQuro</b>',

			),    		
		),

	);


	$meta_boxes[] = array(
		'id'         => 'job_testimonial',
		'title'      => 'Testimonials Details',
		'pages'      => array( 'testimonial' ), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
                'name' => 'btext',
                'desc' => 'Big Text',
                'id'   => $prefix . 'btext',
                'type' => 'textarea',
            ),
            array(
                'name' => 'Job',
                'desc' => 'Job of Person',
                'id'   => $prefix . 'job_testi',
                'type' => 'text',
            ),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'service_setting',
		'title'      => 'Service Settings',
		'pages'      => array( 'service' ), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
                'name' => 'Subtitle',
                'desc' => 'Text under title on list services',
                'id'   => $prefix . 'sub_serv',
                'type' => 'text',
            ),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'page_settings',
		'title'      => 'Page Settings',
		'pages'      => array( 'page', 'post', 'service' ), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
                'name' => 'Background Page Header',
                'id'   => $prefix . 'bg_header',
                'type' => 'image_advanced',
            ),
		)
	);
	

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'donald_register_meta_boxes' );

