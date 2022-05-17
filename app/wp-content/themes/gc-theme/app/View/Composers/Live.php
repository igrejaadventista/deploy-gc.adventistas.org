<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

use function App\gf;

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
        $live = gf('live');

        return [
            'isOn'  => !is_front_page() && get_page_template_slug() !== 'timeline.blade.php' ? false : (is_array($live) && array_key_exists('enabled', $live) && $live['enabled']),
            'ID'    => is_array($live) && array_key_exists('videoID', $live) ? $live['videoID'] : '',
            'title' => is_array($live) && array_key_exists('title', $live) ? $live['title'] : '',
        ];
    }

}
