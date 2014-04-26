<?php
/**
 * @package   WP_Dream_Carousel
 * @author    J. Isaac Friend <j.isaac.friend@fueledbydreams.com>
 * @license   GPL-2.0+
 * @link      http://wpdreamcarousel.com
 * @copyright 2014 J. Isaac Friend
 */


function wp_dream_carousel( $id ) {
    $slides = get_post_meta( $id, 'slides_info' );

	$html_output = '<div class="wpdc-slider carousel-wrapper theme-default">' . PHP_EOL . '
						<ul id="carousel" class="elastislide-list">' . PHP_EOL;
	
	foreach ( $slides as $slide ) {
		$count = count( $slide['title'] ) - 1;
		$i=0;
		while ( $i<=$count ) {
			$the_title = sanitize_text_field( $slide['title'][ $i ] );
			$the_link = esc_html( $slide['link'][ $i ] );
			$the_link_target = sanitize_text_field( $slide['link_target'][ $i ] );
			$the_url = wp_get_attachment_image_src( $slide['image'][ $i ], 'carousel' );
			if ( "new" == $the_link_target ) {
				$html_output .= '<li>' . PHP_EOL . '<a href="' . $the_link . '" target="_blank"';
			} elseif ( "modal" == $the_link_target ) {
				$html_output .= '<li>' . PHP_EOL . '<a href="' . $the_link . '" class="modal"';
			} else {
				$html_output .= '<li>' . PHP_EOL . '<a href="' . $the_link . '"';
			}
			$html_output .= '>' . PHP_EOL . '<img title="' . $the_title . '" src="' . $the_url[0] . '" data-thumb="' . $the_url[0] . '" />' . PHP_EOL . '</a>' . PHP_EOL . '<p class="slide-heading">' . $the_title . '</p>' . PHP_EOL . '</li>' . PHP_EOL;
			$i++;
		}
	}
	
	$html_output .= '</ul>' . PHP_EOL;
	$html_output .= '</div>' . PHP_EOL;
	echo $html_output;
	
    add_action( 'wp_footer', 'wpdc_footer_scripts' );
}

function wpdc_footer_scripts( $wpdc_slider ) {
    $options = get_option( 'wpdc_settings' );
    $wpdc_footer_script = "
    	<script>
			var $ = jQuery;
				(function(){
					$(window).load(function() {
						$( '#carousel' ).elastislide({
							orientation : '" . $options['orientation'] . "',
							speed       : " . $options['speed'] . ",
							easing      : '" . $options['easing'] . "',
							minItems    : " . $options['min_vis'] . ",
							start       : 0
						});
					});
				})();
		</script>
		<script type='text/javascript'>
			$(document).ready(function() {
				$('.modal').magnificPopup({
					type	:	'iframe'
				});
			});
		</script>
		";
	echo $wpdc_footer_script;
}

?>