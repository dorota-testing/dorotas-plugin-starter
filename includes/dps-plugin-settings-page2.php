<?php

/**
 * custom option and settings for page 2
 */
function dps_settings_init_2()
{
	// register a new setting for "dps" page
	register_setting('dps2', 'dps_options_page2', 'dps_validation_callback_2');

	// register a new section in the "dp2s" page
	add_settings_section(
		'dps_first_section',
		__('First section title on second page.', 'dps'),
		'dps_first_section_cb_2',
		'dps2'
	);
	// register a new field in the "dps_first_section" section, inside the "dps2" page
	add_settings_field(
		'dps_textfield_2', // as of WP 4.6 this value is used only internally
		// use $args' label_for to populate the id inside the callback
		__('Textfield', 'dps'),
		'dps_textfield_cb_2',
		'dps2',
		'dps_first_section',
		[
			'label_for' => 'dps_textfield_2',
			'class' => 'dps_row_wrap',
			'dps_custom_data' => 'lorem-data',
		]
	);
}
/**
 * register our dps_settings_init to the admin_init action hook
 */
add_action('admin_init', 'dps_settings_init_2');

/**
 * custom option and settings:
 * callback functions
 */
function dps_validation_callback_2($input)
{
	// echo '<pre>'; print_r($input); echo '</pre>';
	// die;
	$success = true;
	$error = '';
	if ($input['dps_textfield_2'] == '') {
		//		die('error');	
		$error = 'Please fill in this field.';
		//		$input = get_option('dps_options_page2');
		$success = false;
	}

	if ($success) {
		add_settings_error('dps_messages_2', 'dps_message', __('Settings Saved Second Page', 'dps'), 'updated');
	} else {
		// add one error for all		
		add_settings_error('dps_messages_2', 'dps_message', __($error, 'dps'), 'error');
	}

	return $input;
}
// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function dps_first_section_cb_2($args)
{
?>
	<p id="<?php echo esc_attr($args['id']); ?>"><?php esc_html_e('This is explanation text for the first section ON THE SECOND PAGE.', 'dps'); ?></p>
<?php
}

function dps_options_page_html2()
{
	// check user capabilities
	if (!current_user_can('manage_options')) {
		return;
	}
	// show error/update messages
	//  *****  NOTE - the line below needs to be uncomented if plugin has its own page in menu. If it is in submenu of settings or enything else, should be commented out. ****
	settings_errors('dps_messages_2');
?>
	<div class="wrap">
		<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
		<p>This is second page.</p>
	</div>
<?php
}

function dps_textfield_cb_2($args)
{
	// get the value of the setting we've registered with register_setting()
	$options = get_option('dps_options_page2');
	//echo '<pre>'; print_r($options_page2); echo '</pre>';
	// output the field
?>
	<input type="text" id="<?php echo esc_attr($args['label_for']); ?>" data-lorem="<?php echo esc_attr($args['dps_custom_data']); ?>" name="dps_options_page2[<?php echo esc_attr($args['label_for']); ?>]" value="<?= (isset($options[$args['label_for']]) ? $options[$args['label_for']] : '') ?>">

	<p class="description">
		<?php esc_html_e('Lorem ipsum dolor sit amet.', 'dps'); ?>
	</p>
<?php
}
