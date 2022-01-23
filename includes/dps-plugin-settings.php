<?php

/**
 * My sample plugin - Settings
 * 
 * Example based on https://developer.wordpress.org/plugins/settings/custom-settings-page/.
 * 
 * @version	1.0
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */
/**
 * top level menu
 */
function dps_options_page()
{
	// first one makes new menu item, second ads into settings submenu	
	//
	// add top level menu page
	add_menu_page(
		'Plugin Starter (Title)',
		'Plugin Starter (Menu)',
		'manage_options',
		'dps', //slug
		'dps_options_page_html', // callback function
		'dashicons-lock', //icon
		100 //position in menu. if empty will go to the very bottom
	);
	//
	// create new item in Plugin menu
	add_submenu_page(
		'dps',  //parent slug
		'Plugin Starter2 (Title)',
		'Plugin Starter2 (Menu)',
		'manage_options',
		'dps2', //slug
		'dps_options_page_html2'
	);
}

/**
 * register our dps_options_page to the admin_menu action hook
 */
add_action('admin_menu', 'dps_options_page');



/**
 * include settings for page 1
 */

require_once('dps-plugin-settings-page1.php');

 /**
 * include settings for page 2
 */
require_once('dps-plugin-settings-page2.php');
