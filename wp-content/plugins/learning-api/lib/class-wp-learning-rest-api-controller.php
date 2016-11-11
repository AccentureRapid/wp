<?php


abstract class WP_Learning_REST_API_Controller {

	/**
	 * The namespace of this controller's route.
	 *
	 * @var string
	 */
	protected $namespace;

	/**
	 * The base of this controller's route.
	 *
	 * @var string
	 */
	protected $rest_base;

	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {
		_doing_it_wrong( 'WP_Learning_REST_API_Controller::register_routes', __( 'The register_routes() method must be overriden' ), 'WPAPI-2.0' );
	}

	/**
	 * Check if a given request has access to get items.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return WP_Error|boolean
	 */
	public function get_items_permissions_check( $request ) {
		return new WP_Error( 'invalid-method', sprintf( __( "Method '%s' not implemented. Must be over-ridden in subclass." ), __METHOD__ ), array( 'status' => 405 ) );
	}

	/**
	 * Get a collection of items.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return WP_Error|WP_REST_Response
	 */
	public function get_items( $request ) {
		return new WP_Error( 'invalid-method', sprintf( __( "Method '%s' not implemented. Must be over-ridden in subclass." ), __METHOD__ ), array( 'status' => 405 ) );
	}

	/**
	 * Check if a given request has access to get a specific item.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return WP_Error|boolean
	 */
	public function get_item_permissions_check( $request ) {
		return new WP_Error( 'invalid-method', sprintf( __( "Method '%s' not implemented. Must be over-ridden in subclass." ), __METHOD__ ), array( 'status' => 405 ) );
	}

	/**
	 * Get one item from the collection.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return WP_Error|WP_REST_Response
	 */
	public function get_item( $request ) {
		return new WP_Error( 'invalid-method', sprintf( __( "Method '%s' not implemented. Must be over-ridden in subclass." ), __METHOD__ ), array( 'status' => 405 ) );
	}
	
	/**
	 * Get the query params for collections.
	 *
	 * @return array
	 */
	public function get_collection_params() {
		return array(
				'context'                => $this->get_context_param(),
				'page'                   => array(
						'description'        => __( 'Current page of the collection.' ),
						'type'               => 'integer',
						'default'            => 1,
						'minimum'            => 1,
				),
				'per_page'               => array(
						'description'        => __( 'Maximum number of items to be returned in result set.' ),
						'type'               => 'integer',
						'default'            => 10,
						'minimum'            => 1,
						'maximum'            => 100
				),
				'search'                 => array(
						'description'        => __( 'Limit results to those matching a string.' ),
						'type'               => 'string'
				),
		);
	}
	

	/**
	 * Get the magical context param.
	 *
	 * Ensures consistent description between endpoints, and populates enum from schema.
	 *
	 * @param array     $args
	 * @return array
	 */
	public function get_context_param( $args = array() ) {
		$param_details = array(
				'description'        => __( 'Scope under which the request is made; determines fields present in response.' ),
				'type'               => 'string',
				'sanitize_callback'  => 'sanitize_key'
		);
		$schema = $this->get_item_schema();
		if ( empty( $schema['properties'] ) ) {
			return array_merge( $param_details, $args );
		}
		$contexts = array();
		foreach ( $schema['properties'] as $attributes ) {
			if ( ! empty( $attributes['context'] ) ) {
				$contexts = array_merge( $contexts, $attributes['context'] );
			}
		}
		if ( ! empty( $contexts ) ) {
			$param_details['enum'] = array_unique( $contexts );
			rsort( $param_details['enum'] );
		}
		return array_merge( $param_details, $args );
	}

    /**
     * Get the item's schema for display / public consumption purposes.
     *
     * @return array
     */
	public function get_public_item_schema() {

		$schema = $this->get_item_schema();

		foreach ( $schema['properties'] as &$property ) {
			if ( isset( $property['arg_options'] ) ) {
				unset( $property['arg_options'] );
			}
		}

		return $schema;
	}

    /**
     * Get the item's schema, conforming to JSON Schema.
     *
     * @return array
     */
	public function get_item_schema() {
		return $this->add_additional_fields_schema( array() );
	}

    /**
     * Add the schema from additional fields to an schema array.
     *
     * The type of object is inferred from the passed schema.
     *
     * @param array $schema Schema array.
     */
	protected function add_additional_fields_schema( $schema ) {
		if ( empty( $schema['title'] ) ) {
			return $schema;
		}

		/**
         * Can't use $this->get_object_type otherwise we cause an inf loop.
         */
		$object_type = $schema['title'];

		$additional_fields = $this->get_additional_fields( $object_type );

		foreach ( $additional_fields as $field_name => $field_options ) {
			if ( ! $field_options['schema'] ) {
				continue;
			}

			$schema['properties'][ $field_name ] = $field_options['schema'];
		}

		return $schema;
	}

}
