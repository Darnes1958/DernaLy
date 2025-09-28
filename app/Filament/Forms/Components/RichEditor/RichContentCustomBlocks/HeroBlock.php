<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class HeroBlock extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'hero';
    }

    public static function getLabel(): string
    {
        return 'Hero';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Configure the hero block')
            ->schema([
                TextInput::make('url')
                    ->label('YouTube URL')
                    ->placeholder('e.g. https://www.youtube.com/watch?v=dQw4w9WgXcQ')
                    ->required()
                    ->url()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, Get $get) {
                        // Extract and store just the video ID
                        $url = $get('url');
                        $videoId = Str::of($url)->after('v=')->before('&');
                        $set('videoId', $videoId);
                    }),
                TextInput::make('videoId')
                    ->label('Video ID')

                    ,

            ]);
    }

    public static function toPreviewHtml(array $config): string
    {
        $videoId = $config['videoId'];

        return <<<HTML
            <div class="video-container">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/{$videoId}"
                    frameborder="0" allowfullscreen>
                </iframe>
            </div>
        HTML;
    }

    public static function toHtml(array $config, array $data): string
    {

        $videoId = $config['videoId'];

        return <<<HTML
            <div class="video-container">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/{$videoId}"
                    frameborder="0" allowfullscreen>
                </iframe>
            </div>
        HTML;    }
}
