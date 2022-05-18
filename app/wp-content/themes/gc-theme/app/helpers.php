<?php

/**
 * Theme helpers.
 */

namespace App;

/**
 * translateImage Translate image url
 *
 * @param  string $path The image path
 * @return void
 */
function translateImage($path) {
    if(empty($path))
        return '';

    $locale = get_locale();
    $language = $locale != 'pt_BR' ? $locale . '/' : '';

    return \Roots\asset('images/' . $language . $path);
}

/**
 * Simple boolean helper to check if ACF is on.
 * @return boolean
 */
function is_acf() {
	return function_exists('get_field');
}

/**
 * Helper function for ACF get_field function
 * @param  string 	$field   	Field name
 * @param  mixed 	$object_id 	Optionally pass the object ID
 * @return mixed          		Returns contents of get_field
 */
function gf($field, $object_id = null) {
	if(!is_acf())
		return false;

    return get_field($field, $object_id);
}
