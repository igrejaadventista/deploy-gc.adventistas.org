<?php

namespace App\Fields;

use Extended\ACF\ConditionalLogic;
use Extended\ACF\Fields\Group;
use Extended\ACF\Fields\Number;
use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\Textarea;
use Extended\ACF\Fields\TrueFalse;
use Extended\ACF\Location;
use Extended\ACF\Fields\DatePicker;

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
                Location::where('post_template', 'timeline.blade.php')
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
            DatePicker::make(__('Ano', constant('TEXTDOMAIN')), 'year')
                ->required()
                ->format('Y'),
            Group::make(__('Ao vivo', constant('TEXTDOMAIN')), 'live')
                ->fields([
                    TrueFalse::make(__('Ativo', constant('TEXTDOMAIN')), 'enabled')
                        ->default(false)
                        ->stylized(on: 'Yes'), // optional on and off text labels
                    Text::make(__('Título', constant('TEXTDOMAIN')), 'title')
                        ->required()
                        ->default(__('Ao vivo', constant('TEXTDOMAIN')))
                        ->conditionalLogic([
                            ConditionalLogic::where('enabled', '==', 1)
                        ]),
                    Text::make(__('ID do vídeo', constant('TEXTDOMAIN')), 'videoID')
                        ->required()
                        ->conditionalLogic([
                            ConditionalLogic::where('enabled', '==', 1)
                        ]),
                    Textarea::make(__('Descrição', constant('TEXTDOMAIN')), 'description')
                        ->conditionalLogic([
                            ConditionalLogic::where('enabled', '==', 1)
                        ]),
                ])
        ];
    }

}
