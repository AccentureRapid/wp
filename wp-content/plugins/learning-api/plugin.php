<?php
/**
 * @package Super Rocket
 * @version 1.0
 */
/*
 * Plugin Name: Learning API Plugin 
 * URI: http://github.com/AccentureRapid/wp 
 * Description: This is an API plugin for Learning CMS. 
 * Author: david.bingjian.yu, chaoran.wang 
 * Version: 1.0 Author 
 * URI: https://github.com/AccentureRapid
 */

/**
 * WP_Learning_REST_API_Controller class.
 */
if ( ! class_exists( 'WP_Learning_REST_API_Controller' ) ) {
	require_once dirname( __FILE__ ) . '/lib/class-wp-learning-rest-api-controller.php';
}

if ( ! class_exists( 'WP_Learning_REST_API_Courses_Controller' ) ) {
	require_once dirname( __FILE__ ) . '/lib/class-wp-learning-rest-api-courses-controller.php';
}

add_action( 'rest_api_init', 'create_initial_rest_routes', 0 );

register_activation_hook ( __FILE__, 'learning_api_install' );
register_deactivation_hook ( __FILE__, 'learning_api_uninstall' );



if ( ! function_exists( 'create_initial_rest_routes' ) ) {
	/**
     * Registers default REST API routes.
     *
     */
	function create_initial_rest_routes() {

	
		$controller = new WP_Learning_REST_API_Courses_Controller( 'Course' );
<<<<<<< HEAD
 		$controller->register_routes();
=======
>>>>>>> 64061c8c554bdebfb6165deac9093c3dc0362687
		
		register_rest_route_test();
		
<<<<<<< HEAD
		//TODO all the subclass need to be registered.
=======
		$controller->register_routes();
		register_rest_route_test();
>>>>>>> 64061c8c554bdebfb6165deac9093c3dc0362687
		
		foreach ( get_post_types( array( 'show_in_rest' => true ), 'objects' ) as $post_type ) {
			$class = ! empty( $post_type->rest_controller_class ) ? $post_type->rest_controller_class : 'WP_Learning_REST_API_Courses_Controller';

			if ( ! class_exists( $class ) ) {
				continue;
			}
			$controller = new $class( $post_type->name );
			if ( ! is_subclass_of( $controller, 'WP_Learning_REST_API_Controller' ) ) {
				continue;
			}

			$controller->register_routes();
		}
	}
}

function register_rest_route_test() {
	register_rest_route( 'wp/v2', '/author/(?P<id>\d+)', array(
	'methods' => 'GET',
	'callback' => 'my_awesome_func',
	) );
}
function my_awesome_func() {
<<<<<<< HEAD
	$test = get_post_types( array( 'show_in_rest' => true ), 'objects' );
	return $test;
=======
	return null;
>>>>>>> 64061c8c554bdebfb6165deac9093c3dc0362687
}
function learning_api_install() {
	global $wpdb;
	$table = $wpdb->prefix . 'Course';
	$sql = "create table $table(
                 id int auto_increment primary key,
	             title varchar(200),
                 name varchar(200),
	             description varchar(1000)
                 ) CHARSET=UTF8";
	$wpdb->query ($sql);
}

function learning_api_uninstall() {
	global $wpdb;
	$table = $wpdb->prefix . 'Course';
	$sql = "drop table $table";
	$wpdb->query ($sql);
}



?>
