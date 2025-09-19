<?php

namespace App\Filament\Clusters\Translations\Resources\Familyshows\Tables;

use App\Models\Family;
use App\Models\Familyshow;
use App\Models\Victim;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class FamilyshowsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('nameJs')
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

                TextColumn::make('bigfamily.name'),
                TextColumn::make('bigfamily.Tarkeba.name'),
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
