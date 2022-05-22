<?php

/**
 * Theme helpers.
 */

namespace App;

/**
 * Translate image url
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
 *
 * @return boolean
 */
function is_acf() {
	return function_exists('get_field');
}

/**
 * Helper function for ACF get_field function
 *
 * @param  string 	$field   	Field name
 * @param  mixed 	$object_id 	Optionally pass the object ID
 * @return mixed          		Returns contents of get_field
 */
function gf($field, $object_id = null) {
	if(!is_acf())
		return false;

    return get_field($field, $object_id);
}

/**
 * Get site meta tags
 *
 * @param  mixed $url The url to get meta tags from
 * @return array      The meta tags
 */
function getSiteOG($url) {
    $doc = new \DOMDocument();
    @$doc->loadHTML(file_get_contents($url));
    $res['title'] = $doc->getElementsByTagName('title')->item(0)->nodeValue;

    foreach($doc->getElementsByTagName('meta') as $m):
        $tag = $m->getAttribute('name') ?: $m->getAttribute('property');

        if(in_array($tag, ['description', 'keywords']) || strpos($tag, 'og:') === 0)
            $res[str_replace('og:', '', $tag)] = $m->getAttribute('content');
    endforeach;

    return $res;
}
