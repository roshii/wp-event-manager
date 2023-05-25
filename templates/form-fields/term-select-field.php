<?php
$field['default'] = isset($field['default']) ? $field['default'] : '';

// Get selected value
if (isset($field['value'])) {
	$selected = $field['value'];
} elseif (is_int($field['default'])) {
	$selected = $field['default'];
} elseif (!empty($field['default']) && ($term = get_term_by('slug', $field['default'], $field['taxonomy']))) {
	$selected = $term->term_id;
} else {
	$selected = '';
}
if($key == 'event_category'){
	$placeholder=__( 'Select a Category', 'wp-event-manager' );
}else if($key == 'event_type'){
	$placeholder=__( 'Choose an Event Type', 'wp-event-manager' );
}

// Select only supports 1 value
if (is_array($selected) && isset($field['value'])) {
	$selected = current($selected);
}else{
	$selected = '';
}
wp_dropdown_categories(apply_filters('event_manager_term_select_field_wp_dropdown_categories_args', array(

	'taxonomy'         => $field['taxonomy'],
	'hierarchical'     => 1,
	'show_option_all'  => $placeholder,
	'show_option_none' => $field['required'] ? '' : '-',
	'name'             => isset($field['name']) ? $field['name'] : $key,
	'orderby'          => 'name',
	'selected'         => $selected,
	'hide_empty'       => false
 
), $key, $field));


if (!empty($field['description'])) : ?>
	<small class="description">
		<?php echo esc_textarea($field['description']); ?>
	</small>
<?php endif; ?>