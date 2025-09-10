<?php

namespace App\Filament\Resources\Roads\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class RoadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->color('info')
                    ->description(function (Model $record){
                        return $record->getTranslation('nameJs','en');
                    })
                    ->action(
                        Action::make('Updname')
                            ->fillForm(fn(Model $record): array=>[
                                'nameAr'=>$record->nameJs,'nameEn'=>$record->getTranslation('nameJs','en'),
                            ])
                            ->schema([
                                TextInput::make('nameAr')->required(),
                                TextInput::make('nameEn')->required(),
                            ])
                            ->action(function (Model $record,array $data) {
                                $rec=['ar'=>$data['nameAr'],'en'=>$data['nameEn']];
                                $record->nameJs=$rec;
                                $record->save();
                            })
                    )
                    ->searchable(),
                TextColumn::make('east_west')
                    ->searchable(),
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
