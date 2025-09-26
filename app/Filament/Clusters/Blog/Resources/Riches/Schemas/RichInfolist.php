<?php

namespace App\Filament\Clusters\Blog\Resources\Riches\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RichInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('richable_type'),
                TextEntry::make('richable_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
