<?php

namespace App\Filament\Clusters\Blog\Resources\Riches;

use App\Filament\Clusters\Blog\BlogCluster;
use App\Filament\Clusters\Blog\Resources\Riches\Pages\CreateRich;
use App\Filament\Clusters\Blog\Resources\Riches\Pages\EditRich;
use App\Filament\Clusters\Blog\Resources\Riches\Pages\ListRiches;
use App\Filament\Clusters\Blog\Resources\Riches\Pages\ViewRich;
use App\Filament\Clusters\Blog\Resources\Riches\Schemas\RichForm;
use App\Filament\Clusters\Blog\Resources\Riches\Schemas\RichInfolist;
use App\Filament\Clusters\Blog\Resources\Riches\Tables\RichesTable;
use App\Models\Rich;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RichResource extends Resource
{
    protected static ?string $model = Rich::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = BlogCluster::class;

    public static function form(Schema $schema): Schema
    {
        return RichForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RichInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RichesTable::configure($table);
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
            'index' => ListRiches::route('/'),
            'create' => CreateRich::route('/create'),
            'view' => ViewRich::route('/{record}'),
            'edit' => EditRich::route('/{record}/edit'),
        ];
    }
}
