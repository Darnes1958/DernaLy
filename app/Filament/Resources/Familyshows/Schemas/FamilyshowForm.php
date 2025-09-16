<?php

namespace App\Filament\Resources\Familyshows\Schemas;

use App\Models\BigFamily;
use App\Models\Tarkeba;
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
                    ->createOptionUsing(function (array $data): int {
                        return BigFamily::create($data)->getKey();
                    })
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label('اسم العائلة'),
                        Select::make('tarkeba_id')
                            ->searchable()
                            ->preload()
                            ->options(Tarkeba::all()->pluck('name','id'))

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
