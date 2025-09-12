<?php

namespace App\Filament\Resources\Familyshows\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FamilyshowForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('nameJs')
                    ->columnSpanFull(),
                TextInput::make('bigfamily_id')
                    ->numeric(),
                TextInput::make('nation'),
                TextInput::make('country_id')
                    ->numeric(),
                TextInput::make('who'),
            ]);
    }
}
