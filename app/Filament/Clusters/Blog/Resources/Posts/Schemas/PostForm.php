<?php

namespace App\Filament\Clusters\Blog\Resources\Posts\Schemas;

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\MarwaBlock;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\OneImage;
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
                        'title',
                    ])


                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ,
                DateTimePicker::make('published_at')
                    ,
            ]);
    }
}
