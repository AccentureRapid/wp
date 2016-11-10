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

	
		$controller = new WP_Learning_REST_API_Courses_Controller();
 		$controller->register_routes();
		register_rest_route_test();

		//TODO all the subclass need to be registered.
	}
}

function register_rest_route_test() {
	register_rest_route( 'wp/v2', '/author/(?P<id>\d+)', array(
	'methods' => 'GET',
	'callback' => 'my_awesome_func',
	) );
}
function my_awesome_func() {
	return 1;

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
