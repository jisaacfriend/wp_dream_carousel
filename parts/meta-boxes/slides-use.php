<?php
/*
Title: Using this Slideshow
Post Type: wp_dream_carousel
Order: 0
*/

global $post;

$id = $post->ID;

echo '<h4>Embedded Function -</h4>&nbsp;&nbsp;&nbsp;You can embed this slideshow into a page template by using this PHP function:&nbsp;&nbsp;&nbsp;<b>&lt;?php wp_dream_carousel(' . $id . '); ?></b>.';

echo '<h4>Shortcode -</h4>&nbsp;&nbsp;&nbsp;You can use this slideshow in the editor of a page or post by using this shortcode:&nbsp;&nbsp;&nbsp;<b>[wp_dream_carousel id="' . $id . '"].';