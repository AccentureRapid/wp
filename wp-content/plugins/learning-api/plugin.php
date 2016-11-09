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

register_activation_hook ( __FILE__, 'learning_api_install' );
register_deactivation_hook ( __FILE__, 'learning_api_uninstall' );

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
