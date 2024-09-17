<?php

namespace App\Fields;

use Extended\ACF\Fields\FlexibleContent;
use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Layout;
use Extended\ACF\Fields\Oembed;
use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\Textarea;
use Extended\ACF\Fields\URL;
use Extended\ACF\Fields\WYSIWYGEditor;
use Extended\ACF\Location;
use Extended\ACF\Fields\Select;

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
                Location::where('post_type', 'timeline')
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
                ->maxLayouts(1)
                ->button(__('Adicionar conteúdo', constant('TEXTDOMAIN')))
                ->layouts([
                    Layout::make(__('Embed', constant('TEXTDOMAIN')), 'embed')
                        ->layout('block')
                        ->fields([
                            Oembed::make(__('URL', constant('TEXTDOMAIN')), 'url')
                                ->required()
                                ->width(668)
                                ->height(375),
                            WYSIWYGEditor::make(__('Descrição', constant('TEXTDOMAIN')), 'description')
                                ->disableMediaUpload(),
                            Text::make(__('Autor', constant('TEXTDOMAIN')), 'author'),
                            Select::make(__('Tipo', constant('TEXTDOMAIN')), 'type')
                                ->choices(['default' => 'Padrão', 'audio' => 'Áudio'])
                                ->default('default')
                                ->format('value')
                                ->stylized()
                                ->lazyLoad(),
                        ]),

                    Layout::make(__('Site', constant('TEXTDOMAIN')), 'site')
                        ->layout('block')
                        ->fields([
                            URL::make(__('URL', constant('TEXTDOMAIN')), 'url')
                                ->required(),
                            Text::make(__('Imagem', constant('TEXTDOMAIN')), 'image')
                                ->readonly(),
                            Text::make(__('Título', constant('TEXTDOMAIN')), 'title')
                                ->readonly(),
                            Textarea::make(__('Descrição', constant('TEXTDOMAIN')), 'description')
                                ->readonly(),
                            Text::make(__('Autor', constant('TEXTDOMAIN')), 'author'),
                            Select::make(__('Tipo', constant('TEXTDOMAIN')), 'type')
                                ->choices(['default' => 'Padrão', 'audio' => 'Áudio'])
                                ->default('default')
                                ->format('value')
                                ->stylized()
                                ->lazyLoad(),
                        ]),

                    Layout::make(__('Manual', constant('TEXTDOMAIN')), 'manual')
                        ->layout('block')
                        ->fields([
                            URL::make(__('URL', constant('TEXTDOMAIN')), 'url')
                                ->required(),
                            Image::make(__('Imagem', constant('TEXTDOMAIN')), 'image')
                            ->format('url'),
                            WYSIWYGEditor::make(__('Descrição', constant('TEXTDOMAIN')), 'description')
                                ->required()
                                ->disableMediaUpload(),
                            Text::make(__('Autor', constant('TEXTDOMAIN')), 'author'),
                            Select::make(__('Tipo', constant('TEXTDOMAIN')), 'type')
                                ->choices(['default' => 'Padrão', 'audio' => 'Áudio'])
                                ->default('default')
                                ->format('value')
                                ->stylized()
                                ->lazyLoad(),
                        ]),

                    Layout::make(__('HTML', constant('TEXTDOMAIN')), 'html')
                        ->layout('block')
                        ->fields([
                            Textarea::make(__('Código HTML', constant('TEXTDOMAIN')), 'html'),
                            WYSIWYGEditor::make(__('Descrição', constant('TEXTDOMAIN')), 'description')
                            ->disableMediaUpload(),
                            Text::make(__('Autor', constant('TEXTDOMAIN')), 'author'),
                            Select::make(__('Tipo', constant('TEXTDOMAIN')), 'type')
                                ->choices(['default' => 'Padrão', 'audio' => 'Áudio'])
                                ->default('default')
                                ->format('value')
                                ->stylized()
                                ->lazyLoad(),
                        ]),
                ])
        ];
    }

}
