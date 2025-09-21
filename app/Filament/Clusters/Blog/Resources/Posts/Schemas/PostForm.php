<?php

namespace App\Filament\Clusters\Blog\Resources\Posts\Schemas;

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
                    ->beforeContent(Text::make('إنها رائعة')->size(TextSize::Large))
                    ->required(),
                RichEditor::make('body')
                    ->required()
                    ->floatingToolbars([
                        'paragraph' => [
                            'bold', 'italic', 'underline', 'strike', 'subscript', 'superscript',
                        ],
                        'heading' => [
                            'h1', 'h2', 'h3',
                        ],
                        'table' => [
                            'tableAddColumnBefore', 'tableAddColumnAfter', 'tableDeleteColumn',
                            'tableAddRowBefore', 'tableAddRowAfter', 'tableDeleteRow',
                            'tableMergeCells', 'tableSplitCell',
                            'tableToggleHeaderRow',
                            'tableDelete',
                        ],
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
