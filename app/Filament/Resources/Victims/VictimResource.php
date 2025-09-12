<?php

namespace App\Filament\Resources\Victims;

use App\Filament\Resources\Victims\Pages\CreateVictim;
use App\Filament\Resources\Victims\Pages\EditVictim;
use App\Filament\Resources\Victims\Pages\ListVictims;
use App\Filament\Resources\Victims\Pages\ViewVictim;
use App\Filament\Resources\Victims\Schemas\VictimForm;
use App\Filament\Resources\Victims\Schemas\VictimInfolist;
use App\Filament\Resources\Victims\Tables\VictimsTable;
use App\Models\Victim;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VictimResource extends Resource
{
    protected static ?string $model = Victim::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VictimForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VictimInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VictimsTable::configure($table);
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
            'index' => ListVictims::route('/'),
            'create' => CreateVictim::route('/create'),
            'view' => ViewVictim::route('/{record}'),
            'edit' => EditVictim::route('/{record}/edit'),
        ];
    }
}
