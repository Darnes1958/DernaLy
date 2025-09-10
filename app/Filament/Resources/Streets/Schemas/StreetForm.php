<?php

namespace App\Filament\Resources\Streets\Schemas;

use App\Models\Area;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Image;
use Filament\Schemas\Schema;

class StreetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('StrName')
                    ->required(),
                Textarea::make('StrNameJs')
                    ->columnSpanFull(),
                Select::make('area_id')
                    ->relationship('Area','AreaName')
                    ->searchable()
                    ->preload()
                    ->required(),
                Toggle::make('building'),
                Select::make('road_id')
                    ->relationship('Road','name')
                    ->searchable()
                    ->required()
                    ->preload(),
                FileUpload::make('image')
                    ,
            ]);
    }
}
