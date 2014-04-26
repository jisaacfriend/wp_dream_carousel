<?php
/**
 *
 * @package   WP_Dream_Carousel
 * @author    J. Isaac Friend <j.isaac.friend@fueledbydreams.com>
 * @license   GPL-2.0+
 * @link      http://wpdreamcarousel.com
 * @copyright 2014 J. Isaac Friend
 *
 * @wordpress-plugin
 * Plugin Name:       WP Dream Carousel
 * Plugin URI:        http://wpdreamcarousel.com
 * Description:       A Carousel Plugin for WordPress using the ElastiSlide jQuery Plugin
 * Plugin Type: Piklist
 * Version:           1.0.1b
 * Author:            J. Isaac Friend
 * Author URI:        http://jisaacfriend.com
 * Text Domain:       wp-dream-carousel
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/TaishiZiyi/wp_dream_carousel
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-wp-dream-carousel.php' );

require_once( plugin_dir_path( __FILE__ ) . 'public/class-tgm-plugin-activation.php' );

require_once( plugin_dir_path( __FILE__ ) . 'public/views/public.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'WPDreamCarousel', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'WPDreamCarousel', 'deactivate' ) );


add_action( 'plugins_loaded', array( 'WPDreamCarousel', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-wp-dream-carousel-admin.php' );
	add_action( 'plugins_loaded', array( 'WPDreamCarousel_Admin', 'get_instance' ) );

}