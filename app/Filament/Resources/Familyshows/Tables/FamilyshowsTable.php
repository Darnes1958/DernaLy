<?php

namespace App\Filament\Resources\Familyshows\Tables;

use App\Models\Family;
use App\Models\Familyshow;
use App\Models\Victim;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Google\Cloud\Translate\V3\Model;

class FamilyshowsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('BigFamily.name'),
                TextColumn::make('nation'),

                TextColumn::make('Country.name'),
                TextColumn::make('who'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->before(function (Familyshow $record) {Family::where('familyshow_id',$record->id)->delete();})
                    ->visible(fn (Familyshow $record) => Victim::where('familyshow_id',$record->id)->doesntExist()),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
