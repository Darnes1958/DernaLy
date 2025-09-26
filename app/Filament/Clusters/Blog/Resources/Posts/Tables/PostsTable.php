<?php

namespace App\Filament\Clusters\Blog\Resources\Posts\Tables;

use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;


class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('title')
                    ->action(
                        Action::make('editBody')
                            ->modalWidth(Width::ScreenTwoExtraLarge)

                            ->fillForm(fn(Model $record): array=>['body2'=>$record->body])
                            ->schema(
                                [
                                    Textarea::make('body2')->rows(10)
                                ])
                            ->action(function (Model $record,array $data ){
                                $record->body=$data['body2'];
                                $record->save();
                            })
                    )

                    ->searchable(),
                ImageColumn::make('image'),
                TextColumn::make('published_at')
                    ->dateTime()
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
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('see')
                    ->url(fn ($record) => route('filament.admin.pages.custom-show-post.{record}', ['record' => $record->id]))

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
