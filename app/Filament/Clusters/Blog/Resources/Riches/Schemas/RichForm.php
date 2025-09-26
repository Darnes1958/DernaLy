<?php

namespace App\Filament\Clusters\Blog\Resources\Riches\Schemas;

use App\Models\Street;
use App\Models\Victim;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RichForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                MorphToSelect::make('richable')
                 ->types([
                     MorphToSelect\Type::make(Victim::class)
                      ->titleAttribute('FullName'),
                     MorphToSelect\Type::make(Street::class)
                      ->titleAttribute('StrName'),
                 ])
                ->searchable()
                ->preload()
            ]);
    }
}
