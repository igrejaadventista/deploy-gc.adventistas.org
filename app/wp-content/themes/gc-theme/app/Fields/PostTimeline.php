<?

namespace App\Fields;

use WordPlate\Acf\Fields\FlexibleContent;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Layout;
use WordPlate\Acf\Fields\Oembed;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Url;
use WordPlate\Acf\Location;

/**
 * PostTimeline Register timeline post fields
 */
class PostTimeline {

    public function __construct() {
        register_extended_field_group([
            'key'          => 'timeline_content',
            'title'        => 'Conteúdo',
            'fields'       => $this->setFields(),
            'show_in_rest' => true,
            'location'     => [
                Location::if('post_type', 'timeline')
            ],
        ]);
    }

    /**
     * setFields Set the fields for the group
     *
     * @return array
     */
    function setFields(): array {
        return [
            FlexibleContent::make(__('Conteúdo', constant('TEXTDOMAIN')), 'content')
                ->required()
                ->max(1)
                ->buttonLabel(__('Adicionar conteúdo', constant('TEXTDOMAIN')))
                ->layouts([
                    Layout::make(__('Embed', constant('TEXTDOMAIN')), 'embed')
                        ->layout('block')
                        ->fields([
                            Oembed::make(__('URL', constant('TEXTDOMAIN')), 'url')
                                ->required(),
                            Textarea::make(__('Descrição', constant('TEXTDOMAIN')), 'description'),
                        ]),

                    Layout::make(__('Site', constant('TEXTDOMAIN')), 'site')
                        ->layout('block')
                        ->fields([
                            Url::make(__('URL', constant('TEXTDOMAIN')), 'url')
                                ->required(),
                            Text::make(__('Imagem', constant('TEXTDOMAIN')), 'image')
                                ->readonly(),
                            Text::make(__('Título', constant('TEXTDOMAIN')), 'title')
                                ->readonly(),
                            Textarea::make(__('Descrição', constant('TEXTDOMAIN')), 'description')
                                ->readonly(),
                        ]),

                    Layout::make(__('Manual', constant('TEXTDOMAIN')), 'manual')
                        ->layout('block')
                        ->fields([
                            Url::make(__('URL', constant('TEXTDOMAIN')), 'url')
                                ->required(),
                            Image::make(__('Imagem', constant('TEXTDOMAIN')), 'image'),
                            Text::make(__('Título', constant('TEXTDOMAIN')), 'title')
                                ->required(),
                            Textarea::make(__('Descrição', constant('TEXTDOMAIN')), 'description')
                                ->required(),
                        ]),
                ])
        ];
    }

}
