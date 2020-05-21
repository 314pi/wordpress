<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.quemalabs.com
 * @since      1.0.0
 *
 * @package    Pi_Popup
 * @subpackage Pi_Popup/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Pi_Popup
 * @subpackage Pi_Popup/includes
 * @author     Quema Labs
 */
class Pi_Popup {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Pi_Popup_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $pi_popup    The string used to uniquely identify this plugin.
	 */
	protected $pi_popup;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The popups templates.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $templates    The popups templates.
	 */
	protected $templates;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->pi_popup = 'pi-popup';
		$this->version = '1.0.0';

		global $pi_popup_plugin_basename;
		$this->templates = array(
			array(
				'id' => 1,
				'image' => plugin_dir_url( $pi_popup_plugin_basename ) . 'admin/images/popup1.png',
				'html' => <<<EOD
<div class="pi_popup_popup1 pi_popup_popup">
    <div class="pi_popup_modal">
        <div class="pi_popup_header">
            <h3 class="pi_popup_title">{{title}}</h3>
            <p class="pi_popup_subtitle">{{subtitle}}</p>
        </div>
        
        <div class="pi_popup_body">

            <div class="pi_popup_content">
                {{content}}
            </div>
            
            <form action="https://quemalabs.createsend.com" method="post" class="pi_popup_form">
                <input placeholder="{{placeholder}}" class="pi_popup_subscribe_input" name="pi_popup_subscribe_input" type="email" required /><button type="submit" class="pi_popup_subscribe_btn">{{button_text}}</button>
                {{token}}

                <div class="pi_popup_loading"><div class="pi_popup_circle"><div class="pi_popup_circle1 pi_popup_child"></div><div class="pi_popup_circle2 pi_popup_child"></div><div class="pi_popup_circle3 pi_popup_child"></div><div class="pi_popup_circle4 pi_popup_child"></div><div class="pi_popup_circle5 pi_popup_child"></div><div class="pi_popup_circle6 pi_popup_child"></div><div class="pi_popup_circle7 pi_popup_child"></div><div class="pi_popup_circle8 pi_popup_child"></div><div class="pi_popup_circle9 pi_popup_child"></div><div class="pi_popup_circle10 pi_popup_child"></div><div class="pi_popup_circle11 pi_popup_child"></div><div class="pi_popup_circle12 pi_popup_child"></div></div></div>
            </form>

        </div>
        
    </div>
    <!-- <p class="pi_popup_footer">by <a href="https://www.quemalabs.com/plugin/pi-popup/">Pi Popup</a></p> -->
</div>
EOD
			),
			array(
				'id' => 2,
				'image' => plugin_dir_url( $pi_popup_plugin_basename ) . 'admin/images/popup2.png',
				'html' => <<<EOD
<div class="pi_popup_popup2 pi_popup_popup">
    <div class="pi_popup_modal">
        
        <div class="pi_popup_body">

            <h3 class="pi_popup_title">{{title}}</h3>
            
            <div class="pi_popup_content">
                {{content}}
            </div>
            
            <form action="https://quemalabs.createsend.com" method="post" class="pi_popup_form">
                <input placeholder="{{placeholder}}" class="pi_popup_subscribe_input" name="pi_popup_subscribe_input" type="email" required /><button type="submit" class="pi_popup_subscribe_btn">{{button_text}}</button>
                {{token}}

                <div class="pi_popup_loading"><div class="pi_popup_circle"><div class="pi_popup_circle1 pi_popup_child"></div><div class="pi_popup_circle2 pi_popup_child"></div><div class="pi_popup_circle3 pi_popup_child"></div><div class="pi_popup_circle4 pi_popup_child"></div><div class="pi_popup_circle5 pi_popup_child"></div><div class="pi_popup_circle6 pi_popup_child"></div><div class="pi_popup_circle7 pi_popup_child"></div><div class="pi_popup_circle8 pi_popup_child"></div><div class="pi_popup_circle9 pi_popup_child"></div><div class="pi_popup_circle10 pi_popup_child"></div><div class="pi_popup_circle11 pi_popup_child"></div><div class="pi_popup_circle12 pi_popup_child"></div></div></div>
            </form>

        </div>
        
    </div>
    <!-- <p class="pi_popup_footer">by <a href="https://www.quemalabs.com/plugin/pi-popup/">Pi Popup</a></p> -->
</div>
EOD
			),
			array(
				'id' => 3,
				'image' => plugin_dir_url( $pi_popup_plugin_basename ) . 'admin/images/popup3.png',
				'html' => <<<EOD
<div class="pi_popup_popup3 pi_popup_popup">
    <div class="pi_popup_modal">
        
        <div class="pi_popup_image">
            <img src="{{image}}" alt="">
        </div><div class="pi_popup_body">
            
            <h3 class="pi_popup_title">{{title}}</h3>
            <div class="pi_popup_content">
                {{content}}
            </div>
            
            <form action="https://quemalabs.createsend.com" method="post" class="pi_popup_form">
                <input placeholder="{{placeholder}}" class="pi_popup_subscribe_input" name="pi_popup_subscribe_input" type="email" required /><button type="submit" class="pi_popup_subscribe_btn">{{button_text}}</button>
                {{token}}

                <div class="pi_popup_loading"><div class="pi_popup_circle"><div class="pi_popup_circle1 pi_popup_child"></div><div class="pi_popup_circle2 pi_popup_child"></div><div class="pi_popup_circle3 pi_popup_child"></div><div class="pi_popup_circle4 pi_popup_child"></div><div class="pi_popup_circle5 pi_popup_child"></div><div class="pi_popup_circle6 pi_popup_child"></div><div class="pi_popup_circle7 pi_popup_child"></div><div class="pi_popup_circle8 pi_popup_child"></div><div class="pi_popup_circle9 pi_popup_child"></div><div class="pi_popup_circle10 pi_popup_child"></div><div class="pi_popup_circle11 pi_popup_child"></div><div class="pi_popup_circle12 pi_popup_child"></div></div></div>
            </form>

        </div>
        
    </div>
    <!-- <p class="pi_popup_footer">by <a href="https://www.quemalabs.com/plugin/pi-popup/">Pi Popup</a></p> -->
</div>
EOD
			),
			array(
				'id' => 4,
				'image' => plugin_dir_url( $pi_popup_plugin_basename ) . 'admin/images/popup4.png',
				'html' => <<<EOD
<div class="pi_popup_popup4 pi_popup_popup">
    <div class="pi_popup_modal">
        <div class="pi_popup_header">
            <h3 class="pi_popup_title">{{title}}</h3>
        </div>
        
        <div class="pi_popup_body">

            <div class="pi_popup_content">
                {{content}}
            </div>
            
            <form action="https://quemalabs.createsend.com" method="post" class="pi_popup_form">
                <input placeholder="{{placeholder}}" class="pi_popup_subscribe_input" name="pi_popup_subscribe_input" type="email" required /><button type="submit" class="pi_popup_subscribe_btn">{{button_text}}</button>
                {{token}}

                <div class="pi_popup_loading"><div class="pi_popup_circle"><div class="pi_popup_circle1 pi_popup_child"></div><div class="pi_popup_circle2 pi_popup_child"></div><div class="pi_popup_circle3 pi_popup_child"></div><div class="pi_popup_circle4 pi_popup_child"></div><div class="pi_popup_circle5 pi_popup_child"></div><div class="pi_popup_circle6 pi_popup_child"></div><div class="pi_popup_circle7 pi_popup_child"></div><div class="pi_popup_circle8 pi_popup_child"></div><div class="pi_popup_circle9 pi_popup_child"></div><div class="pi_popup_circle10 pi_popup_child"></div><div class="pi_popup_circle11 pi_popup_child"></div><div class="pi_popup_circle12 pi_popup_child"></div></div></div>
            </form>

        </div>
        
    </div>
    <!-- <p class="pi_popup_footer">by <a href="https://www.quemalabs.com/plugin/pi-popup/">Pi Popup</a></p> -->
</div>
EOD
			)
		);



		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Pi_Popup_Loader. Orchestrates the hooks of the plugin.
	 * - Pi_Popup_i18n. Defines internationalization functionality.
	 * - Pi_Popup_Admin. Defines all hooks for the admin area.
	 * - Pi_Popup_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pi-popup-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pi-popup-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-pi-popup-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-pi-popup-public.php';

		/**
		 * Wrapper for MailChimp's API
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pi-popup-mailchimp.php';

		$this->loader = new Pi_Popup_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Pi_Popup_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Pi_Popup_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Pi_Popup_Admin( $this->get_pi_popup(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'register_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'admin_settings_options' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_custom_post_type' );

		$this->loader->add_action( 'admin_init', $plugin_admin, 'export_csv' );

		global $pi_popup_plugin_basename;
		$this->loader->add_filter( 'plugin_action_links_' . $pi_popup_plugin_basename, $plugin_admin, 'add_settings_link' );
		

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Pi_Popup_Public( $this->get_pi_popup(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'print_html' );
		$this->loader->add_action( 'wp_ajax_nopriv_pi_popup_save_subscriber', $plugin_public, 'pi_popup_save_subscriber' );
		$this->loader->add_action( 'wp_ajax_pi_popup_save_subscriber', $plugin_public, 'pi_popup_save_subscriber' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_pi_popup() {
		return $this->pi_popup;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Pi_Popup_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the nice name of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_nice_name() {
		return esc_html__( 'Pi Popup', 'pi-popup' );
	}

	/**
	 * Retrieve templates
	 *
	 * @since     1.0.0
	 * @return    array    Retrieve templates
	 */
	public function get_templates() {
		$templates = $this->templates;
		return apply_filters( 'pi_popup_get_templates', $templates );
	}

}
