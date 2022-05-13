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
}, 1, 3);

add_filter('render_block', function($block_content, $block) {
    $start = array_key_exists('className', $block['attrs']) ? ' class="' : '';
    $end = array_key_exists('className', $block['attrs']) ? ' ' : '"';

    switch($block['blockName']):
        case 'core/paragraph':
            $block_content = str_replace('<p' . $start, '<p class="mb-4 md:mb-8 text-grey' . $end, $block_content);
            break;
        case 'core/heading':
            $block_content = str_replace('<h1' . $start, '<h1 class="font-bold text-secondary text-2xl mb-6 mt-2 md:mt-0' . $end, $block_content);
            $block_content = str_replace('<h2' . $start, '<h2 class="font-bold text-secondary text-2xl mb-6 mt-2 md:mt-0' . $end, $block_content);
            $block_content = str_replace('<h3' . $start, '<h3 class="font-bold text-secondary text-xl mb-6 mt-2 md:mt-0' . $end, $block_content);
            $block_content = str_replace('<h4' . $start, '<h4 class="font-bold text-secondary text-xl mb-6 mt-2 md:mt-0' . $end, $block_content);
            $block_content = str_replace('<h5' . $start, '<h5 class="font-bold text-secondary text-lg mb-6 mt-2 md:mt-0' . $end, $block_content);
            $block_content = str_replace('<h6' . $start, '<h6 class="font-bold text-secondary text-lg mb-6 mt-2 md:mt-0' . $end, $block_content);
            break;
        case 'core/embed':
            $block_content = str_replace('<figure' . $start, '<figure class="rounded-lg overflow-hidden mb-6 md:mb-10' . $end, $block_content);
            break;
    endswitch;

    return $block_content;
}, 10, 2);
