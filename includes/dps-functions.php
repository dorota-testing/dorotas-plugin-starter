<?php
/**
 * Dorota's Plugin Starter - Functions
 * 
 * @version	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
add_action( 'wp_enqueue_scripts', 'dps_load_scripts' ); // scripts active on site
add_action( 'admin_enqueue_scripts', 'dps_load_admin_scripts' ); // scripts active in admin

function dps_load_admin_scripts($page) {
//die($page);
	if( strpos( $page, 'page_dps' ) !== false) {
		// Enqueue WordPress media scripts
		wp_enqueue_media();
		wp_enqueue_script( 'dps-script', plugins_url('/assets/js/dps_admin_script.js', dirname(__FILE__) ), 'jquery' , filemtime( DPS_PATH . '/assets/js/dps_admin_script.js'), true );

	// this is the way to include custom css
		wp_register_style( 'dps-style-admin', plugins_url('/assets/css/dps-style-admin.css', dirname(__FILE__) ), array(), filemtime( DPS_PATH . '/assets/css/dps-style-admin.css') );
		wp_enqueue_style( 'dps-style-admin' );
	}
}
// scripts & css for frontend
function dps_load_scripts() {
		wp_enqueue_script( 'dps-script', plugins_url('/assets/js/dps_script.js', dirname(__FILE__) ), 'jquery' , filemtime( DPS_PATH . '/assets/js/dps_script.js') , true );
		
		wp_register_style( 'dps-style', plugins_url('/assets/css/dps-style.css', dirname(__FILE__) ), array(), filemtime( DPS_PATH . '/assets/css/dps-style.css')  );
		wp_enqueue_style( 'dps-style' );	
}

function dps_return_lorem(){
	return 'lorem';
}

function dps_modify_post_title($title){	
	$title = $title.' Dorota added this. ';
	return $title;
}

function dps_modify_post(){
	add_filter('the_title', 'dps_modify_post_title');
}