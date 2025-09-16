<?php

namespace App\Filament\Clusters\Aljabel\Resources\Places\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PlaceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('city_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
