<?php

namespace App\Filament\Resources\Familyshows;

use App\Filament\Resources\Familyshows\Pages\CreateFamilyshow;
use App\Filament\Resources\Familyshows\Pages\EditFamilyshow;
use App\Filament\Resources\Familyshows\Pages\ListFamilyshows;
use App\Filament\Resources\Familyshows\Schemas\FamilyshowForm;
use App\Filament\Resources\Familyshows\Tables\FamilyshowsTable;
use App\Models\Familyshow;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FamilyshowResource extends Resource
{
    protected static ?string $model = Familyshow::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel='العائلات الكبري';

    public static function form(Schema $schema): Schema
    {
        return FamilyshowForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FamilyshowsTable::configure($table);
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
            'index' => ListFamilyshows::route('/'),
            'create' => CreateFamilyshow::route('/create'),
            'edit' => EditFamilyshow::route('/{record}/edit'),
        ];
    }
}
