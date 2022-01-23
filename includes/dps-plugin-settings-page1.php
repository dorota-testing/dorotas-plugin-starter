<?php

/** 
 * custom option and settings for page 1
 */
function dps_settings_init()
{
	// register a new setting for "dps" page
	register_setting('dps', 'dps_options', 'dps_validation_callback');

	// register a new section in the "dps" page
	add_settings_section(
		'dps_first_section',
		__('First section title.', 'dps'),
		'dps_first_section_cb',
		'dps'
	);
	// register a second section in the "dps" page
	add_settings_section(
		'dps_second_section',
		__('This is second section.', 'dps'),
		'dps_second_section_cb',
		'dps'
	);
	// register a new field in the "dps_first_section" section, inside the "dps" page
	add_settings_field(
		'dps_dropdown', // as of WP 4.6 this value is used only internally
		// use $args' label_for to populate the id inside the callback
		__('Dropdown', 'dps'),
		'dps_dropdown_cb',
		'dps',
		'dps_first_section',
		[
			'label_for' => 'dps_dropdown',
			'class' => 'dps_row_wrap',
			'dps_custom_data' => 'custom',
		]
	);
	// register a new field in the "dps_first_section" section, inside the "dps" page
	add_settings_field(
		'dps_textfield', // as of WP 4.6 this value is used only internally
		// use $args' label_for to populate the id inside the callback
		__('Textfield', 'dps'),
		'dps_textfield_cb',
		'dps',
		'dps_first_section',
		[
			'label_for' => 'dps_textfield',
			'class' => 'dps_row_wrap',
			'dps_custom_data' => 'lorem',
		]
	);
	// register a new field in the "dps_first_section" section, inside the "dps" page
	add_settings_field(
		'dps_textarea', // as of WP 4.6 this value is used only internally
		// use $args' label_for to populate the id inside the callback
		__('Textarea', 'dps'),
		'dps_textarea_cb',
		'dps',
		'dps_first_section',
		[
			'label_for' => 'dps_textarea',
			'class' => 'dps_row_wrap',
		]
	);

}

/**
 * register our dps_settings_init to the admin_init action hook
 */
add_action('admin_init', 'dps_settings_init');

/**
 * custom option and settings:
 * callback functions
 */
function dps_validation_callback($input)
{
	// echo '<pre>'; print_r($input); echo '</pre>';
	// die;
	$success = true;
	$error = '';
	if ($input['dps_dropdown'] == '') {
		//		die('error');	
		$error = 'Please select a Dropdown.';
		//		$input = get_option('dps_options');
		$success = false;
	}
	if ($input['dps_textfield'] == '') {
		//		die('error');
		if ($error != '') {
			$error .= '</br>';
		}
		$error .= 'Textfield is mandatory.';
		//		$input = get_option('dps_options');
		$success = false;
	}

	if ($success) {
		add_settings_error('dps_messages', 'dps_message', __('Settings Saved lorem', 'dps'), 'updated');
	} else {
		// add one error for all		
		add_settings_error('dps_messages', 'dps_message', __($error, 'dps'), 'error');
	}

	return $input;
}

// developers section cb

// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function dps_first_section_cb($args)
{
?>
	<p id="<?php echo esc_attr($args['id']); ?>"><?php esc_html_e('This is explanation text for the first section.', 'dps'); ?></p>
<?php
}
function dps_second_section_cb($args)
{
?>
	<p id="<?php echo esc_attr($args['id']); ?>"><?php esc_html_e('Consecterur adipiscing elit.', 'dps'); ?></p>
<?php
}

// dropdown field cb

// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: label_for, class.
// the "label_for" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.
function dps_dropdown_cb($args)
{
	// get the value of the setting we've registered with register_setting()
	$options = get_option('dps_options');
	//echo '<pre>'; print_r($options); echo '</pre>';
	// output the field
?>
	<select id="<?php echo esc_attr($args['label_for']); ?>" data-custom="<?php echo esc_attr($args['dps_custom_data']); ?>" name="dps_options[<?php echo esc_attr($args['label_for']); ?>]">
		<option value="" <?php echo isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], '', false)) : (''); ?>>
			<?php esc_html_e('Select...', 'dps'); ?>
		</option>
		<option value="red" <?php echo isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], 'red', false)) : (''); ?>>
			<?php esc_html_e('option one', 'dps'); ?>
		</option>
		<option value="blue" <?php echo isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], 'blue', false)) : (''); ?>>
			<?php esc_html_e('option two', 'dps'); ?>
		</option>
	</select>
	<p class="description">
		<?php esc_html_e('Some description goes here.', 'dps'); ?>
	</p>
	<p class="description">
		<?php esc_html_e('Some more description follows.', 'dps'); ?>
	</p>
<?php
}
function dps_textfield_cb($args)
{
	// get the value of the setting we've registered with register_setting()
	$options = get_option('dps_options');
	//echo '<pre>'; print_r($options); echo '</pre>';
	// output the field
?>
	<input type="text" id="<?php echo esc_attr($args['label_for']); ?>" data-lorem="<?php echo esc_attr($args['dps_custom_data']); ?>" name="dps_options[<?php echo esc_attr($args['label_for']); ?>]" value="<?= (isset($options[$args['label_for']]) ? $options[$args['label_for']] : '') ?>">

	<p class="description">
		<?php esc_html_e('Lorem ipsum dolor sit amet.', 'dps'); ?>
	</p>
<?php
}
function dps_textarea_cb($args)
{
	// get the value of the setting we've registered with register_setting()
	$options = get_option('dps_options');
	//echo '<pre>'; print_r($options); echo '</pre>';
	// output the field
?>
	<textarea id="<?php echo esc_attr($args['label_for']); ?>" name="dps_options[<?php echo esc_attr($args['label_for']); ?>]"><?= (isset($options[$args['label_for']]) ? $options[$args['label_for']] : '') ?></textarea>

	<p class="description">
		<?php esc_html_e('Consectetur adipiscing elit.', 'dps'); ?>
	</p>
<?php
}


/**
 * callback functions
 */
function dps_options_page_html()
{
	// check user capabilities
	if (!current_user_can('manage_options')) {
		return;
	}

	// show error/update messages
	//  *****  NOTE - the line below needs to be uncomented if plugin has its own page in menu. If it is in submenu of settings or enything else, should be commented out. ****
	settings_errors('dps_messages');
?>
	<div class="wrap">
		<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
		<form action="options.php" method="post">
			<?php
			// output security fields for the registered setting "dps"
			settings_fields('dps');
			// output setting sections and their fields
			// (sections are registered for "dps", each field is registered to a specific section)
			do_settings_sections('dps');
			// output save settings button
			submit_button('Save Settings');
			?>
		</form>
	</div>
<?php
}
