<?php

namespace App\Filament\Clusters\Translations\Resources\Roads;

use App\Filament\Clusters\Translations\Resources\Roads\Pages\CreateRoad;
use App\Filament\Clusters\Translations\Resources\Roads\Pages\EditRoad;
use App\Filament\Clusters\Translations\Resources\Roads\Pages\ListRoads;
use App\Filament\Clusters\Translations\Resources\Roads\Schemas\RoadForm;
use App\Filament\Clusters\Translations\Resources\Roads\Tables\RoadsTable;
use App\Filament\Clusters\Translations\TranslationsCluster;
use App\Models\Road;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RoadResource extends Resource
{
    protected static ?string $model = Road::class;
    protected static ?string $cluster=TranslationsCluster::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return RoadForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RoadsTable::configure($table);
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
            'index' => ListRoads::route('/'),
            'create' => CreateRoad::route('/create'),
            'edit' => EditRoad::route('/{record}/edit'),
        ];
    }
}
