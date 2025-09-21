<?php

namespace App\Filament\Clusters\Blog\Resources\Posts\Schemas;

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

                TextEntry::make('id')
                    ->formatStateUsing(fn ($record): View => view(
                        'filament.app.pages.assist.test',['record' => $record]
                    )),
                TextEntry::make('title')
                ->belowContent([
                        Text::make('إنها تجربة فريدة')
                            ->weight(FontWeight::ExtraBold)
                            ->fontFamily('Tajawal')

                            ->size(TextSize::Large)
                            ->color('success'),
                        Text::make('ورائعة')
                            ->weight(FontWeight::ExtraBold)
                            ->size(TextSize::Large)
                            ->color('primary'),
                        Image::make(url: asset('images/fazha/me.jpg'),
                        alt: 'any')

                ]

                )
                ->aboveContent(
                    Text::make('عنوان')
                        ->size(TextSize::Medium)),

                RichContentRenderer::make($record->body),
                ImageEntry::make('image'),
                TextEntry::make('published_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
