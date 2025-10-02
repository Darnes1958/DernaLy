<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock;
use App\Filament\Resources\Posts\PostResource;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Schema;

class NewPost extends Page implements HasForms
{
    use InteractsWithForms;
    protected static string $resource = PostResource::class;

    protected string $view = 'filament.clusters.blog.resources.posts.pages.new-post';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->model(Post::class)

            ->components([
                TextInput::make('title')
                    ->required(),
                RichEditor::make('body')
                    ->required()
                    ->fileAttachmentsDirectory('fazha')
                    ->fileAttachmentsVisibility('private')
                    ->extraAttributes([
                        // Alpine: dispatch a custom event when clicked
                        'x-data' => '{}',
                        'x-on:click' => '$dispatch("rich-click", $event)',
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

                Action::make('store')
                ->action(function () use ($schema) {

                })

            ]);

    }
}
