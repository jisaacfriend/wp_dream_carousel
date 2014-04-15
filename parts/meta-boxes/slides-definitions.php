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

foreach( $slides as $slide ) {
	$count = count($slide['title']) - 1;
	$i=0;
	while( $i<=$count ) {
		$the_link = esc_html( $slide['link'][$i] );
		$the_link_target = sanitize_text_field( $slide['link_target'][$i] );
		echo $the_link . "<br />";
		if( "modal" == $the_link_target ) {
			$string = "watch?v=";
			if( strpos( $the_link, $string ) !== false ) {
				$the_link = preg_replace("/(watch\\?v=)/u", "v/", $the_link);
				var_dump( $the_link );
				echo "<br />";
			}
		}
		$i++;
	}
}

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