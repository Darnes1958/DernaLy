<?php

namespace App\Filament\App\Resources\Contacts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('message')
                    ->required(),
                TextInput::make('tel')
                    ->tel(),
                TextInput::make('status')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
