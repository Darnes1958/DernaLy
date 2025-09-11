<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                 ->schema([
                     Textarea::make('message')
                         ->rows(3)
                         ->required(),
                     TextInput::make('tel')
                         ->suffixIcon(Heroicon::Phone)
                         ->tel(),
                 ])->columns(1)


            ])->columns(2);
    }
}
