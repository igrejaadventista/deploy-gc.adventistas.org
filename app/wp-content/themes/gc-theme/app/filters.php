<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

add_filter('nav_menu_css_class', function($classes, $item, $args) {
    if(property_exists($args, 'item_classes'))
        $classes[] = $args->item_classes;
    if(!empty($index = array_search('current-menu-item', $classes)))
        $classes[$index] = '!text-primary';

    return $classes;
}, 1, 3);


add_filter( 'nav_menu_link_attributes', function($atts, $item, $args) {
    if(property_exists($args, 'link_classes'))
      $atts['class'] = $args->link_classes;

    return $atts;
}, 1, 3 );
