<?php

namespace App\Filament\Clusters\Aljabel\Resources\Places\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PlaceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('city_id')
                    ->relationship('City','name')
                    ->label('المدينة')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->label('اسم المدينة')
                        ,
                        FileUpload::make('image')
                            ->multiple()
                            ->imageEditor()
                            ->directory('form-cities'),
                    ])
                    ->editOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->label('اسم المدينة')
                            ->maxLength(255),
                        FileUpload::make('image')
                            ->multiple()
                            ->imageEditor()
                            ->directory('form-cities'),

                    ])
                    ->required(),
                FileUpload::make('image')
                    ->multiple()
                    ->imageEditor()
                    ->directory('form-places'),
            ]);
    }
}
