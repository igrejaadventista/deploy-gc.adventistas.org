<?php

/**
 * Theme helpers.
 */

namespace App;

function translateImage($path) {
    if(empty($path))
        return '';

    $locale = get_locale();
    $language = $locale != 'pt_BR' ? $locale . '/' : '';

    return \Roots\asset('images/' . $language . $path);
}
