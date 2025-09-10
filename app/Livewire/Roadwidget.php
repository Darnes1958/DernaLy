<?php

namespace  App\Livewire;


use App\Livewire\Traits\PublicTrait;use App\Models\Road;

use App\Models\Street;
use App\Models\Victim;

use Filament\Actions\Action;
use Filament\Infolists\Components\ImageEntry;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\HtmlString;


class Roadwidget extends BaseWidget
{

  protected int | string | array $columnSpan = 1;
    protected static ?int $sort=2;


    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return $tribe=Road::query() ;

            }
            )
            ->extraAttributes(['class' => 'table_head_top_amber'])
            ->queryStringIdentifier('roads')
            ->heading(new HtmlString('<div class="text-primary-900 text-lg">'.__('Number of victims by Roads').'</div>'))
            ->defaultPaginationPageOption(6)
            ->paginationPageOptions([6,10,16,25,50,100])


            ->defaultSort('victim_count','desc')
            ->striped()
            ->columns([
                TextColumn::make('nameJs')

                  ->action(function (Road $record){
                    $this->dispatch('take_road',road_id: $record->id,areaName: $record->nameJs);
                  })
                    ->color('blue')
                    ->searchable()
                    ->label(''),
                TextColumn::make('victim_count')
                    ->color('warning')
                    ->label('')
                    ->counts('Victim'),
                ImageColumn::make('image')
                    ->label('')
                    ->action(
                        Action::make('show_images')
                            ->visible(function ($record){return $record->image !=null;})
                            ->label(' ')
                            ->modalSubmitAction(false)
                            ->modalCancelActionLabel('عودة')
                            ->infolist([
                                ImageEntry::make('image')
                                    ->label('')
                                    ->stacked()
                                    ->label('')
                                    ->height(500)
                            ])
                    )
                    ->limit(1)


            ])                     ;
    }
}
