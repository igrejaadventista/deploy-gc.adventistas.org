<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Live extends Composer {

    /**
     * List of views served by this composer
     *
     * @var array
     */
    protected static $views = [
        'partials.page-header',
    ];

    /**
     * Data to be passed to view before rendering
     *
     * @return array
     */
    public function override() {
        return [
            'isOn' => !is_front_page() && get_page_template_slug() !== 'template-timeline.blade.php' ? false : true,
            'ID' => 'IHEbht3ZcPQ',
            'title' => 'Ao vivo | Abertura da GC &#178;&#8304;&#178;&#178;',
        ];
    }

}
