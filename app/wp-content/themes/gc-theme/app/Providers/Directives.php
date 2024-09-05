<?

namespace App\Providers;

use Illuminate\Support\Facades\Blade;

class Directives {

    public function __construct() {
        add_action('after_setup_theme', [$this, 'translate']);
    }

    function translate() {
        Blade::directive('translate', function($expression) {
            return "<?php _e({$expression}, 'gc'); ?>";
        });
    }

}
