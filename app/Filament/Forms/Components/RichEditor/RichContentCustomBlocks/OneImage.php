<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\TextInput;

class OneImage extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'one_image';
    }

    public static function getLabel(): string
    {
        return 'One image';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Configure the one image')
            ->schema([
                FileUpload::make('image')
                    ->required()
                    ->image()
                    ->directory('blogs'),
                TextInput::make('ImageWidth')
                    ->required()
                 ->default('300'),
                TextInput::make('ImageHeight')
                    ->required()
                ->default('auto'),
            ]);
    }

    public static function toPreviewHtml(array $config): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.one-image.preview', [
            'image' => $config['image'],
            'ImageWidth' => $config['ImageWidth'],
            'ImageHeight' => $config['ImageHeight'],
        ])->render();
    }

    public static function toHtml(array $config, array $data): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.one-image.index', [
            'image' => $config['image'],
            'ImageWidth' => $config['ImageWidth'],
            'ImageHeight' => $config['ImageHeight'],

        ])->render();
    }
}
