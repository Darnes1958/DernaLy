<?php

namespace App\Filament\Clusters\Translations\Resources\Areas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AreaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('AreaName'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
