<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\TextInput;

class MarwaBlock extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'marwa';
    }

    public static function getLabel(): string
    {
        return 'Marwa';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Configure the marwa block')
            ->schema([
                FileUpload::make('image')
                    ->image()
                    ->directory('blogs'),
                FileUpload::make('image2')
                    ->image()
                    ->directory('blogs'),
                TextInput::make('name'),
                TextInput::make('link'),
                FileUpload::make('image3')
                    ->image()
                    ->directory('blogs'),
            ]);
    }

    public static function toPreviewHtml(array $config): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.marwa.preview', [
            'image' => $config['image'],
            'image2' => $config['image2'],
            'name' => $config['name'],
            'link' => $config['link'],
            'image3' => $config['image3'],

        ])->render();
    }

    public static function toHtml(array $config, array $data): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.marwa.index', [
            'image' => $config['image'],
            'image2' => $config['image2'],
            'name' => $config['name'],
            'link' => $config['link'],
            'image3' => $config['image3'],

        ])->render();
    }
}
