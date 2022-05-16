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
            'isOn' => true,
            'ID' => 'IHEbht3ZcPQ',
            'title' => 'Ao vivo | Abertura da GC &#178;&#8304;&#178;&#178;',
        ];
    }

}
