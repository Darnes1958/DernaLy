<?php

namespace App\Filament\Resources\Streets\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StreetInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('StrName'),
                TextEntry::make('area_id')
                    ->numeric(),
                IconEntry::make('building')
                    ->boolean(),
                TextEntry::make('road_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
