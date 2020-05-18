<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.quemalabs.com
 * @since      1.0.0
 *
 * @package    Lead_Captor
 * @subpackage Lead_Captor/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Lead_Captor
 * @subpackage Lead_Captor/admin
 * @author     Quema Labs
 */
class Lead_Captor_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $lead_captor    The ID of this plugin.
	 */
	private $lead_captor;

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
	 * @param      string    $lead_captor       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $lead_captor, $version ) {

		$this->lead_captor = $lead_captor;
		$this->version = $version;

        $this->options = get_option( 'lead_captor_popup_options' );
        $this->behavior_options = get_option( 'lead_captor_behavior_options' );
        $this->mailchimp_options = get_option( 'lead_captor_mailchimp_options' );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		$current_screen = get_current_screen();

		if ( is_customize_preview() || 'tools_page_lead-captor-admin' == $current_screen->id ) {

			wp_enqueue_style( 'flickity', plugin_dir_url( __FILE__ ) . 'css/flickity.css', array(), '2.0.5', 'all' );

			wp_enqueue_style( $this->lead_captor . '-public', plugins_url( '', dirname(__FILE__) ) . '/public/css/lead-captor-public.css', array(), $this->version, 'all' );

			wp_enqueue_style( $this->lead_captor, plugin_dir_url( __FILE__ ) . 'css/lead-captor-admin.css', array(), $this->version, 'all' );
		}



	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		$current_screen = get_current_screen();

		if ( is_customize_preview() || 'tools_page_lead-captor-admin' == $current_screen->id || 'edit-lead-subscriber' == $current_screen->id ) {

			wp_enqueue_media();

			wp_enqueue_script( 'imagesloaded', plugin_dir_url( __FILE__ ) . 'js/imagesloaded.pkgd.min.js', array(), '4.1.1', false );

			wp_enqueue_script( 'flickity', plugin_dir_url( __FILE__ ) . 'js/flickity.pkgd.min.js', array( 'imagesloaded' ), '2.0.5', false );

			wp_enqueue_script( $this->lead_captor, plugin_dir_url( __FILE__ ) . 'js/lead-captor-admin.js', array( 'jquery' ), $this->version, false );
			$popup_image = isset( $this->options['lead_captor_popup_image'] ) ? esc_attr( $this->options['lead_captor_popup_image'] ) : '';
			$template = isset( $this->options['lead_captor_popup_templates'] ) ? esc_attr( $this->options['lead_captor_popup_templates'] ) : '1';
			$lead_captor_js_var = array(
				'popup_image' => $popup_image,
				'template' => $template,
				'settings_page' => esc_url( admin_url( 'tools.php?page=lead-captor-admin&tab=export_subscribers' ) ),
				'export_text' => esc_attr__( 'Export CSV', 'lead-captor' ),
				'image_url' => esc_url( plugin_dir_url( __FILE__ ) . 'images/' ),
			);
			wp_localize_script( $this->lead_captor, 'lead_captor_var', $lead_captor_js_var );

		}

	}

	/**
	 * Register the Admin Menu
	 *
	 * @since    1.0.0
	 */
	public function register_menu() {

		add_submenu_page( 
			'tools.php', // $parent_slug
			esc_attr__( 'Lead Captor Settings', 'lead-captor' ), // $page_title
			esc_attr__( 'Lead Captor', 'lead-captor' ), // $menu_title
			'manage_options', // $capability, 
			'lead-captor-admin', // $menu_slug, 
			array( &$this, 'admin_page' )

		);

	}

	/**
	 * Include the Admin Page
	 *
	 * @since    1.0.0
	 */
	public function admin_page() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/lead-captor-admin-display.php';

	}

	/**
	 * Add Settings Options
	 *
	 * @since    1.0.0
	 */
	public function admin_settings_options() {

		add_settings_section( 
		    'lead_captor_popup_settings',
		    esc_attr__( 'Popup Settings', 'lead-captor' ),
		    array( &$this, 'lead_captor_popup_settings_callback' ),
		    'lead_captor_popup_options'
		);

		add_settings_field(  
		    'lead_captor_popup_templates',                      
		    esc_attr__( 'Templates', 'lead-captor' ),
		    array( &$this, 'lead_captor_popup_templates_callback' ),
		    'lead_captor_popup_options',                     
		    'lead_captor_popup_settings'
		);

		add_settings_field(  
		    'lead_captor_popup_title',                      
		    esc_attr__( 'Title', 'lead-captor' ),
		    array( &$this, 'lead_captor_popup_title_callback' ),
		    'lead_captor_popup_options',                     
		    'lead_captor_popup_settings'
		);

		add_settings_field(  
		    'lead_captor_popup_subtitle',                      
		    esc_attr__( 'Subtitle', 'lead-captor' ),
		    array( &$this, 'lead_captor_popup_subtitle_callback' ),
		    'lead_captor_popup_options',                     
		    'lead_captor_popup_settings'
		);

		add_settings_field(  
		    'lead_captor_popup_content',                      
		    esc_attr__( 'Content', 'lead-captor' ),
		    array( &$this, 'lead_captor_popup_content_callback' ),
		    'lead_captor_popup_options',                     
		    'lead_captor_popup_settings'
		);

		add_settings_field(  
		    'lead_captor_popup_button_text',                      
		    esc_attr__( 'Button Text', 'lead-captor' ),
		    array( &$this, 'lead_captor_popup_button_text_callback' ),
		    'lead_captor_popup_options',                     
		    'lead_captor_popup_settings'
		);

		add_settings_field(  
		    'lead_captor_popup_placeholder',                      
		    esc_attr__( 'Placeholder', 'lead-captor' ),
		    array( &$this, 'lead_captor_popup_placeholder_callback' ),
		    'lead_captor_popup_options',                     
		    'lead_captor_popup_settings'
		);

		add_settings_field(  
		    'lead_captor_popup_image',                      
		    esc_attr__( 'Image', 'lead-captor' ),
		    array( &$this, 'lead_captor_popup_image_callback' ),
		    'lead_captor_popup_options',                     
		    'lead_captor_popup_settings'
		);

		do_action( 'lead_captor_add_popup_settings' );

		register_setting( 'lead_captor_popup_options', 'lead_captor_popup_options', array( &$this, 'lead_captor_popup_settings_sanitize' ) );


		/**
		 * Behavior Settings
		 *
		 */
		add_settings_section( 
		    'lead_captor_behavior_settings',
		    esc_attr__( 'Behavior Settings', 'lead-captor' ),
		    array( &$this, 'lead_captor_behavior_settings_callback' ),
		    'lead_captor_behavior_options'
		);

		add_settings_field(  
		    'lead_captor_behavior_delay',                      
		    esc_attr__( 'Delay', 'lead-captor' ),
		    array( &$this, 'lead_captor_behavior_delay_callback' ),
		    'lead_captor_behavior_options',                     
		    'lead_captor_behavior_settings',
		    array( 'description' => esc_attr__( 'Time to wait before showing the popup, in milliseconds.', 'lead-captor' ) )
		);

		add_settings_field(  
		    'lead_captor_behavior_timer',                      
		    esc_attr__( 'Timer', 'lead-captor' ),
		    array( &$this, 'lead_captor_behavior_timer_callback' ),
		    'lead_captor_behavior_options',                     
		    'lead_captor_behavior_settings',
		    array( 'description' => esc_attr__( "By default, Lead Captor won't fire in the first second to prevent false positives, as it's unlikely the user will be able to exit the page within less than a second. If you want to change the amount of time that firing is surpressed for, you can pass in a number of milliseconds.", 'lead-captor' ) )
		);

		add_settings_field(  
		    'lead_captor_behavior_sensitivity',                      
		    esc_attr__( 'Sensitivity', 'lead-captor' ),
		    array( &$this, 'lead_captor_behavior_sensitivity_callback' ),
		    'lead_captor_behavior_options',                     
		    'lead_captor_behavior_settings',
		    array( 'description' => esc_attr__( "Lead Captor fires when the mouse cursor moves close to (or passes) the top of the viewport. You can define how far the mouse has to be before Lead Captor fires. The higher value, the more sensitive, and the more quickly the event will fire.", 'lead-captor' ) )
		);

		add_settings_field(  
		    'lead_captor_behavior_cookie_expiration',                      
		    esc_attr__( 'Cookie expiration', 'lead-captor' ),
		    array( &$this, 'lead_captor_behavior_cookie_expiration_callback' ),
		    'lead_captor_behavior_options',                     
		    'lead_captor_behavior_settings',
		    array( 'description' => esc_attr__( "Lead Captor sets a cookie by default to prevent the modal from appearing more than once per user. You can set the cookie expiration (in days) to adjust the time period before the modal will appear again for a user.", 'lead-captor' ) )
		);

		add_settings_field(  
		    'lead_captor_behavior_aggressive_mode',                      
		    esc_attr__( 'Aggressive mode', 'lead-captor' ),
		    array( &$this, 'lead_captor_behavior_aggressive_mode_callback' ),
		    'lead_captor_behavior_options',                     
		    'lead_captor_behavior_settings',
		    array( 'description' => esc_attr__( "By default, Lead Captor will only fire once for each visitor. When Lead Captor fires, a cookie is created to ensure a non obtrusive experience. If you enable aggressive mode, the popup will fire any time the page is reloaded, for the same user. This can be useful when testing a popup.", 'lead-captor' ) )
		);

		do_action( 'lead_captor_add_behavior_settings' );

		register_setting( 'lead_captor_behavior_options', 'lead_captor_behavior_options', array( &$this, 'lead_captor_behavior_settings_sanitize' ) );




		/**
		 * Export Subscribers
		 *
		 */
		add_settings_section( 
		    'lead_captor_export_subscribers',
		    esc_attr__( 'Export Subscribers', 'lead-captor' ),
		    array( &$this, 'lead_captor_export_subscribers_callback' ),
		    'lead_captor_export_subscribers_options'
		);

		add_settings_field(  
		    'lead_captor_export_subscribers_button',                      
		    esc_attr__( 'Export CSV', 'lead-captor' ),
		    array( &$this, 'lead_captor_export_subscribers_button_callback' ),
		    'lead_captor_export_subscribers_options',                     
		    'lead_captor_export_subscribers',
		    array( 'description' => esc_attr__( 'Exports all subscribers in a comma separated file.', 'lead-captor' ) )
		);

		do_action( 'lead_captor_add_export_settings' );

		register_setting( 'lead_captor_export_subscribers_options', 'lead_captor_export_subscribers_options', array( &$this, 'lead_captor_export_subscribers_sanitize' ) );



		/**
		 * MailChimp
		 *
		 */
		add_settings_section( 
		    'lead_captor_mailchimp_settings',
		    esc_attr__( 'MailChimp', 'lead-captor' ),
		    array( &$this, 'lead_captor_mailchimp_callback' ),
		    'lead_captor_mailchimp_options'
		);

		add_settings_field(  
		    'lead_captor_mailchimp_api_key',                      
		    esc_attr__( 'MailChimp API Key', 'lead-captor' ),
		    array( &$this, 'lead_captor_mailchimp_api_key_callback' ),
		    'lead_captor_mailchimp_options',                     
		    'lead_captor_mailchimp_settings',
		    array( 'description' => wp_kses_post( sprintf( __( 'Learn how to find or generate your %1$s API Key here %2$s.', 'lead-captor' ), '<a href="https://kb.mailchimp.com/integrations/api-integrations/about-api-keys#Find-or-Generate-Your-API-Key" target="_blank">', '</a>' ) ) )
		);

		add_settings_field(  
		    'lead_captor_mailchimp_list',                      
		    esc_attr__( 'List to add Subscribers', 'lead-captor' ),
		    array( &$this, 'lead_captor_mailchimp_list_callback' ),
		    'lead_captor_mailchimp_options',                     
		    'lead_captor_mailchimp_settings'
		);

		do_action( 'lead_captor_add_mailchimp_settings' );

		register_setting( 'lead_captor_mailchimp_options', 'lead_captor_mailchimp_options', array( &$this, 'lead_captor_mailchimp_sanitize' ) );
		




		

	}

	/**
	 * Sanitize Popup Options Fields
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_popup_settings_sanitize( $fields ) {

		$new_fields = array();

		if( isset( $fields['lead_captor_popup_content'] ) )
            $new_fields['lead_captor_popup_content'] = wp_kses_post( $fields['lead_captor_popup_content'] );

        if( isset( $fields['lead_captor_popup_title'] ) )
            $new_fields['lead_captor_popup_title'] = sanitize_text_field( $fields['lead_captor_popup_title'] );

        if( isset( $fields['lead_captor_popup_subtitle'] ) )
            $new_fields['lead_captor_popup_subtitle'] = sanitize_text_field( $fields['lead_captor_popup_subtitle'] );

        if( isset( $fields['lead_captor_popup_button_text'] ) )
            $new_fields['lead_captor_popup_button_text'] = sanitize_text_field( $fields['lead_captor_popup_button_text'] );

        if( isset( $fields['lead_captor_popup_placeholder'] ) )
            $new_fields['lead_captor_popup_placeholder'] = sanitize_text_field( $fields['lead_captor_popup_placeholder'] );

        if( isset( $fields['lead_captor_popup_templates'] ) )
            $new_fields['lead_captor_popup_templates'] = sanitize_text_field( $fields['lead_captor_popup_templates'] );

        if( isset( $fields['lead_captor_popup_image'] ) )
            $new_fields['lead_captor_popup_image'] = intval( $fields['lead_captor_popup_image'] );

        return $new_fields;

	}

	/**
	 * Sanitize Behavior Options Fields
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_behavior_settings_sanitize( $fields ) {

		$new_fields = array();

        if( isset( $fields['lead_captor_behavior_delay'] ) )
            $new_fields['lead_captor_behavior_delay'] = sanitize_text_field( $fields['lead_captor_behavior_delay'] );
        if( isset( $fields['lead_captor_behavior_timer'] ) )
            $new_fields['lead_captor_behavior_timer'] = sanitize_text_field( $fields['lead_captor_behavior_timer'] );
        if( isset( $fields['lead_captor_behavior_sensitivity'] ) )
            $new_fields['lead_captor_behavior_sensitivity'] = sanitize_text_field( $fields['lead_captor_behavior_sensitivity'] );
        if( isset( $fields['lead_captor_behavior_cookie_expiration'] ) )
            $new_fields['lead_captor_behavior_cookie_expiration'] = sanitize_text_field( $fields['lead_captor_behavior_cookie_expiration'] );
        if( isset( $fields['lead_captor_behavior_aggressive_mode'] ) )
            $new_fields['lead_captor_behavior_aggressive_mode'] = sanitize_text_field( $fields['lead_captor_behavior_aggressive_mode'] );

        return $new_fields;

	}

	/**
	 * Sanitize Export Subscribers Options Fields
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_export_subscribers_sanitize( $fields ) {

        return $fields;

	}


	/**
	 * Sanitize MailChimp Options Fields
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_mailchimp_sanitize( $fields ) {

        return $fields;

	}


	/**
	 * Popup Settings Description Callback
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_popup_settings_callback() {
		
	}

	/**
	 * Behavior Settings Description Callback
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_behavior_settings_callback() {
		
	}

	/**
	 * Export Subscribers Description Callback
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_export_subscribers_callback() {
		
	}

	/**
	 * MailChimp Description Callback
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_mailchimp_callback() {
		
	}

	/**
	 * Render Title option
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_popup_title_callback() {

	    printf(
            '<input type="text" class="regular-text" id="lead_captor_popup_title" name="lead_captor_popup_options[lead_captor_popup_title]" value="%s" />',
            isset( $this->options['lead_captor_popup_title'] ) ? esc_attr( $this->options['lead_captor_popup_title'] ) : esc_attr( 'Subscribe', 'lead-captor' )
        );
	}

	/**
	 * Render Subtitle option
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_popup_subtitle_callback() {

		printf(
            '<input type="text" class="regular-text" id="lead_captor_popup_subtitle" name="lead_captor_popup_options[lead_captor_popup_subtitle]" value="%s" />',
            isset( $this->options['lead_captor_popup_subtitle'] ) ? esc_attr( $this->options['lead_captor_popup_subtitle'] ) : esc_attr( 'Subscribe to our newsletter and receive theme updates and our latest news straight into your inbox.', 'lead-captor' )
        );
	}

	/**
	 * Render Content option
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_popup_content_callback() {

		$content = isset( $this->options['lead_captor_popup_content'] ) ? wp_kses_post( $this->options['lead_captor_popup_content'] ) : wp_kses_post( __( 'You’ll receive an exclusive tutorial for your WordPress site on:
<p class="lead_captor_item"><i class="lead-captor-file-check"></i>How to change your login URL</p>', 'lead-captor' ) );
		$editor_id = 'lead_captor_popup_content';

		wp_editor( $content, $editor_id, 
			array(
				'media_buttons' => false,
				'textarea_name' => 'lead_captor_popup_options[lead_captor_popup_content]',
				'textarea_rows' => 7,
				'teeny' => true
			) 
		);
	}

	/**
	 * Render Popup Button option
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_popup_button_text_callback() {

		printf(
            '<input type="text" class="regular-text" id="lead_captor_popup_button_text" name="lead_captor_popup_options[lead_captor_popup_button_text]" value="%s" />',
            isset( $this->options['lead_captor_popup_button_text'] ) ? esc_attr( $this->options['lead_captor_popup_button_text'] ) : esc_attr( 'Subscribe', 'lead-captor' )
        );
	}

	/**
	 * Render Placeholder option
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_popup_placeholder_callback() {

		printf(
            '<input type="text" class="regular-text" id="lead_captor_popup_placeholder" name="lead_captor_popup_options[lead_captor_popup_placeholder]" value="%s" />',
            isset( $this->options['lead_captor_popup_placeholder'] ) ? esc_attr( $this->options['lead_captor_popup_placeholder'] ) : esc_attr( 'Enter your email...', 'lead-captor' )
        );
	}

	/**
	 * Render Image option
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_popup_image_callback() {

		if ( isset( $this->options['lead_captor_popup_image'] ) ) {
			$image_src = wp_get_attachment_image_src( $this->options['lead_captor_popup_image'], 'small' );
		}
		echo "<div class='image-preview-wrapper'>";
			printf(
	            "<img id='lead_captor_image_preview' src='%s' >",
	            isset( $image_src[0] ) ? esc_url( $image_src[0] ) : ''
	        );
		echo "</div>";

        printf(
            "<input type='hidden' name='lead_captor_popup_options[lead_captor_popup_image]' id='lead_captor_popup_image' value='%s'>",
            isset( $this->options['lead_captor_popup_image'] ) ? esc_attr( $this->options['lead_captor_popup_image'] ) : ''
        );
        echo '<input type="button" class="button custom_media_button" id="custom_media_button" name="lead_captor_popup_options[lead_captor_popup_image]" value="' . esc_attr__( 'Upload Image', 'lead-captor' ) . '" style="margin-top:5px;"/>';
		
	}

	/**
	 * Render Templates option
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_popup_templates_callback() {

		$current_template = isset( $this->options['lead_captor_popup_templates'] ) ? esc_attr( $this->options['lead_captor_popup_templates'] ) : '1';

		global $lead_captor;
		$templates = $lead_captor->get_templates();
		


		
		$image_src = wp_get_attachment_image_src( $current_template, 'small' );

		echo "<div class='lead_captor_templates_wrapper'>";

			foreach ( $templates as $key => $template ) {
				$template_selected = '';
					$template_selected = ( ( $key + 1 ) == $current_template ) ? 'template-selected' : '';
				echo "<div class='slide " .esc_attr( $template_selected ) . "' data-id='" . esc_attr( ( $key + 1 ) ) . "'>";
					printf(
			            "<img src='%s' >",
			            isset( $template['image'] ) ? esc_url( $template['image'] ) : ''
			        );
				echo "</div>";
			}
			
		echo "</div>";

        printf(
            "<input type='hidden' name='lead_captor_popup_options[lead_captor_popup_templates]' id='lead_captor_popup_templates' value='%s'>",
            $current_template
        );

        ?>
		<tr>
			<th scope="row"><?php esc_attr_e( 'Preview', 'lead-captor' ); ?></th>
			<td>
				<div class="lead_captor_template_preview">
					<?php
					foreach ( $templates as $key => $template ) {
						$template_selected = '';
						$template_selected = ( ( $key + 1 ) == $current_template ) ? 'template-selected' : '';
						echo "<div class='slide " .esc_attr( $template_selected ) . "' data-id='" . esc_attr( ( $key + 1 ) ) . "'>";

							if ( isset( $this->options['lead_captor_popup_image'] ) ) {
								$image_src = wp_get_attachment_image_src( $this->options['lead_captor_popup_image'], 'small' );
							}

							$template_html = str_replace( "{{title}}", isset( $this->options['lead_captor_popup_title'] ) ? esc_attr( $this->options['lead_captor_popup_title'] ) : esc_attr( 'Subscribe', 'lead-captor' ), $template['html'] );
							$template_html = str_replace( "{{subtitle}}", isset( $this->options['lead_captor_popup_subtitle'] ) ? esc_attr( $this->options['lead_captor_popup_subtitle'] ) : esc_attr( 'Subscribe to our newsletter and receive theme updates and our latest news straight into your inbox.', 'lead-captor' ), $template_html );
							$template_html = str_replace( "{{content}}", isset( $this->options['lead_captor_popup_content'] ) ? $this->options['lead_captor_popup_content'] : wp_kses_post( __( 'You’ll receive an exclusive tutorial for your WordPress site on:
<p class="lead_captor_item"><i class="lead-captor-file-check"></i>How to change your login URL</p>', 'lead-captor' ) ), $template_html );
							$template_html = str_replace( "{{placeholder}}", isset( $this->options['lead_captor_popup_placeholder'] ) ? esc_attr( $this->options['lead_captor_popup_placeholder'] ) : esc_attr( 'Enter your email...', 'lead-captor' ), $template_html );
							$template_html = str_replace( "{{button_text}}", isset( $this->options['lead_captor_popup_button_text'] ) ? esc_attr( $this->options['lead_captor_popup_button_text'] ) : esc_attr( 'Subscribe', 'lead-captor' ), $template_html );
							$template_html = str_replace( "{{image}}", isset( $this->options['lead_captor_popup_image'] ) ? esc_url( $image_src[0] ) : '', $template_html );
							$template_html = str_replace( "{{token}}", '', $template_html );

							echo str_replace( "required", "", str_replace( "</form", "</div", str_replace( "<form", "<div", $template_html ) ) );
						echo "</div>";
					}

					?>
				</div>
			</td>
		</tr>
        <?php
		
	}


	/**
	 * Render Behavior Delay option
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_behavior_delay_callback($args) {

	    printf(
            '<input type="number" class="small-text" step="50" min="0" id="lead_captor_behavior_delay" name="lead_captor_behavior_options[lead_captor_behavior_delay]" value="%s" /> ',
            isset( $this->behavior_options['lead_captor_behavior_delay'] ) ? esc_attr( $this->behavior_options['lead_captor_behavior_delay'] ) : esc_attr( '0', 'lead-captor' )
        );
        esc_html_e( 'ms', 'lead-captor' );
        echo '<p class="description">' . esc_html( $args['description'] ) . '</p>';
	}

	/**
	 * Render Behavior Timer option
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_behavior_timer_callback($args) {

	    printf(
            '<input type="number" class="small-text" step="50" min="0" id="lead_captor_behavior_timer" name="lead_captor_behavior_options[lead_captor_behavior_timer]" value="%s" /> ',
            isset( $this->behavior_options['lead_captor_behavior_timer'] ) ? esc_attr( $this->behavior_options['lead_captor_behavior_timer'] ) : esc_attr( '0' )
        );
        esc_html_e( 'ms', 'lead-captor' );
        echo '<p class="description">' . esc_html( $args['description'] ) . '</p>';
	}

	/**
	 * Render Behavior Sensitivity option
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_behavior_sensitivity_callback($args) {

	    printf(
            '<input type="number" class="small-text" step="5" min="0" id="lead_captor_behavior_sensitivity" name="lead_captor_behavior_options[lead_captor_behavior_sensitivity]" value="%s" /> ',
            isset( $this->behavior_options['lead_captor_behavior_sensitivity'] ) ? esc_attr( $this->behavior_options['lead_captor_behavior_sensitivity'] ) : esc_attr( '40' )
        );
        echo '<p class="description">' . esc_html( $args['description'] ) . '</p>';
	}

	/**
	 * Render Behavior Cookie Expiration option
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_behavior_cookie_expiration_callback($args) {

	    printf(
            '<input type="number" class="small-text" step="1" min="0" id="lead_captor_behavior_cookie_expiration" name="lead_captor_behavior_options[lead_captor_behavior_cookie_expiration]" value="%s" /> ',
            isset( $this->behavior_options['lead_captor_behavior_cookie_expiration'] ) ? esc_attr( $this->behavior_options['lead_captor_behavior_cookie_expiration'] ) : esc_attr( '10' )
        );
        esc_html_e( 'days', 'lead-captor' );
        echo '<p class="description">' . esc_html( $args['description'] ) . '</p>';
	}

	/**
	 * Render Behavior Aggressive Mode option
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_behavior_aggressive_mode_callback($args) {

		$current_mode = isset( $this->behavior_options['lead_captor_behavior_aggressive_mode'] ) ? esc_attr( $this->behavior_options['lead_captor_behavior_aggressive_mode'] ) : 'false';
		echo '<select name="lead_captor_behavior_options[lead_captor_behavior_aggressive_mode]" id="lead_captor_behavior_aggressive_mode">';
			echo '<option value="false"' . selected( $current_mode, 'false', false ) . ' >Disable</option>';
    		echo '<option value="true"' . selected( $current_mode, 'true', false ) . ' >Enable</option>';
			
		echo '</select>';
        echo '<p class="description">' . esc_html( $args['description'] ) . '</p>';
	}

	/**
	 * Register Custom Post Type for Subscribers
	 *
	 * @since    1.0.0
	 */
	public function register_custom_post_type() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/custom-post-types.php';

	}

	/**
	 * Render Export Subscribers option
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_export_subscribers_button_callback($args) {

		echo '<a type="button" href="' . esc_url( admin_url( 'tools.php?page=lead-captor-admin&tab=export_subscribers&download=lead-captor-subscribers.csv' ) ) . '" class="button" id="lead_captor_export_subscribers_button" name="lead_captor_export_subscribers_options[lead_captor_export_subscribers_button]" style="margin-top:5px;">' . esc_attr__( 'Export CSV', 'lead-captor' ) . '</a>';

        echo '<p class="description">' . esc_html( $args['description'] ) . '</p>';
	}


	/**
	 * Export CSV
	 *
	 * @since    1.0.0
	 */
	public function export_csv() {

		global $pagenow;

		if ( $pagenow == 'tools.php' && isset($_GET['page']) && $_GET['page'] == 'lead-captor-admin' && isset($_GET['download']) && $_GET['download'] == 'lead-captor-subscribers.csv' ) {

			header("Content-type: application/x-msdownload");
	        header("Content-Disposition: attachment; filename=lead-captor-subscribers.csv");
	        header("Pragma: no-cache");
	        header("Expires: 0");
			$args = array(
			    'post_type'      => 'lead-subscriber',
			    'posts_per_page' => -1,
			);
			$the_query = new WP_Query( $args );
			$subscribers = array();
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) { $the_query->the_post();
					
					array_push( $subscribers, sanitize_email( get_the_title() ) );

				}//while
			}// if have posts
			wp_reset_postdata();

			$fp = fopen('php://output', 'w');
			fputcsv($fp, $subscribers);
			fclose($fp);
	        exit();
		}
	}


	/**
	 * Render MailChimp API Key
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_mailchimp_api_key_callback($args) {

	    printf(
            '<input type="text" class="regular-text" id="lead_captor_mailchimp_api_key" name="lead_captor_mailchimp_options[lead_captor_mailchimp_api_key]" value="%s" />',
            isset( $this->mailchimp_options['lead_captor_mailchimp_api_key'] ) ? esc_attr( $this->mailchimp_options['lead_captor_mailchimp_api_key'] ) : ''
        );
        echo '<p class="description">' . wp_kses_post( $args['description'] ) . '</p>';

	}

	/**
	 * Render MailChimp List to add Subscribers
	 *
	 * @since    1.0.0
	 */
	public function lead_captor_mailchimp_list_callback($args) {


		if ( ! empty( $this->mailchimp_options['lead_captor_mailchimp_api_key'] ) ) {
			$Lead_Captor_MailChimp = new Lead_Captor_MailChimp( $this->mailchimp_options['lead_captor_mailchimp_api_key'] );
			//Get lists from MailChimp
			$result = $Lead_Captor_MailChimp->get('lists');

			// Prepare default value
			$list_to_show = array( '0' => esc_attr__( 'Select list...', 'lead-captor' ) );

			//If there are any lists
			if ( array_key_exists( 'lists', $result ) ) {
				foreach ( $result['lists'] as $list ) {
					//Get the list's ID and Name
					$list_to_show[$list['id']] = $list['name'];
				}

				//Get the saved list from the user
				$current_list = isset( $this->mailchimp_options['lead_captor_mailchimp_list'] ) ? esc_attr( $this->mailchimp_options['lead_captor_mailchimp_list'] ) : '';
				//Create the select with all the lists
				echo '<select name="lead_captor_mailchimp_options[lead_captor_mailchimp_list]" id="lead_captor_mailchimp_list">';
					foreach ( $list_to_show as $key => $value ) {
						echo '<option value="' . esc_attr( $key ) . '"' . selected( $current_list, $key, false ) . ' >' . esc_html( $value ) . '</option>';
					}			
				echo '</select>';

			}elseif( array_key_exists( 'detail', $result ) ){
				//Show why it failed
				echo esc_html( $result['detail'] );
			}
		} else {
			esc_html_e( 'Add a valid API Key above.', 'lead-captor' );
		}

		

		


	}


	/**
	 * Adds settings link on Plugin page
	 *
	 * @since    1.0.0
	 */
	public function add_settings_link($links) {
		$settings_link = '<a href="' . esc_url( admin_url( 'tools.php?page=lead-captor-admin' ) ) . '">' . esc_html__( 'Settings', 'lead-captor' ) . '</a>';
	    array_push( $links, $settings_link );
	  	return $links;
	}

	

}
