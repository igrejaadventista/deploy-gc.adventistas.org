<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class Share extends Component {

    /**
     * The facebook share url
     *
     * @var string
     */
    public $urlFacebook;
    /**
     * The twitter share url
     *
     * @var string
     */
    public $urlTwitter;
    /**
     * The whatsapp share url
     *
     * @var string
     */
    public $urlWhatsapp;

    /**
     * Create the component instance
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct() {
        $source = 'iasd';
        $site   = get_bloginfo('name');
        $url    = urlencode(get_permalink());
        $title  = urlencode(get_the_title());
        $text   = urlencode(wp_html_excerpt(get_the_excerpt(), (247 - strlen($source)), '...'));

        $this->urlFacebook = "https://www.facebook.com/sharer/sharer.php?u={$url}&display=popup&ref=plugin&ref=plugin&kid_directed_site=0";
        $this->urlTwitter  = "https://twitter.com/intent/tweet?text={$text}&via={$source}&url={$url}";
        $this->urlWhatsapp = "https://api.whatsapp.com/send?text={$title}%20-%20{$site}%20-%20{$url}";
    }

    /**
     * Get the view / contents that represent the component
     *
     * @return \Illuminate\View\View|string
     */
    public function render() {
        return $this->view('components.share');
    }

}
