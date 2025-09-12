<?php

namespace App\Filament\Resources\Victims\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class VictimsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('FullName')
                    ->description(function (Model $record){
                        return $record->getTranslation('FullNameJs','en');
                    })
                    ->searchable(),
                TextColumn::make('Family.FamName'),
                TextColumn::make('Familyshow.name'),
                TextColumn::make('Street.StrName'),
                TextColumn::make('male'),
                TextColumn::make('year'),
                ImageColumn::make('image2')
                    ->stacked()
                    ->circular(),
            ])
            ->defaultSort('created_at','desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
