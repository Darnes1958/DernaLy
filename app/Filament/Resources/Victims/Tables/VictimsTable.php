<?php

namespace App\Filament\Resources\Victims\Tables;


use App\Models\Victim;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
                Action::make('delete')
                    ->iconButton()

                    ->icon('heroicon-s-trash')
                    ->requiresConfirmation()
                    ->action(function (Victim $record){
                        $record->delete();
                    }),
                Action::make('arc')
                    ->iconButton()

                    ->icon('heroicon-s-archive-box')
                    ->requiresConfirmation()
                    ->modalHeading('نقل السجل للأرشيف')
                    ->modalDescription('هل انت متأكد من نقل السجل الي الأرشيف ؟')
                    ->fillForm(fn (Victim $record): array => [
                        'notes' => $record->notes,
                    ])
                    ->schema([
                        TextInput::make('notes')
                            ->label('ملاحظات')
                    ])
                    ->action(function (Victim $record,array $data){

                        $record=Victim::find($record->id);
                        $oldRecord= $record;
                        $newRecord = $oldRecord->replicate();

                        $newRecord->setTable('archifs');
                        $newRecord->id=$record->id;
                        $newRecord->notes=$data['notes'];
                        $newRecord->save();
                        $record->delete();

                    }),

            ])
            ->toolbarActions([
                //
            ]);
    }
}
