<?php
/**
 * Integration points with WordPress core that won't ever be committed
 */

if ( ! function_exists( 'rest_get_server' ) ) {
	/**
	 * Retrieves the current REST server instance.
	 *
	 * Instantiates a new instance if none exists already.
	 *
	 * @since 4.5.0
	 *
	 * @global WP_REST_Server $wp_rest_server REST server instance.
	 *
	 * @return WP_REST_Server REST server instance.
	 */
	function rest_get_server() {
		/* @var WP_REST_Server $wp_rest_server */
		global $wp_rest_server;

		if ( empty( $wp_rest_server ) ) {
			/**
			 * Filter the REST Server Class.
			 *
			 * This filter allows you to adjust the server class used by the API, using a
			 * different class to handle requests.
			 *
			 * @since 4.4.0
			 *
			 * @param string $class_name The name of the server class. Default 'WP_REST_Server'.
			 */
			$wp_rest_server_class = apply_filters( 'wp_rest_server_class', 'WP_REST_Server' );
			$wp_rest_server = new $wp_rest_server_class;

			/**
			 * Fires when preparing to serve an API request.
			 *
			 * Endpoint objects should be created and register their hooks on this action rather
			 * than another action to ensure they're only loaded when needed.
			 *
			 * @since 4.4.0
			 *
			 * @param WP_REST_Server $wp_rest_server Server object.
			 */
			do_action( 'rest_api_init', $wp_rest_server );
		}

		return $wp_rest_server;
	}
}
