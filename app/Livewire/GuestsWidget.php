<?php

namespace App\Livewire;

use App\Livewire\Traits\PublicTrait;
use App\Models\Victim;


use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\TextColumn;

class GuestsWidget extends BaseWidget
{
    use PublicTrait;
    protected int | string | array $columnSpan = 2;
    protected static ?int $sort=11;
    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $tribe=Victim::where('guests',1);
                return $tribe;
            }
            )

            ->queryStringIdentifier('guests')
            ->heading(new HtmlString('<div class="text-primary-400 text-lg">'.__('Guests').' ('.Victim::where('guests',1)->count().')</div>'))
            ->defaultPaginationPageOption(5)
            ->defaultSort('street_id')
            ->striped()
            ->columns([
                TextColumn::make('FullNameJs')
                    ->sortable()
                    ->label('FullName')
                    ->color('blue')
                    ->searchable(),
                TextColumn::make('notesJs')
                    ->color('warning')
                    ->sortable(),

                ImageColumn::make('image2')
                    ->height(160)
                    ->label('Image')
                    ->limit(1)
                    ->circular(),

            ]);
    }
}
