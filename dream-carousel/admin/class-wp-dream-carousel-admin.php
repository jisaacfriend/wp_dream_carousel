<?php
/**
 * WP Dream Carousel
 *
 * @package   WP_Dream_Carousel_Admin
 * @author    J. Isaac Friend <j.isaac.friend@fueledbydreams.com>
 * @license   GPL-2.0+
 * @link      http://wpdreamcarousel
 * @copyright 2014 J. Isaac Friend
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to `class-plugin-name.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package WP_Dream_Carousel_Admin
 * @author  J. Isaac Friend <j.isaac.friend@fueledbydreams.com>
 */
class WPDreamCarousel_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		/*
		 * Call $plugin_slug from public plugin class.
		 */
		$plugin = WPDreamCarousel::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		/*
		 * Define custom functionality.
		 *
		 * Read more about actions and filters:
		 * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
		add_action( '@TODO', array( $this, 'action_method_name' ) );
		add_filter( '@TODO', array( $this, 'filter_method_name' ) );
		
		//add_action( 'add_meta_boxes', array( $this, 'add_carousel_meta_boxes' ) );

	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @TODO:
	 *
	 * - Rename "Plugin_Name" to the name your plugin
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Plugin_Name::VERSION );
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @TODO:
	 *
	 * - Rename "Plugin_Name" to the name your plugin
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), WPDreamCarousel::VERSION );
		}

		wp_enqueue_media();

        // Register, localize and enqueue our custom JS.
        wp_register_script( 'tgm-nmp-media', plugins_url( 'assets/js/media.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
        wp_localize_script( 'tgm-nmp-media', 'tgm_nmp_media',
            array(
                'title'     => __( 'Upload or Choose Your Custom Image File', 'tgm-nmp' ), // This will be used as the default title
                'button'    => __( 'Insert Image into Input Field', 'tgm-nmp' )            // This will be used as the default button text
            )
        );
        wp_enqueue_script( 'tgm-nmp-media' );
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 * @TODO:
		 *
		 * - Change 'Page Title' to the title of your plugin admin page
		 * - Change 'Menu Text' to the text for menu item for the plugin settings page
		 * - Change 'manage_options' to the capability you see fit
		 *   For reference: http://codex.wordpress.org/Roles_and_Capabilities
		 */
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Page Title', $this->plugin_slug ),
			__( 'Menu Text', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			/*array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),*/
			$links
		);

	}

	/**
	 * NOTE:     Actions are points in the execution of a page or process
	 *           lifecycle that WordPress fires.
	 *
	 *           Actions:    http://codex.wordpress.org/Plugin_API#Actions
	 *           Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 * @since    1.0.0
	 */
	public function action_method_name() {
		// @TODO: Define your action hook callback here
	}
	
	/*public function add_carousel_meta_boxes() {

        // This metabox will only be loaded for pages.
        add_meta_box( 'wpdc-slides', __( 'Slideshow Contents', 'wp-dream-carousel' ), array( $this, 'render_carousel_metabox' ), 'wp_dream_carousel', 'normal', 'high' );

    }
	
	public function render_carousel_metabox( $post ) {

		$meta = get_post_meta( $post->ID, 'wpdc-slides', true );
		
		$i=0;
		echo
	    '<div id="slide-container">
		    <ul class="slider-data custom_repeatable">
			    <li class="slider_li" id="wpdc-slider-details_' . $i . '" style="border: 1px solid black; padding: 5px;">
			        <span id="handle" style="max-width: 15%; float: left; display: block;">
			            <span class="sort hndle" style="text-align: center; vertical-align: sub; display: block;">|||</span>
			        </span>
			        <span style="max-width: 70%; float: left; display: block;">
			            <img id="wpdc-image-preview" src="" />
			            <a href="#" class="tgm-open-media button button-primary" title="' . esc_attr__( "Click Here to Upload or Choose an Image", "wp-dream-carousel" ) . '">' . __( "Click Here to Upload or Choose an Image", "wp-dream-carousel" ) . '</a>
			            <input type="hidden" id="tgm-new-media-image" size="70" value="" name="wpdc-slide' . $i . '"/>
			            <a id="clear-all" style="display: none;" href="#">Remove Image</a>
			        </span>
			        <span style="display: block;">
			            <a class="repeatable-remove button" style="float: right; display: block;" href="#">-</a>
			        </span>
			        <span style="clear: both; display: block;"></span>
			    </li>
			</ul>
		</div>
		<a class="repeatable-add button" style="float: right; margin-right: 5px;" href="#">+</a>
		<div style="clear: both;"></div>';
	
    }*/

	/**
	 * NOTE:     Filters are points of execution in which WordPress modifies data
	 *           before saving it or sending it to the browser.
	 *
	 *           Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *           Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 * @since    1.0.0
	 */
	public function filter_method_name() {
		// @TODO: Define your filter hook callback here
	}

}
