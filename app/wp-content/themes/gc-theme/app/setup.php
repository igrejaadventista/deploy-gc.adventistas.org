<?php

/**
 * Theme setup.
 */

namespace App;

 use App\Fields\PostTimeline;
use App\Fields\TemplateTimeline;
use App\PostTypes\Timeline;

use function Roots\bundle;

define('TEXTDOMAIN', 'gc');

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('youtube-iframe_api', 'https://www.youtube.com/iframe_api', [], null, true);
    wp_enqueue_style('noto-sans', 'https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap');

    bundle('app')->enqueue();

    if(!is_front_page())
        return;

    // Remove Gutenberg Block Library CSS from loading on the home frontend
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls'
    ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Disable the default block patterns.
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style'
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    load_theme_textdomain(constant('TEXTDOMAIN'), get_theme_file_path('/resources/languages'));

    add_theme_support('custom-logo', [
        'height'      => 64,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
}, 20);

add_action('init', function() {
    if (class_exists('App\PostTypes\Timeline')) {
        new Timeline;
    } else {
        error_log('Class Timeline not found!');
    }
});

add_action('acf/init', function() {
    if (class_exists('App\Fields\PostTimeline') && class_exists('App\Fields\TemplateTimeline')) {
        new PostTimeline;
        new TemplateTimeline;
    } else {
        error_log('Classes PostTimeline or TemplateTimeline not found!');
    }
});

