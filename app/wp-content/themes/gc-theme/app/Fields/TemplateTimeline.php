<?

namespace App\Fields;

use WordPlate\Acf\ConditionalLogic;
use WordPlate\Acf\Fields\Group;
use WordPlate\Acf\Fields\Number;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\TrueFalse;
use WordPlate\Acf\Location;

/**
 * TemplateTimeline Register timeline template fields
 */
class TemplateTimeline {

    public function __construct() {
        register_extended_field_group([
            'key' => 'timeline_settings',
            'title' => 'Configurações',
            'fields' => $this->setFields(),
            'position' => 'side',
            'show_in_rest' => true,
            'location' => [
                Location::if('post_template', 'timeline.blade.php')
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
            Number::make(__('Ano', constant('TEXTDOMAIN')), 'year')
                ->required(true)
                ->min(1900)
                ->defaultValue(date('Y')),
            Group::make(__('Ao vivo', constant('TEXTDOMAIN')), 'live')
                ->fields([
                    TrueFalse::make(__('Ativo', constant('TEXTDOMAIN')), 'enabled')
                        ->defaultValue(false)
                        ->stylisedUi(),
                    Text::make(__('Título', constant('TEXTDOMAIN')), 'title')
                        ->required()
                        ->defaultValue(__('Ao vivo', constant('TEXTDOMAIN')))
                        ->conditionalLogic([
                            ConditionalLogic::if('enabled')->equals(1)
                        ]),
                    Text::make(__('ID do vídeo', constant('TEXTDOMAIN')), 'videoID')
                        ->required()
                        ->conditionalLogic([
                            ConditionalLogic::if('enabled')->equals(1)
                        ]),
                ])
        ];
    }

}
