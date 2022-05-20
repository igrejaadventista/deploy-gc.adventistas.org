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

add_filter('wp_headless_rest__rest_endpoints_to_remove', function($endpoints_to_remove) {
    $endpoints_to_remove = array(
        '/wp/v2/post',
        '/wp/v2/media',
        '/wp/v2/types',
        '/wp/v2/statuses',
        '/wp/v2/taxonomies',
        '/wp/v2/tags',
        '/wp/v2/users',
        '/wp/v2/comments',
        '/wp/v2/themes',
        '/wp/v2/blocks',
        '/wp/v2/block-renderer',
        '/oembed/',
        '/wp/v2/pages',
        '/wp/v2/menu-items',
        '/wp/v2/template-parts',
        '/wp/v2/navigation',
        '/wp/v2/menus',
        '/wp/v2/global-styles/',
        '/wp/v2/menu-locations',
        '/wp/v2/block-types',

        // CUSTOM
        '/wp/v2/categories',
        '/wp/v2/search',
        '/wp/v2/plugins',
        '/wp/v2/block-directory',
        '/wp/v2/settings',
        '/wp/v2/templates',
        '/wp/v2/pattern-directory/patterns',
        '/wp/v2/widgets',
        '/wp/v2/widget-types',
        '/wp/v2/sidebars'
    );

    return $endpoints_to_remove;
});

add_filter('wp_headless_rest__rest_object_remove_nodes', function($items_to_remove) {
    $items_to_remove = array(
        'guid',
        '_links',
        'ping_status'
    );

    return $items_to_remove;
});

// WP REST Headless
add_filter('wp_headless_rest__enable_rest_cleanup', '__return_true');
add_filter('wp_headless_rest__disable_front_end', '__return_false');

add_action('acf/save_post', function($post_id) {
    if(get_post_type($post_id) != 'timeline')
        return;

    $url = '';

    while(have_rows('content', $post_id)):
        the_row();

        if(get_row_layout() == 'site')
            $url = get_sub_field('url');
    endwhile;

    if(empty($url))
        return;

    $tags = getSiteOG($url);

    $meta = [
        'url'         => $url,
        'title'       => !empty($tags['title']) ? $tags['title'] : '',
        'description' => !empty($tags['description']) ? $tags['description'] : '',
        'image'       => !empty($tags['image']) ? $tags['image'] : ''
    ];

    update_sub_field(array('content', 1, 'title'), !empty($tags['title']) ? $tags['title'] : '');
    update_sub_field(array('content', 1, 'description'), !empty($tags['description']) ? $tags['description'] : '');
    update_sub_field(array('content', 1, 'image'), !empty($tags['image']) ? $tags['image'] : '');

    update_post_meta($post_id, 'url_meta_tags', $meta);
});
