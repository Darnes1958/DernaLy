<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\TextInput;

class LongAndImage extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'long_and_image';
    }

    public static function getLabel(): string
    {
        return 'Long and image';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Configure the long and image')
            ->schema([
                RichEditor::make('theText')
                    ->required()
                    ->fileAttachmentsDirectory('blogs')
                    ->fileAttachmentsVisibility('private')
                    ->extraAttributes([
                        // Alpine: dispatch a custom event when clicked
                        'x-data' => '{}',
                        'x-on:click' => '$dispatch("rich-click", $event)',
                    ])
                    ->customBlocks([
                        HeroBlock::class,
                        MarwaBlock::class,
                        OneImage::class,
                    ])
                    ->mergeTags([
                        'subTitle',
                    ]),

                FileUpload::make('theImage')
                    ->required()
                    ->image()
                    ->directory('blogs'),
                TextInput::make('theLabel'),
                TextInput::make('w1'),
                TextInput::make('w2'),
                TextInput::make('imgHeight'),
                TextInput::make('imgWidth')->default('auto'),

            ]);
    }

    public static function toPreviewHtml(array $config): string
    {

        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.long-and-image.preview', [
            'theText' => $config['theText'],
            'theImage' => $config['theImage'],
            'theLabel' => $config['theLabel'],
            'w1' => $config['w1'],
            'w2' => $config['w2'],
            'imgHeight' => $config['imgHeight'],
            'imgWidth' => $config['imgWidth'],
        ])->render();
    }

    public static function toHtml(array $config, array $data): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.long-and-image.index', [
            'theText' => $config['theText'],
            'theImage' => $config['theImage'],
            'theLabel' => $config['theLabel'],
            'w1' => $config['w1'],
            'w2' => $config['w2'],
            'imgHeight' => $config['imgHeight'],
            'imgWidth' => $config['imgWidth'],
        ])->render();
    }
}
