<?php

namespace App\Filament\Clusters\Blog\Resources\Posts\Schemas;

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock;
use App\Models\Post;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Image;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Google\Cloud\Translate\V3\Model;
use Illuminate\Contracts\View\View;

class PostInfolist
{

    public static function configure(Schema $schema): Schema
    {

        return $schema

            ->components(fn($record) =>[

                TextEntry::make('body')
                    ->state(fn ($record): string => RichContentRenderer::make($record->body)

                        ->fileAttachmentsVisibility('private')

                        ->customBlocks([
                        HeroBlock::class],
                     )
                     ->toHtml()
                    )
                    ->prose(),

            //    TextEntry::make('body')
            //        ->columnSpanFull()
            //        ->html()
            //        ->extraAttributes(['class' => 'fi-prose fi-prose-invert'])
            //        ->state(fn ($record): string => RichContentRenderer::make($record->body)
            //            ->customBlocks([
            //                HeroBlock::class],
            //            )
            //            ->toHtml()),

            ]);
    }
}
