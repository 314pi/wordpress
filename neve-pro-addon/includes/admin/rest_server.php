<?php
/**
 * Handles rest api endpoints for the addon dashboard.
 *
 * Author:          Andrei Baicus <andrei@themeisle.com>
 * Created on:      2019-01-28
 *
 * @package Neve Pro Addon
 */

namespace Neve_Pro\Admin;

use Neve_Pro\Traits\Core;

/**
 * Class Rest_Server
 *
 * @package Neve Pro Addon
 */
class Rest_Server {
	use Core;
	/**
	 * Rest endpoint root.
	 *
	 * @var string
	 */
	private $endpoint_root;

	/**
	 * Rest_Server constructor.
	 *
	 * @param string $endpoint_root rest api endpoint root.
	 */
	public function __construct( $endpoint_root ) {
		if ( empty( $endpoint_root ) ) {
			return;
		}
		$this->endpoint_root = $endpoint_root;
		add_action( 'rest_api_init', array( $this, 'register_endpoints' ) );
	}

	/**
	 * Toggle the license key.
	 *
	 * @param \WP_REST_Request $request activation request.
	 *
	 * @return \WP_REST_Response
	 */
	public function toggle_license( \WP_REST_Request $request ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return new \WP_REST_Response(
				array(
					'message' => __( 'You are not allowed to change options.', 'neve' ),
					'success' => false,
				)
			);
		}

		$fields = json_decode( $request->get_body(), true );

		if ( ! isset( $fields['key'] ) || ! isset( $fields['action'] ) ) {
			return new \WP_REST_Response(
				array(
					'message' => __( 'Invalid Action. Please refresh the page and try again.', 'neve' ),
					'success' => false,
				)
			);
		}
		$response = apply_filters( 'themeisle_sdk_license_process_neve', $fields['key'], $fields['action'] );
		if ( is_wp_error( $response ) ) {
			return new \WP_REST_Response(
				array(
					'message' => __( 'Invalid license.', 'neve' ),
					'success' => false,
				)
			);
		}
		$license_data = $this->get_license_data();
		return new \WP_REST_Response(
			array(
				'message' => $fields['action'] === 'activate' ? __( 'Activated.', 'neve' ) : __( 'Deactivated', 'neve' ),
				'success' => true,
				'license' => [
					'key'        => isset( $license_data->key ) ? $license_data->key : false,
					'valid'      => isset( $license_data->license ) ? $license_data->license : false,
					'expiration' => $this->get_license_expiration_date(),
					'tier'       => $this->get_license_type(),
				],
			)
		);
	}

	/**
	 * Register rest endpoints
	 */
	public function register_endpoints() {
		register_rest_route(
			$this->endpoint_root,
			'/toggle_license',
			[
				'methods'             => \WP_REST_Server::CREATABLE,
				'callback'            => [ $this, 'toggle_license' ],
				'permission_callback' => function () {
					return current_user_can( 'manage_options' );
				},
				'args'                => [
					'key'    => [
						'type'              => 'string',
						'sanitize_callback' => function ( $key ) {
							return (string) esc_attr( $key );
						},
						'validate_callback' => function ( $key ) {
							return is_string( $key );
						},
					],
					'action' => [
						'type'              => 'string',
						'sanitize_callback' => function ( $key ) {
							return (string) esc_attr( $key );
						},
						'validate_callback' => function ( $key ) {
							return in_array( $key, [ 'activate', 'deactivate' ], true );
						},
					],
				],
			]
		);
	}
}
