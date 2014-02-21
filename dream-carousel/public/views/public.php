<?php
/**
 * Represents the view for the public-facing component of the plugin.
 *
 * This typically includes any information, if any, that is rendered to the
 * frontend of the theme when the plugin is activated.
 *
 * @package   WP_Dream_Carousel
 * @author    J. Isaac Friend <j.isaac.friend@fueledbydreams.com>
 * @license   GPL-2.0+
 * @link      http://wpdreamcarousel.com
 * @copyright 2014 J. Isaac Friend
 */


function wp_dream_carousel( $id ) {
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
			if( "new" == $the_link_target ) {
				$result .= '<li><a href="' . $the_link . '" target="_blank"';
			} elseif( "modal" == $the_link_target ) {
				$string = "watch?v=";
				if( strpos( $the_link, $string ) !== false ) {
					$the_link = preg_replace("/(watch\\?v=)/u", "v/", $the_link);
				}
				$result .= '<li><a href="' . $the_link . '" class="video"';
			} else {
				$result .= '<li><a href="' . $the_link . '"';
			}
			$result .= '><img title="' . $the_title . '" src="' . $the_url[0] . '" data-thumb="' . $the_url[0] . '" /></a><br /><p class="slide-heading">' . $the_title . '</p></li>';
			$i++;
		}
	}
	
	$result .= '</ul>';
	$result .= '</div>';
	echo $result;
	
    add_action( 'wp_footer', 'wpdc_footer_scripts' );
}

function wpdc_footer_scripts( $wpdc_slider ) {
    $options = get_option( 'wpdc_settings' );
    $wpdc_footer_script = "
    	<script>
			var $ = jQuery;
				(function(){
					$( '#carousel' ).elastislide({
						orientation : '" . $options[ 'orientation' ] . "',
						speed       : " . $options[ 'speed' ] . ",
						easing      : '" . $options[ 'easing' ] . "',
						minItems    : " . $options[ 'min_vis' ] . ",
						start       : 0
					});
				})();
		</script>
		<script type='text/javascript'>
			jQuery(document).ready(function() {
			
				$('.video').click(function() {
					$.fancybox({
						'padding'		: 0,
						'autoScale'		: false,
						'transitionIn'	: 'none',
						'transitionOut'	: 'none',
						'title'			: this.title,
						'width'			: 640,
						'height'		: 385,
						'href'			: this.href.replace(new RegExp('watch\\?v=', 'i'), 'v/'),
						'type'			: 'swf',
						'swf'			: {
						'wmode'				: 'transparent',
						'allowfullscreen'	: 'true'
						}
					});
			
					return false;
				});
			});		
		</script>
		";
	echo $wpdc_footer_script;
}

?>