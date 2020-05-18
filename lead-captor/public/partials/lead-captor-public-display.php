<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.quemalabs.com
 * @since      1.0.0
 *
 * @package    Lead_Captor
 * @subpackage Lead_Captor/public/partials
 */
?>
<div class="lead_captor_wrap">
<?php
global $lead_captor;
$templates = $lead_captor->get_templates();
$current_template = ( intval( isset( $this->options['lead_captor_popup_templates'] ) ? esc_attr( $this->options['lead_captor_popup_templates'] ) : '1' ) - 1 );

if ( isset( $this->options['lead_captor_popup_image'] ) ) {
	$image_src = wp_get_attachment_image_src( $this->options['lead_captor_popup_image'], 'small' );
}

$template_html = str_replace( "{{title}}", isset( $this->options['lead_captor_popup_title'] ) ? esc_attr( $this->options['lead_captor_popup_title'] ) : esc_attr( 'Subscribe', 'lead-captor' ), $templates[$current_template]['html'] );
$template_html = str_replace( "{{subtitle}}", isset( $this->options['lead_captor_popup_subtitle'] ) ? esc_attr( $this->options['lead_captor_popup_subtitle'] ) : esc_attr( 'Subscribe to our newsletter and receive theme updates and our latest news straight into your inbox.', 'lead-captor' ), $template_html );
$template_html = str_replace( "{{content}}", isset( $this->options['lead_captor_popup_content'] ) ? $this->options['lead_captor_popup_content'] : wp_kses_post( __( 'You’ll receive an exclusive tutorial for your WordPress site on:
<p class="lead_captor_item"><i class="lead-captor-file-check"></i>How to change your login URL</p>', 'lead-captor' ) ), $template_html );
$template_html = str_replace( "{{placeholder}}", isset( $this->options['lead_captor_popup_placeholder'] ) ? esc_attr( $this->options['lead_captor_popup_placeholder'] ) : esc_attr( 'Enter your email...', 'lead-captor' ), $template_html );
$template_html = str_replace( "{{button_text}}", isset( $this->options['lead_captor_popup_button_text'] ) ? esc_attr( $this->options['lead_captor_popup_button_text'] ) : esc_attr( 'Subscribe', 'lead-captor' ), $template_html );
$template_html = str_replace( "{{image}}", isset( $this->options['lead_captor_popup_image'] ) ? esc_url( $image_src[0] ) : '', $template_html );

$template_html = str_replace( "{{token}}", wp_nonce_field( 'lead-captor-secret', 'token', true, false ), $template_html );



echo $template_html;
?>
</div>