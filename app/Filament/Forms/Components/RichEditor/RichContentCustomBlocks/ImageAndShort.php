<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\TextInput;

class ImageAndShort extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'image_and_short';
    }

    public static function getLabel(): string
    {
        return 'Image and short';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Configure the image and short')
            ->schema([
                FileUpload::make('theImage')
                    ->required()
                    ->image()
                    ->directory('blogs'),
                TextInput::make('theLabel'),
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
                TextInput::make('w1'),
                TextInput::make('w2'),
                TextInput::make('imgHeight'),
                TextInput::make('imgWidth')->default('auto'),

            ]);
    }

    public static function toPreviewHtml(array $config): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.image-and-short.preview', [
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
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.image-and-short.index', [
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
