<?php
/*
Title: Product Reviews
Post Type: wp_dream_carousel
Order: 0
*/
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'product_reviews'
    ,'add_more' => true
    ,'label' => 'Product Reviews'
    ,'description' => 'Stores all of the data necessary for displaying the Product Reviews.  Images should only be 150px wide, but may be any height.  (Recommended 150x75)'
    ,'fields' => array(
	array(
		'type'			=> 'file'
		,'field'			=> 'slide_image'
		,'scope'			=> 'post_meta'
		,'label'			=> __( 'Add/Edit Image', 'wp-dream-carousel' )
		,'options'		=> array(
			'modal_title'	=> __( 'Add/Edit Image', 'wp-dream-carousel' )
			,'button'		=> __( 'Add/Edit', 'wp-dream-carousel' )
			)
		)
	,array(
		'type'			=> 'text'
		,'field'			=> 'slide_url'
		,'scope'			=> 'slide_image'
		,'label'			=> 'Image Link URL'
		)
      ,array(
        'type' => 'text'
        ,'field' => 'review_subtitle'
        ,'label' => 'Review Subtitle'
        ,'columns' => 12
      )
      ,array(
        'type' => 'textarea'
        ,'field' => 'review_excerpt'
        ,'label' => 'Review Excerpt'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'review_link'
        ,'label' => 'Link to Full Review'
        ,'columns' => 12
      )
    )
    ,'on_post_status' => array(
        'value' => 'lock'
      )
  ));
?>