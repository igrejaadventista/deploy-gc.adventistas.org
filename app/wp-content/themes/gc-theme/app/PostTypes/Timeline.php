<?

namespace App\PostTypes;

/**
 * Timeline Register timeline fields
 */
class Timeline {

    public function __construct() {
        register_post_type('timeline', $this->setArgs());
    }

    function setLabels(): array {
        return [
            'name'               => _x('Timeline', 'Post Type General Name', constant('TEXTDOMAIN')),
            'singular_name'      => _x('Timeline', 'Post Type Singular Name', constant('TEXTDOMAIN')),
            'menu_name'          => __('Timeline', constant('TEXTDOMAIN')),
            'name_admin_bar'     => __('Timeline', constant('TEXTDOMAIN')),
            'archives'           => __('Timeline Archives', constant('TEXTDOMAIN')),
            'attributes'         => __('Timeline Attributes', constant('TEXTDOMAIN')),
            'parent_item_colon'  => __('Parent Item:', constant('TEXTDOMAIN')),
            'all_items'          => __('All Itens', constant('TEXTDOMAIN')),
            'add_new_item'       => __('Add New', constant('TEXTDOMAIN')),
            'add_new'            => __('Add New', constant('TEXTDOMAIN')),
            'new_item'           => __('New', constant('TEXTDOMAIN')),
            'edit_item'          => __('Edit', constant('TEXTDOMAIN')),
            'update_item'        => __('Update', constant('TEXTDOMAIN')),
            'view_item'          => __('View', constant('TEXTDOMAIN')),
            'view_items'         => __('View', constant('TEXTDOMAIN')),
            'search_items'       => __('Search', constant('TEXTDOMAIN')),
            'not_found'          => __('Not found', constant('TEXTDOMAIN')),
            'not_found_in_trash' => __('Not found in Trash', constant('TEXTDOMAIN')),
        ];
    }

    function setArgs(): array {
        return [
            'label'               => __('Item', constant('TEXTDOMAIN')),
            'menu_icon'           => 'dashicons-excerpt-view',
            'labels'              => $this->setLabels(),
            'supports'            => array('title'),
            'taxonomies'          => array('category'),
            'hierarchical'        => false,
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => true,
            'rewrite'             => false,
            'capability_type'     => 'page',
            'show_in_rest'        => true,
        ];
    }

}
