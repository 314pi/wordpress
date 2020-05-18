<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.quemalabs.com
 * @since      1.0.0
 *
 * @package    Lead_Captor
 * @subpackage Lead_Captor/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
if ( ! current_user_can( 'manage_options' ) )  {
	wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'lead-captor' ) );
}
?>
<div class="wrap lead_captor_admin">  
    <h2><?php esc_html_e( 'Lead Captor Settings', 'lead-captor' ); ?></h2>  
    <?php settings_errors(); ?>  

    <?php  
    $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'popup_settings';  
    ?>  

    <h2 class="nav-tab-wrapper">  
        <a href="?page=lead-captor-admin&tab=popup_settings" class="nav-tab <?php echo $active_tab == 'popup_settings' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Popup Settings', 'lead-captor' ); ?></a>  
        <a href="?page=lead-captor-admin&tab=behavior_settings" class="nav-tab <?php echo $active_tab == 'behavior_settings' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Behavior Settings', 'lead-captor' ); ?></a>
        <a href="?page=lead-captor-admin&tab=export_subscribers" class="nav-tab <?php echo $active_tab == 'export_subscribers' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Export Subscribers', 'lead-captor' ); ?></a>
        <a href="?page=lead-captor-admin&tab=mailchimp" class="nav-tab <?php echo $active_tab == 'mailchimp' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'MailChimp', 'lead-captor' ); ?></a>

        <?php do_action( 'lead_captor_after_admin_nav_tabs' ); ?>

    </h2>  


    <form method="post" action="options.php">  

        <?php 
        if( $active_tab == 'popup_settings' ) {  

            settings_fields( 'lead_captor_popup_options' );

            do_settings_sections( 'lead_captor_popup_options' );

            do_action( 'lead_captor_after_settings_sections' );


        } else if( $active_tab == 'behavior_settings' ) {

            settings_fields( 'lead_captor_behavior_options' );

            do_settings_sections( 'lead_captor_behavior_options' );

            do_action( 'lead_captor_after_behavior_sections' );

        } else if( $active_tab == 'export_subscribers' ) {

            settings_fields( 'lead_captor_export_subscribers_options' );

            do_settings_sections( 'lead_captor_export_subscribers_options' ); 

            do_action( 'lead_captor_after_export_sections' );

        } else if( $active_tab == 'mailchimp' ) {

            settings_fields( 'lead_captor_mailchimp_options' );

            do_settings_sections( 'lead_captor_mailchimp_options' ); 

            do_action( 'lead_captor_after_mailchimp_sections' );

        }

        do_action( 'lead_captor_after_admin_tabs' );

        ?>             
        <?php 
        if( $active_tab != 'export_subscribers' ) {
            submit_button(); 
        }
        ?>  
    </form> 

</div> 
