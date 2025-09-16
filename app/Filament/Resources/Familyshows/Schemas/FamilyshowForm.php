<?php

namespace App\Filament\Resources\Familyshows\Schemas;

use App\Models\BigFamily;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
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

                Select::make('bigfamily_id')
                    ->searchable()
                    ->required()
                    ->options(BigFamily::all()->pluck('name','id'))
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label('اسم العائلة'),
                        Select::make('tarkeba_id')
                            ->searchable()
                            ->preload()
                            ->relationship('Tarkeba','name')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->label('اسم التركيبة الاجتماعية')
                                    ->maxLength(255)
                                    ->required(),
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->label('اسم التركيبة الاجتماعية ')
                                    ->maxLength(255)
                                    ->required(),
                            ])
                            ->label('التركيبة الاجتماعية'),
                    ])
                    ->label('القبيلة'),

                Hidden::make('nation')->default('ليبيا'),
                Hidden::make('country_id')
                    ->default(1)

            ]);
    }
}
