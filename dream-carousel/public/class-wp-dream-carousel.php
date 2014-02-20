<?php
/**
 * WP Dream Carousel.
 *
 * @package   WP_Dream_Carousel
 * @author    J. Isaac Friend <j.isaac.friend@fueledbydreams.com>
 * @license   GPL-2.0+
 * @link      http://wpdreamcarousel.com
 * @copyright 2014 J. Isaac Friend
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-plugin-name-admin.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package WP_Dream_Carousel
 * @author  J. Isaac Friend <j.isaac.friend@fueledbydreams.com>
 */
class WPDreamCarousel {

        /**
         * Plugin version, used for cache-busting of style and script file references.
         *
         * @since   1.0.0
         *
         * @var     string
         */
        const VERSION = '1.0.0';

        /**
         * @TODO - Rename "plugin-name" to the name your your plugin
         *
         * Unique identifier for your plugin.
         *
         *
         * The variable name is used as the text domain when internationalizing strings
         * of text. Its value should match the Text Domain file header in the main
         * plugin file.
         *
         * @since    1.0.0
         *
         * @var      string
         */
        protected $plugin_slug = 'wp-dream-carousel';

        /**
         * Instance of this class.
         *
         * @since    1.0.0
         *
         * @var      object
         */
        protected static $instance = null;

        /**
         * Initialize the plugin by setting localization and loading public scripts
         * and styles.
         *
         * @since     1.0.0
         */
        private function __construct() {

                // Load plugin text domain
                add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
                
                // Create the custom post type
                add_action( 'init', array( $this, 'register_carousel_post_type' ) );

                // Activate plugin when new blog is added
                add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

                // Load public-facing style sheet and JavaScript.
                add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
                add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
          
                add_action( 'tgmpa_register', array( $this, 'wpdc_register_required_plugins' ) );
                
                add_action( 'wp_footer', array( $this, 'wpdc_footer_scripts' ) );
                
                $options = get_option( 'wpdc_settings' );
                if( '' != $options['image_width'] && '' != $options['image_height'] ) {
                	add_image_size( 'carousel', $options['image_width'], $options['image_height'] );
                }
        }

        /**
         * Return the plugin slug.
         *
         * @since    1.0.0
         *
         * @return    Plugin slug variable.
         */
        public function get_plugin_slug() {
                return $this->plugin_slug;
        }

        /**
         * Return an instance of this class.
         *
         * @since     1.0.0
         *
         * @return    object    A single instance of this class.
         */
        public static function get_instance() {

                // If the single instance hasn't been set, set it now.
                if ( null == self::$instance ) {
                        self::$instance = new self;
                }

                return self::$instance;
        }

        /**
         * Fired when the plugin is activated.
         *
         * @since    1.0.0
         *
         * @param    boolean    $network_wide    True if WPMU superadmin uses
         *                                       "Network Activate" action, false if
         *                                       WPMU is disabled or plugin is
         *                                       activated on an individual blog.
         */
        public static function activate( $network_wide ) {

                if ( function_exists( 'is_multisite' ) && is_multisite() ) {

                        if ( $network_wide  ) {

                                // Get all blog ids
                                $blog_ids = self::get_blog_ids();

                                foreach ( $blog_ids as $blog_id ) {

                                        switch_to_blog( $blog_id );
                                        self::single_activate();
                                }

                                restore_current_blog();

                        } else {
                                self::single_activate();
                        }

                } else {
                        self::single_activate();
                }

        }

        /**
         * Fired when the plugin is deactivated.
         *
         * @since    1.0.0
         *
         * @param    boolean    $network_wide    True if WPMU superadmin uses
         *                                       "Network Deactivate" action, false if
         *                                       WPMU is disabled or plugin is
         *                                       deactivated on an individual blog.
         */
        public static function deactivate( $network_wide ) {

                if ( function_exists( 'is_multisite' ) && is_multisite() ) {

                        if ( $network_wide ) {

                                // Get all blog ids
                                $blog_ids = self::get_blog_ids();

                                foreach ( $blog_ids as $blog_id ) {

                                        switch_to_blog( $blog_id );
                                        self::single_deactivate();

                                }

                                restore_current_blog();

                        } else {
                                self::single_deactivate();
                        }

                } else {
                        self::single_deactivate();
                }

        }

        /**
         * Fired when a new site is activated with a WPMU environment.
         *
         * @since    1.0.0
         *
         * @param    int    $blog_id    ID of the new blog.
         */
        public function activate_new_site( $blog_id ) {

                if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
                        return;
                }

                switch_to_blog( $blog_id );
                self::single_activate();
                restore_current_blog();

        }

        /**
         * Get all blog ids of blogs in the current network that are:
         * - not archived
         * - not spam
         * - not deleted
         *
         * @since    1.0.0
         *
         * @return   array|false    The blog ids, false if no matches.
         */
        private static function get_blog_ids() {

                global $wpdb;

                // get an array of blog ids
                $sql = "SELECT blog_id FROM $wpdb->blogs
                        WHERE archived = '0' AND spam = '0'
                        AND deleted = '0'";

                return $wpdb->get_col( $sql );

        }

        /**
         * Fired for each blog when the plugin is activated.
         *
         * @since    1.0.0
         */
        private static function single_activate() {
                // @TODO: Define activation functionality here
        }

        /**
         * Fired for each blog when the plugin is deactivated.
         *
         * @since    1.0.0
         */
        private static function single_deactivate() {
                // @TODO: Define deactivation functionality here
        }

        /**
         * Load the plugin text domain for translation.
         *
         * @since    1.0.0
         */
        public function load_plugin_textdomain() {

                $domain = $this->plugin_slug;
                $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

                load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
                load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

        }

        /**
         * Register and enqueue public-facing style sheet.
         *
         * @since    1.0.0
         */
        public function enqueue_styles() {
                wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'assets/css/public.css', __FILE__ ), array(), self::VERSION );
        }

        /**
         * Register and enqueues public-facing JavaScript files.
         *
         * @since    1.0.0
         */
        public function enqueue_scripts() {
                wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'assets/js/public.js', __FILE__ ), array( 'jquery' ), self::VERSION );
        }

        /**
         * NOTE:  Actions are points in the execution of a page or process
         *        lifecycle that WordPress fires.
         *
         *        Actions:    http://codex.wordpress.org/Plugin_API#Actions
         *        Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
         *
         * @since    1.0.0
         */
        public function action_method_name() {
                // @TODO: Define your action hook callback here
        }
        
        public function wpdc_register_required_plugins() {
	        $plugins = array(
	        	array(
	        		'name'		=> 'Piklist',
	        		'slug'		=> 'piklist',
	        		'required'	=> true,
	        	)
	        );
	        
	        $theme_text_domain = 'wp-dream-carousel';
	        		 
		    tgmpa( $plugins );
        }

        public function register_carousel_post_type() {
               $labels = array(
                        'name'                => _x( 'Dream Carousels', 'Post Type General Name', 'wp-dream-carousel' ),
                        'singular_name'       => _x( 'Dream Carousel', 'Post Type Singular Name', 'wp-dream-carousel' ),
                        'menu_name'           => __( 'Dream Carousel', 'wp-dream-carousel' ),
                        'parent_item_colon'   => __( 'Parent Item:', 'wp-dream-carousel' ),
                        'all_items'           => __( 'All Carousels', 'wp-dream-carousel' ),
                        'view_item'           => __( 'View Carousel', 'wp-dream-carousel' ),
                        'add_new_item'        => __( 'Add New Carousel', 'wp-dream-carousel' ),
                        'add_new'             => __( 'Add New', 'wp-dream-carousel' ),
                        'edit_item'           => __( 'Edit Carousel', 'wp-dream-carousel' ),
                        'update_item'         => __( 'Update Carousel', 'wp-dream-carousel' ),
                        'search_items'        => __( 'Search Carousels', 'wp-dream-carousel' ),
                        'not_found'           => __( 'Not found', 'wp-dream-carousel' ),
                        'not_found_in_trash'  => __( 'Not found in Trash', 'wp-dream-carousel' ),
                );
                $args = array(
                        'label'               => __( 'wp_dream_carousel', 'wp-dream-carousel' ),
                        'description'         => __( 'A post containing the slides for the carousel slider.', 'wp-dream-carousel' ),
                        'labels'              => $labels,
                        'supports'            => array( 'title', 'custom-fields' ),
                        'hierarchical'        => false,
                        'public'              => true,
                        'show_ui'             => true,
                        'show_in_menu'        => true,
                        'show_in_nav_menus'   => true,
                        'show_in_admin_bar'   => true,
                        'menu_position'       => 100,
                        'menu_icon'           => plugins_url( 'assets/carousel.png', dirname( __FILE__ ) ),
                        'can_export'          => true,
                        'has_archive'         => true,
                        'exclude_from_search' => false,
                        'publicly_queryable'  => true,
                        'capability_type'     => 'page',
                );
                register_post_type( 'wp_dream_carousel', $args );
        }

        public function wpdc_footer_scripts( $wpdc_slider ) {
	        global $wpdc_slider;
	        if( true === $wpdc_slider ) {
		        $options = get_option( 'wpdc_settings' );
		        $wpdc_footer_script = "
		        	<script>
				        $.Elastislide.defaults = {
					    
					    // orientation 'horizontal' || 'vertical'
					    orientation : '" . $options[ 'orientation' ] . "',
					 
					    // sliding speed
					    speed : " . $options[ 'speed' ] . ",
					 
					    // sliding easing
					    easing : '" . $options[ 'easing' ] . "',
					 
					    // the minimum number of items to show.
					    // when we resize the window, this will make sure minItems are always shown
					    // (unless of course minItems is higher than the total number of elements)
					    minItems : " . $options[ 'min_vis' ] . ",
					 
					    // index of the current item (left most item of the carousel)
					    start : 0,
						};
					</script>
					";
				echo $wpdc_footer_script;
	        } else {
		        echo "<h1>NOT WORKING</h1>";
	        }
        }

        public static function wp_dream_carousel( $id ) {
	        $wpdc_slider = true;
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
        }

		/**
		 * Create and add the shortcode used to display the slideshows
		 *
		 * @since    1.0.0
		 */
		//public function
		
        /**
         * NOTE:  Filters are points of execution in which WordPress modifies data
         *        before saving it or sending it to the browser.
         *
         *        Filters: http://codex.wordpress.org/Plugin_API#Filters
         *        Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
         *
         * @since    1.0.0
         */
        public function filter_method_name() {
                // @TODO: Define your filter hook callback here
        }
}