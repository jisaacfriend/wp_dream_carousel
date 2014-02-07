<?php
/*
Title: Slide Info
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
        'type' => 'text'
        ,'field' => 'image_url'
        ,'label' => 'Image URL'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'review_title'
        ,'label' => 'Review Title'
        ,'columns' => 12
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