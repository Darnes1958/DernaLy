<?php

namespace App\Filament\Clusters\Translations\Resources\Areas\Tables;

use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class AreasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('AreaName')
                    ->searchable()
            ->description(function (Model $record){
                return $record->getTranslation('AreaNameJs','en');
            })
            ->action(
                Action::make('Updname')
                    ->fillForm(fn(Model $record): array=>[
                        'nameAr'=>$record->AreaNameJs,'nameEn'=>$record->getTranslation('AreaNameJs','en'),
                    ])
                    ->schema([
                        TextInput::make('nameAr')->required(),
                        TextInput::make('nameEn')->required(),
                    ])
                    ->action(function (Model $record,array $data) {
                        $rec=['ar'=>$data['nameAr'],'en'=>$data['nameEn']];
                        $record->AreaNameJs=$rec;
                        $record->save();
                    })
            ),
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

            ])
            ->toolbarActions([
               //
            ]);
    }
}
