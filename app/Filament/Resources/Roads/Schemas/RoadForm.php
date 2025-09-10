<?php

namespace App\Filament\Resources\Roads\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RoadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('east_west'),
                Textarea::make('nameJs')
                    ->columnSpanFull(),
            ]);
    }
}
