<?php

namespace App\Filament\Clusters\Aljabel\Resources\Places;

use App\Filament\Clusters\Aljabel\AljabelCluster;
use App\Filament\Clusters\Aljabel\Resources\Places\Pages\CreatePlace;
use App\Filament\Clusters\Aljabel\Resources\Places\Pages\EditPlace;
use App\Filament\Clusters\Aljabel\Resources\Places\Pages\ListPlaces;
use App\Filament\Clusters\Aljabel\Resources\Places\Pages\ViewPlace;
use App\Filament\Clusters\Aljabel\Resources\Places\Schemas\PlaceForm;
use App\Filament\Clusters\Aljabel\Resources\Places\Schemas\PlaceInfolist;
use App\Filament\Clusters\Aljabel\Resources\Places\Tables\PlacesTable;
use App\Models\Place;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PlaceResource extends Resource
{
    protected static ?string $model = Place::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = AljabelCluster::class;

    protected static ?string $navigationLabel='اماكن الوفاة';
    public static function form(Schema $schema): Schema
    {
        return PlaceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PlaceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PlacesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPlaces::route('/'),
            'create' => CreatePlace::route('/create'),
            'view' => ViewPlace::route('/{record}'),
            'edit' => EditPlace::route('/{record}/edit'),
        ];
    }
}
