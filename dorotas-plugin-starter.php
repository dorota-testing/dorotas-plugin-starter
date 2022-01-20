<?php
/*
Plugin Name:  Dorota's Plugin Starter
Description:  Boilerplate for plugins.
Version:      1.0.0
Author:       Dorota Lewinska
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/
/* Start Adding Functions Below this Line */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Check if certain plugin is active
**/
//if ( ( in_array( 'plugin-dir-name/plugin-file-name.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) ){	
    // All functions will run only when certain plugin is active
	
	define( 'DPS_PATH', plugin_dir_path( __FILE__ ) );
	define( 'DPS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

	require_once( DPS_PATH . 'includes/dps-functions.php' );
	require_once( DPS_PATH . 'includes/dps-plugin-settings.php' );

// load and initialise optional libraries. 
//if(!class_exists('ClassName') && !class_exists('AnotherClassName')){
//	require_once( DPS_PATH . 'dir-name/dir/ClassName.php' );	
//}	
	function dps_add_settings_link( $links ) {
		$settings_link = '<a href="options-general.php?page=dps">' . __( 'Settings' ) . '</a>';
		array_push( $links, $settings_link );
		return $links;
	}
	add_filter( "plugin_action_links_".DPS_PLUGIN_BASENAME, 'dps_add_settings_link' );

	// create database on activation
	global $dps_db_version;
	$dps_db_version = '1.0';

	function dps_activate() {
	//this is hook to be used on deleting plugin	
	register_uninstall_hook( __FILE__, 'dps_uninstall' );
		
		global $wpdb;
		global $dps_db_version;

		$table_name1 = $wpdb->prefix . 'dps_lorem_ipsum';
		$table_name2 = $wpdb->prefix . 'dps_dolor_sit_amet';
		
		$charset_collate = $wpdb->get_charset_collate();

		$sql1 = "CREATE TABLE $table_name1 (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			email varchar(200) DEFAULT '' NOT NULL,
			user_id varchar(11) DEFAULT '' NOT NULL,
			date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,	
			PRIMARY KEY  (id)
		) $charset_collate;";
		
		$sql2 = "CREATE TABLE $table_name2 (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			column_name varchar(200) DEFAULT '' NOT NULL,
			date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,	
			PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql1 );
		dbDelta( $sql2 );

		add_option( 'dps_db_version', $dps_db_version );
		// I can add options here if I need defult values or if there won't be admin settings page
		/*/
		add_option( 'dps_options_array', array() );
		add_option("dps_setting1", "default1", "", "yes");
		add_option("dps_setting2", "default2", "", "yes");
		add_option("dps_setting3", "default3", "", "yes");
		add_option("dps_setting4", "default4", "", "yes");
		/*/
	}

	register_activation_hook( __FILE__, 'dps_activate' );

	//
	function dps_uninstall(){
		//  codes to perform during unistallation
		//  delete table from db
			global $wpdb;
			$table_name1 = $wpdb->prefix . 'dps_lorem_ipsum';
			$sql1 = "DROP TABLE IF EXISTS $table_name1;";
			$wpdb->query($sql1);
			
			$table_name2 = $wpdb->prefix . 'dps_dolor_sit_amet';
			$sql2 = "DROP TABLE IF EXISTS $table_name2;";
			$wpdb->query($sql2);
			
 			delete_option("dps_db_version");	
/*			delete_option("dps_options_array");
			delete_option("dps_setting1");
			delete_option("dps_setting2");
			delete_option("dps_setting3");
			delete_option("dps_setting4"); */
	}
//} //if certain plugin is active
/* Stop Adding Functions Below this Line */
?>