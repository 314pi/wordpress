<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.magicpi.top
 * @since      1.0.0
 *
 * @package    Pi_Popup
 * @subpackage Pi_Popup/public/partials
 */
?>
<div class="pi_popup_wrap">
<?php
global $pi_popup;
$templates = $pi_popup->get_templates();
$current_template = ( intval( isset( $this->options['pi_popup_popup_templates'] ) ? esc_attr( $this->options['pi_popup_popup_templates'] ) : '1' ) - 1 );

if ( isset( $this->options['pi_popup_popup_image'] ) ) {
	$image_src = wp_get_attachment_image_src( $this->options['pi_popup_popup_image'], 'small' );
}

$template_html = str_replace( "{{title}}", isset( $this->options['pi_popup_popup_title'] ) ? esc_attr( $this->options['pi_popup_popup_title'] ) : esc_attr( 'Subscribe', 'pi-popup' ), $templates[$current_template]['html'] );
$template_html = str_replace( "{{subtitle}}", isset( $this->options['pi_popup_popup_subtitle'] ) ? esc_attr( $this->options['pi_popup_popup_subtitle'] ) : esc_attr( 'Subscribe to our newsletter and receive theme updates and our latest news straight into your inbox.', 'pi-popup' ), $template_html );
$template_html = str_replace( "{{content}}", isset( $this->options['pi_popup_popup_content'] ) ? $this->options['pi_popup_popup_content'] : wp_kses_post( __( 'You’ll receive an exclusive tutorial for your WordPress site on:
<p class="pi_popup_item"><i class="pi-popup-file-check"></i>How to change your login URL</p>', 'pi-popup' ) ), $template_html );
$template_html = str_replace( "{{placeholder}}", isset( $this->options['pi_popup_popup_placeholder'] ) ? esc_attr( $this->options['pi_popup_popup_placeholder'] ) : esc_attr( 'Enter your email...', 'pi-popup' ), $template_html );
$template_html = str_replace( "{{button_text}}", isset( $this->options['pi_popup_popup_button_text'] ) ? esc_attr( $this->options['pi_popup_popup_button_text'] ) : esc_attr( 'Subscribe', 'pi-popup' ), $template_html );
$template_html = str_replace( "{{image}}", isset( $this->options['pi_popup_popup_image'] ) ? esc_url( $image_src[0] ) : '', $template_html );

$template_html = str_replace( "{{token}}", wp_nonce_field( 'pi-popup-secret', 'token', true, false ), $template_html );



echo $template_html;
?>
</div>