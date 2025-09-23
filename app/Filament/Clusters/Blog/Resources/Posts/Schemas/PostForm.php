<?php

namespace App\Filament\Clusters\Blog\Resources\Posts\Schemas;

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                RichEditor::make('body')
                    ->required()
                    ->mergeTags([
                        'name',
                        'today'
                    ])
                    ->customBlocks([
                        HeroBlock::class,
                    ])

                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->required(),
                DateTimePicker::make('published_at')
                    ->required(),
            ]);
    }
}
