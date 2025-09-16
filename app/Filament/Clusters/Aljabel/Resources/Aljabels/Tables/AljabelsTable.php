<?php

namespace App\Filament\Clusters\Aljabel\Resources\Aljabels\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AljabelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('FullName'),
                TextColumn::make('Familyshow.name')
                    ->sortable(),
                TextColumn::make('Place.name')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('sex')
                    ->boolean(),
                TextColumn::make('year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('husband.FullName')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('wife.FullName')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('hisMother.FullName')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('hisFather.FullName')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('image')
                 ->circular(),
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
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
