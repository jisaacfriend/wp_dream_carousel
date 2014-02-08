<?php
/*
Title: Slideshow
Post Type: wp_dream_carousel
Order: 0
*/
/*
piklist( 'field', array(
	'type'			=> 'group',
	'field'			=> 'slides_info',
	'add_more'		=> true,
	'label'			=> 'Slide Images',
	'description'	=> 'Add the slides for the slideshow.  You can add as many slides as you want, and they can be drag-and-dropped into the order that you would like them to appear.',
	'fields'		=> array(
		array(
		'type'			=> 'file',
		'field'			=> 'slide_image',
		'scope'			=> 'post_meta',
		'label'			=> __( 'Add/Edit Image', 'wp-dream-carousel' ),
		'description'	=> __( 'Use the media uploader to add, select, or edit an image to use as a slide.', 'wp-dream-carousel' ),
		'options'		=> array(
			'modal_title'	=> __( 'Add/Edit Image', 'wp-dream-carousel' ),
			'button'		=> __( 'Add/Edit', 'wp-dream-carousel' )
			)
		),
		
		array(
		'type'			=> 'text',
		'field'			=> 'slide_url',
		'scope'			=> 'slide_image',
		'label'			=> 'Image Link URL',
		'description'	=> 'If the slide should have a link, enter the URL for the link here.'
		),
	),
	'on_post_status' => array(
		'value' => 'lock'
	)
));
*/
piklist('field', array(
    'type' => 'file'
    ,'add_more' => true
    ,'field' => 'upload_media'
    ,'scope' => 'post_meta'
    ,'label' => __('Add File(s)','piklist')
    ,'description' => __('This is the uploader seen in the admin by default.','piklist')
    ,'options' => array(
      'modal_title' => __('Add File(s)','piklist')
      ,'button' => __('Add/Edit','piklist')
    )
  ));

?>