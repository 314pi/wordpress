<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.quemalabs.com
 * @since      1.0.0
 *
 * @package    Pi_Popup
 * @subpackage Pi_Popup/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pi_Popup
 * @subpackage Pi_Popup/public
 * @author     Quema Labs
 */
class Pi_Popup_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $pi_popup    The ID of this plugin.
	 */
	private $pi_popup;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
     * Holds the values to be used in the fields callbacks
	 * @since    1.0.0
	 * @access   private
	 * @var      array
     */
    private $options;

    /**
     * Holds the values to be used in the fields callbacks
	 * @since    1.0.0
	 * @access   private
	 * @var      array
     */
    private $behavior_options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $pi_popup       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $pi_popup, $version ) {

		$this->pi_popup = $pi_popup;
		$this->version = $version;

		$this->options = get_option( 'pi_popup_popup_options' );
		$this->behavior_options = get_option( 'pi_popup_behavior_options' );
		$this->mailchimp_options = get_option( 'pi_popup_mailchimp_options' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->pi_popup, plugin_dir_url( __FILE__ ) . 'css/pi-popup-public.css', array(), $this->version, 'all' );

		$font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Lato:400,900' );
    	wp_enqueue_style( 'lato-font', $font_url, array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->pi_popup, plugin_dir_url( __FILE__ ) . 'js/pi-popup-public.js', array( 'jquery' ), $this->version, false );

		$delay = isset( $this->behavior_options['pi_popup_behavior_delay'] ) ? esc_attr( $this->behavior_options['pi_popup_behavior_delay'] ) : '0';
		$timer = isset( $this->behavior_options['pi_popup_behavior_timer'] ) ? esc_attr( $this->behavior_options['pi_popup_behavior_timer'] ) : '0';
		$sensitivity = isset( $this->behavior_options['pi_popup_behavior_sensitivity'] ) ? esc_attr( $this->behavior_options['pi_popup_behavior_sensitivity'] ) : '40';
		$cookie_expiration = isset( $this->behavior_options['pi_popup_behavior_cookie_expiration'] ) ? esc_attr( $this->behavior_options['pi_popup_behavior_cookie_expiration'] ) : '10';
		$aggressive_mode = isset( $this->behavior_options['pi_popup_behavior_aggressive_mode'] ) ? esc_attr( $this->behavior_options['pi_popup_behavior_aggressive_mode'] ) : 'false';
		$cookie_name = $this->pi_popup . '_' . sanitize_title( get_bloginfo( 'name' ) );
		$pi_popup_js_var = array(
			'delay' => $delay,
			'timer' => $timer,
			'sensitivity' => $sensitivity,
			'cookie_expiration' => $cookie_expiration,
			'aggressive_mode' => $aggressive_mode,
			'cookie_name' => $cookie_name,
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'token' => admin_url( 'admin-ajax.php' ),
		);
		wp_localize_script( $this->pi_popup, 'pi_popup_behavior', $pi_popup_js_var );

	}

	/**
	 * Print HTML
	 *
	 * @since    1.0.0
	 */
	public function print_html() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/pi-popup-public-display.php';

	}

	/**
	 * Save a new subscriber
	 *
	 * @since    1.0.0
	 */
	public function pi_popup_save_subscriber() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/ajax-functions.php';

	}

}
