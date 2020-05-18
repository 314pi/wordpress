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
 * @package    Lead_Captor
 * @subpackage Lead_Captor/includes
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
 * @package    Lead_Captor
 * @subpackage Lead_Captor/includes
 * @author     Quema Labs
 */
class Lead_Captor {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Lead_Captor_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $lead_captor    The string used to uniquely identify this plugin.
	 */
	protected $lead_captor;

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

		$this->lead_captor = 'lead-captor';
		$this->version = '1.0.0';

		global $lead_captor_plugin_basename;
		$this->templates = array(
			array(
				'id' => 1,
				'image' => plugin_dir_url( $lead_captor_plugin_basename ) . 'admin/images/popup1.png',
				'html' => <<<EOD
<div class="lead_captor_popup1 lead_captor_popup">
    <div class="lead_captor_modal">
        <div class="lead_captor_header">
            <h3 class="lead_captor_title">{{title}}</h3>
            <p class="lead_captor_subtitle">{{subtitle}}</p>
        </div>
        
        <div class="lead_captor_body">

            <div class="lead_captor_content">
                {{content}}
            </div>
            
            <form action="https://quemalabs.createsend.com" method="post" class="lead_captor_form">
                <input placeholder="{{placeholder}}" class="lead_captor_subscribe_input" name="lead_captor_subscribe_input" type="email" required /><button type="submit" class="lead_captor_subscribe_btn">{{button_text}}</button>
                {{token}}

                <div class="lead_captor_loading"><div class="lead_captor_circle"><div class="lead_captor_circle1 lead_captor_child"></div><div class="lead_captor_circle2 lead_captor_child"></div><div class="lead_captor_circle3 lead_captor_child"></div><div class="lead_captor_circle4 lead_captor_child"></div><div class="lead_captor_circle5 lead_captor_child"></div><div class="lead_captor_circle6 lead_captor_child"></div><div class="lead_captor_circle7 lead_captor_child"></div><div class="lead_captor_circle8 lead_captor_child"></div><div class="lead_captor_circle9 lead_captor_child"></div><div class="lead_captor_circle10 lead_captor_child"></div><div class="lead_captor_circle11 lead_captor_child"></div><div class="lead_captor_circle12 lead_captor_child"></div></div></div>
            </form>

        </div>
        
    </div>
    <p class="lead_captor_footer">by <a href="https://www.quemalabs.com/plugin/lead-captor/">Lead Captor</a></p>
</div>
EOD
			),
			array(
				'id' => 2,
				'image' => plugin_dir_url( $lead_captor_plugin_basename ) . 'admin/images/popup2.png',
				'html' => <<<EOD
<div class="lead_captor_popup2 lead_captor_popup">
    <div class="lead_captor_modal">
        
        <div class="lead_captor_body">

            <h3 class="lead_captor_title">{{title}}</h3>
            
            <div class="lead_captor_content">
                {{content}}
            </div>
            
            <form action="https://quemalabs.createsend.com" method="post" class="lead_captor_form">
                <input placeholder="{{placeholder}}" class="lead_captor_subscribe_input" name="lead_captor_subscribe_input" type="email" required /><button type="submit" class="lead_captor_subscribe_btn">{{button_text}}</button>
                {{token}}

                <div class="lead_captor_loading"><div class="lead_captor_circle"><div class="lead_captor_circle1 lead_captor_child"></div><div class="lead_captor_circle2 lead_captor_child"></div><div class="lead_captor_circle3 lead_captor_child"></div><div class="lead_captor_circle4 lead_captor_child"></div><div class="lead_captor_circle5 lead_captor_child"></div><div class="lead_captor_circle6 lead_captor_child"></div><div class="lead_captor_circle7 lead_captor_child"></div><div class="lead_captor_circle8 lead_captor_child"></div><div class="lead_captor_circle9 lead_captor_child"></div><div class="lead_captor_circle10 lead_captor_child"></div><div class="lead_captor_circle11 lead_captor_child"></div><div class="lead_captor_circle12 lead_captor_child"></div></div></div>
            </form>

        </div>
        
    </div>
    <p class="lead_captor_footer">by <a href="https://www.quemalabs.com/plugin/lead-captor/">Lead Captor</a></p>
</div>
EOD
			),
			array(
				'id' => 3,
				'image' => plugin_dir_url( $lead_captor_plugin_basename ) . 'admin/images/popup3.png',
				'html' => <<<EOD
<div class="lead_captor_popup3 lead_captor_popup">
    <div class="lead_captor_modal">
        
        <div class="lead_captor_image">
            <img src="{{image}}" alt="">
        </div><div class="lead_captor_body">
            
            <h3 class="lead_captor_title">{{title}}</h3>
            <div class="lead_captor_content">
                {{content}}
            </div>
            
            <form action="https://quemalabs.createsend.com" method="post" class="lead_captor_form">
                <input placeholder="{{placeholder}}" class="lead_captor_subscribe_input" name="lead_captor_subscribe_input" type="email" required /><button type="submit" class="lead_captor_subscribe_btn">{{button_text}}</button>
                {{token}}

                <div class="lead_captor_loading"><div class="lead_captor_circle"><div class="lead_captor_circle1 lead_captor_child"></div><div class="lead_captor_circle2 lead_captor_child"></div><div class="lead_captor_circle3 lead_captor_child"></div><div class="lead_captor_circle4 lead_captor_child"></div><div class="lead_captor_circle5 lead_captor_child"></div><div class="lead_captor_circle6 lead_captor_child"></div><div class="lead_captor_circle7 lead_captor_child"></div><div class="lead_captor_circle8 lead_captor_child"></div><div class="lead_captor_circle9 lead_captor_child"></div><div class="lead_captor_circle10 lead_captor_child"></div><div class="lead_captor_circle11 lead_captor_child"></div><div class="lead_captor_circle12 lead_captor_child"></div></div></div>
            </form>

        </div>
        
    </div>
    <p class="lead_captor_footer">by <a href="https://www.quemalabs.com/plugin/lead-captor/">Lead Captor</a></p>
</div>
EOD
			),
			array(
				'id' => 4,
				'image' => plugin_dir_url( $lead_captor_plugin_basename ) . 'admin/images/popup4.png',
				'html' => <<<EOD
<div class="lead_captor_popup4 lead_captor_popup">
    <div class="lead_captor_modal">
        <div class="lead_captor_header">
            <h3 class="lead_captor_title">{{title}}</h3>
        </div>
        
        <div class="lead_captor_body">

            <div class="lead_captor_content">
                {{content}}
            </div>
            
            <form action="https://quemalabs.createsend.com" method="post" class="lead_captor_form">
                <input placeholder="{{placeholder}}" class="lead_captor_subscribe_input" name="lead_captor_subscribe_input" type="email" required /><button type="submit" class="lead_captor_subscribe_btn">{{button_text}}</button>
                {{token}}

                <div class="lead_captor_loading"><div class="lead_captor_circle"><div class="lead_captor_circle1 lead_captor_child"></div><div class="lead_captor_circle2 lead_captor_child"></div><div class="lead_captor_circle3 lead_captor_child"></div><div class="lead_captor_circle4 lead_captor_child"></div><div class="lead_captor_circle5 lead_captor_child"></div><div class="lead_captor_circle6 lead_captor_child"></div><div class="lead_captor_circle7 lead_captor_child"></div><div class="lead_captor_circle8 lead_captor_child"></div><div class="lead_captor_circle9 lead_captor_child"></div><div class="lead_captor_circle10 lead_captor_child"></div><div class="lead_captor_circle11 lead_captor_child"></div><div class="lead_captor_circle12 lead_captor_child"></div></div></div>
            </form>

        </div>
        
    </div>
    <p class="lead_captor_footer">by <a href="https://www.quemalabs.com/plugin/lead-captor/">Lead Captor</a></p>
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
	 * - Lead_Captor_Loader. Orchestrates the hooks of the plugin.
	 * - Lead_Captor_i18n. Defines internationalization functionality.
	 * - Lead_Captor_Admin. Defines all hooks for the admin area.
	 * - Lead_Captor_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-lead-captor-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-lead-captor-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-lead-captor-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-lead-captor-public.php';

		/**
		 * Wrapper for MailChimp's API
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-lead-captor-mailchimp.php';

		$this->loader = new Lead_Captor_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Lead_Captor_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Lead_Captor_i18n();

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

		$plugin_admin = new Lead_Captor_Admin( $this->get_lead_captor(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'register_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'admin_settings_options' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_custom_post_type' );

		$this->loader->add_action( 'admin_init', $plugin_admin, 'export_csv' );

		global $lead_captor_plugin_basename;
		$this->loader->add_filter( 'plugin_action_links_' . $lead_captor_plugin_basename, $plugin_admin, 'add_settings_link' );
		

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Lead_Captor_Public( $this->get_lead_captor(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'print_html' );
		$this->loader->add_action( 'wp_ajax_nopriv_lead_captor_save_subscriber', $plugin_public, 'lead_captor_save_subscriber' );
		$this->loader->add_action( 'wp_ajax_lead_captor_save_subscriber', $plugin_public, 'lead_captor_save_subscriber' );

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
	public function get_lead_captor() {
		return $this->lead_captor;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Lead_Captor_Loader    Orchestrates the hooks of the plugin.
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
		return esc_html__( 'Lead Captor', 'lead-captor' );
	}

	/**
	 * Retrieve templates
	 *
	 * @since     1.0.0
	 * @return    array    Retrieve templates
	 */
	public function get_templates() {
		$templates = $this->templates;
		return apply_filters( 'lead_captor_get_templates', $templates );
	}

}
