<?php

namespace App\Filament\Clusters\Aljabel\Resources\Aljabels;

use App\Filament\Clusters\Aljabel\AljabelCluster;
use App\Filament\Clusters\Aljabel\Resources\Aljabels\Pages\CreateAljabel;
use App\Filament\Clusters\Aljabel\Resources\Aljabels\Pages\EditAljabel;
use App\Filament\Clusters\Aljabel\Resources\Aljabels\Pages\ListAljabels;
use App\Filament\Clusters\Aljabel\Resources\Aljabels\Pages\ViewAljabel;
use App\Filament\Clusters\Aljabel\Resources\Aljabels\Schemas\AljabelForm;
use App\Filament\Clusters\Aljabel\Resources\Aljabels\Schemas\AljabelInfolist;
use App\Filament\Clusters\Aljabel\Resources\Aljabels\Tables\AljabelsTable;
use App\Models\Aljabel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AljabelResource extends Resource
{
    protected static ?string $model = Aljabel::class;
    protected static ?string $cluster= AljabelCluster::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel='ادخال بيانات الضحايا';

    public static function form(Schema $schema): Schema

    {
        return AljabelForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AljabelInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AljabelsTable::configure($table);
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
            'index' => ListAljabels::route('/'),
            'create' => CreateAljabel::route('/create'),
            'view' => ViewAljabel::route('/{record}'),
            'edit' => EditAljabel::route('/{record}/edit'),
        ];
    }
}
