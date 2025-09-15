<?php

namespace App\Filament\Clusters\Translations\Resources\Areas\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AreaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('AreaName')
                    ->required(),
                Textarea::make('AreaNameJs')
                    ->columnSpanFull(),
            ]);
    }
}
