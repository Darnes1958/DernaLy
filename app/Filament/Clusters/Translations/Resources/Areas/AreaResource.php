<?php

namespace App\Filament\Clusters\Translations\Resources\Areas;

use App\Filament\Clusters\Translations\Resources\Areas\Pages\CreateArea;
use App\Filament\Clusters\Translations\Resources\Areas\Pages\EditArea;
use App\Filament\Clusters\Translations\Resources\Areas\Pages\ListAreas;
use App\Filament\Clusters\Translations\Resources\Areas\Pages\ViewArea;
use App\Filament\Clusters\Translations\Resources\Areas\Schemas\AreaForm;
use App\Filament\Clusters\Translations\Resources\Areas\Schemas\AreaInfolist;
use App\Filament\Clusters\Translations\Resources\Areas\Tables\AreasTable;
use App\Filament\Clusters\Translations\TranslationsCluster;
use App\Models\Area;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AreaResource extends Resource
{
    protected static ?string $model = Area::class;
    protected static ?string $cluster=TranslationsCluster::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return AreaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AreaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AreasTable::configure($table);
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
            'index' => ListAreas::route('/'),
            'create' => CreateArea::route('/create'),
            'view' => ViewArea::route('/{record}'),
            'edit' => EditArea::route('/{record}/edit'),
        ];
    }
}
