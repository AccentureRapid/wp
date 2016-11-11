<?php

class WP_Learning_REST_API_Courses_Controller extends WP_Learning_REST_API_Controller {

	public function __construct( ) {
		$this->namespace = 'wp/v2';
		$this->rest_base = '/course/(?P<id>\d+)';
	}

	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {

		register_rest_route( $this->namespace, '/' . $this->rest_base, array(
			array(
				'methods'         => WP_REST_Server::READABLE,
				'callback'        => array( $this, 'get_item' ),
				'permission_callback' => array( $this, 'get_item_permissions_check' ),
				'args'            => $this->get_collection_params(),
			),
			'schema' => array( $this, 'get_public_item_schema' ),
		) );
	}

	/**
	 * Check if a given request has access to read /posts.
	 *
	 * @param  WP_REST_Request $request Full details about the request.
	 * @return WP_Error|boolean
	 */
	public function get_items_permissions_check( $request ) {

		return true;
	}

	/**
	 * Get a collection of posts.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_Error|WP_REST_Response
	 */
	public function get_items( $request ) {

		return null;
	}

	/**
	 * Check if a given request has access to read a post.
	 *
	 * @param  WP_REST_Request $request Full details about the request.
	 * @return WP_Error|boolean
	 */
	public function get_item_permissions_check( $request ) {
        //TODO 


		return false;
	}


	/**
	 * Get a single post.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_Error|WP_REST_Response
	 */
	public function get_item( $request ) {
		$response = new WP_REST_Response('1', 200, null);
		return $response;
	}

    /**
     * Get the query params for collections of attachments.
     *
     * @return array
     */
	public function get_collection_params() {
		$params = parent::get_collection_params();
		$params['context']['default'] = 'view';
		return $params;
	}
	
	/**
	 * Get the Post's schema, conforming to JSON Schema.
	 *
	 * @return array
	 */
	public function get_item_schema() {
	
		return null;
	}
}
