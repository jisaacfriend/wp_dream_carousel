<?php
/*
Title: Slideshow Slide Images
Post Type: wp_dream_carousel
Order: 1
*/

global $post;
$id = $post->ID;

$options = get_option( 'wpdc_settings' );
if ( '' == $options['image_width'] && '' == $options['image_height'] ) {	
	$images = get_post_meta( $id, 'upload_media' );
	if ( empty( $images ) ) {	
		echo 'Please visit the <a href="/edit.php?post_type=wp_dream_carousel&page=dream_carousel_settings">SETTINGS</a> page and set up an image size before creating a slideshow!';
	} else {
		piklist('field', array(
		    'type'            => 'file',
		    'add_more'        => true,
		    'field'           => 'upload_media',
		    'scope'           => 'post_meta',
		    'label'           => __( 'Add/Edit File(s)', 'piklist' ),
		    'description'     => __( 'Use the uploader to add any number of images to be used in this slideshow.', 'piklist' ),
		    'options'         => array(
		      'modal_title'   => __( 'Add/Edit Image(s)', 'piklist' ),
		      'button'        => __( 'Add/Edit','piklist' )
		    )
		));
	}
} else {
	piklist('field', array(
		    'type'            => 'file',
		    'add_more'        => true,
		    'field'           => 'upload_media',
		    'scope'           => 'post_meta',
		    'label'           => __( 'Add/Edit File(s)', 'piklist' ),
		    'description'     => __( 'Use the uploader to add any number of images to be used in this slideshow.', 'piklist' ),
		    'options'         => array(
		      'modal_title'   => __( 'Add/Edit Image(s)', 'piklist' ),
		      'button'        => __( 'Add/Edit', 'piklist' )
		    )
		));
}