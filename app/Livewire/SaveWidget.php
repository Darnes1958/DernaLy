<?php

namespace App\Livewire;

use App\Models\Victim;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class SaveWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 3;
    protected static ?int $sort=12;

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $tribe=Victim::where('inSave',1);
                return $tribe;
            }
            )
            ->queryStringIdentifier('inSave')
            ->heading(new HtmlString('<div class="text-primary-400 text-lg">'.__('Rescuers').' ('.Victim::where('inSave',1)->count().')</div>'))
            ->defaultPaginationPageOption(5)
            ->defaultSort('street_id')
            ->striped()
            ->columns([
                TextColumn::make('FullNameJs')
                    ->sortable()
                    ->color('blue')
                    ->label('FullName')
                    ->searchable()
                    ->formatStateUsing(fn (Victim $record): View => view(
                        'filament.app.pages.assist.data-with-images',
                        ['record' => $record],
                    )),
                TextColumn::make('notesJs')
                    ->color('warning')
                    ->sortable(),

                ImageColumn::make('image2')
                    ->height(160)
                    ->label(__('Image'))
                    ->limit(1)
                    ->circular(),
            ]);
    }
}
