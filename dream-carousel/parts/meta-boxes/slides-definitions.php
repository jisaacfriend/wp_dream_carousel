<?php
/*
Title: Slideshow Slides
Post Type: wp_dream_carousel
Order: 2
*/

global $post;
$id = $post->ID;

$images = get_post_meta( $id, 'upload_media' );
$image_array = array();

foreach( $images as $image ){
	$image_array[$image] = get_the_title( $image );
}

$slides = get_post_meta( $id, 'slides_info' );

$result = '<div class="wpdc-slider carousel-wrapper theme-default">';
$result .= '<ul id="carousel" class="elastislide-list">';

foreach( $slides as $slide ) {
	$count = count($slide['title']) - 1;
	$i=0;
	while( $i<=$count ) {
		$the_title = sanitize_text_field( $slide['title'][$i] );
		$the_link = esc_html( $slide['link'][$i] );
		$the_link_target = sanitize_text_field( $slide['link_target'][$i] );
		$the_url = wp_get_attachment_image_src( $slide['image'][$i], 'carousel' );
		$result .= '<li><a href="' . $the_link;
		if( "new" == $the_link_target ) {
			$result .= '" target="_blank"';
		} elseif( "modal" == $the_link_target ) {
			$result .= '" class="thickbox"';
		}
		$result .= '"><img title="' . $the_title . '" src="' . $the_url[0] . '" data-thumb="' . $the_url[0] . '" /></a><br /><p class="slide-heading">' . $the_title . '</p></li>';
		$i++;
	}
}

$result .= '</ul>';
$result .= '</div>';
echo $result;

piklist( 'field', array(
	'type'         => 'group',
	'field'        => 'slides_info',
	'label'        => 'Define Slides',
	'description'  => 'Here you can give each slide a title, specify a URL the slide should link to, and choose which image should be used for the slide.  You can even drag-and-drop to choose the order of the slides.',
	'add_more'     => true,
	'fields'       => array(
		array(
			'type'       => 'text',
			'field'      => 'title',
			'label'      => 'Slide Title',
			'columns'    => 12,
		),
		array(
			'type'       => 'text',
			'field'      => 'link',
			'label'      => 'Slide URL',
			'columns'    => 8,
		),
		array(
			'type'       => 'select',
			'field'      => 'link_target',
			'value'      => 'same',
			'label'      => 'Link Opens In:',
			'columns'    => 4,
			'choices'    => array(
				'same'  => 'Same Window',
				'new'   => 'New Window',
				'modal' => 'Lightbox Window'
			)
		),
		array(
			'type'       => 'select',
			'field'      => 'image',
			'label'      => 'Select Image',
			'columns'    => 12,
			'choices'    => $image_array
		)
	)
));
?>