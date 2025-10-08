<?php

namespace App\Filament\Pages;

use App\Models\Post;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Tiptap\Nodes\Text;

class RepPost extends Page implements HasTable
{
    use InteractsWithTable;
    protected string $view = 'filament.pages.rep-post';

    protected static ?string $navigationLabel='عرض المدونات';

    public function table(Table $table): Table
    {
        return $table
            ->query(function (){
               return Post::query();
            })
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
                TextColumn::make('Author.name'),
                TextColumn::make('Category.name'),
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
            ->recordActions([

                Action::make('see')
                    ->label('عرض المدونة')
                    ->url(fn ($record) => route('filament.admin.pages.custom-show-post.{record}', ['record' => $record->id]))

            ])
            ;
    }
}
