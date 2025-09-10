<?php

namespace App\Filament\Resources\Streets\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class StreetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('StrNameJs')
                    ->color('info')
                    ->description(function (Model $record){
                        return $record->getTranslation('StrNameJs','en');
                    })
                    ->action(
                        Action::make('Updname')
                        ->fillForm(fn(Model $record): array=>[
                            'nameAr'=>$record->StrNameJs,'nameEn'=>$record->getTranslation('StrNameJs','en'),
                        ])
                        ->schema([
                            TextInput::make('nameAr')->required(),
                            TextInput::make('nameEn')->required(),
                        ])
                        ->action(function (Model $record,array $data) {
                            $rec=['ar'=>$data['nameAr'],'en'=>$data['nameEn']];
                            $record->StrNameJs=$rec;
                            $record->save();
                        })
                    )
                    ->searchable(),
                TextColumn::make('Area.AreaName')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('building')
                    ->boolean(),
                TextColumn::make('Road.name')
                    ->numeric()
                    ->sortable(),
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
            ->recordUrl(false)
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
               //
            ]);
    }
}
