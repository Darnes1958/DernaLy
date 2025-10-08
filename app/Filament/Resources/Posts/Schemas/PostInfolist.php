<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\LongAndImage;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\MarwaBlock;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\OneImage;
use App\Plugins\YoutubeRichContentPlugin;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

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
                            HeroBlock::class,
                            MarwaBlock::class,
                            OneImage::class,
                            LongAndImage::class,
                        ])

                        ->toHtml()
                    )
                    ->columnSpanFull()
                    ->prose()


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
