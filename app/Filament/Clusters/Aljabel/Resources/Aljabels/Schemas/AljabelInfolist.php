<?php

namespace App\Filament\Clusters\Aljabel\Resources\Aljabels\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AljabelInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('family_id')
                    ->numeric(),
                TextEntry::make('street_id')
                    ->numeric(),
                IconEntry::make('sex')
                    ->boolean(),
                TextEntry::make('year')
                    ->numeric(),
                TextEntry::make('husband_id')
                    ->numeric(),
                TextEntry::make('wife_id')
                    ->numeric(),
                TextEntry::make('mother_id')
                    ->numeric(),
                TextEntry::make('father_id')
                    ->numeric(),
                TextEntry::make('grandfather_id')
                    ->numeric(),
                TextEntry::make('grandmother_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('masterKey')
                    ->numeric(),
            ]);
    }
}
