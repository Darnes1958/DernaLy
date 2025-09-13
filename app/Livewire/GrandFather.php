<?php

namespace App\Livewire;

use App\Models\Family;
use App\Models\Grand_count;
use App\Models\Great_count;
use App\Models\Tarkeba;
use App\Models\Tribe;
use App\Models\Victim;
use Filament\Actions\Action;
use Filament\Actions\StaticAction;
use Filament\Infolists\Components\ImageEntry;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class GrandFather extends BaseWidget
{
  protected int | string | array $columnSpan = 2;
  protected static ?int $sort=1;


  public function table(Table $table): Table
  {
    return $table
      ->query(function () {
        $data=Grand_count::query()->orderBy('thesum', 'desc')->where('thesum','>=',20);
        return $data;
      }
      )
      ->queryStringIdentifier('grand')
      ->heading(new HtmlString('<div class="text-primary-400 text-lg">'.__('the largest families').'</div>'))
      ->description(__('Click on the name from the list below to view children and grandchildren'))
      ->striped()
      ->columns([
        TextColumn::make('FullNameJs')
          ->sortable()
            ->action(function (Grand_count $record){
                $this->dispatch('take_grand',grand: $record->id);
            })
            ->tooltip(__('Click here to view details'))
          ->description(function (Grand_count $record) {
              $res=null;
              if ($record->male='ذكر' && $record->wife_id != null) $res=__('his wife').' : '.Victim::find($record->wife_id)->FullNameJs;
              if ($record->male='أنثي' && $record->husband_id != null) $res=__('her husband').' : '.Victim::find($record->husband_id)->FullNameJs;
              return $res;
          })
          ->color('blue')
          ->searchable(),

        TextColumn::make('thesum')
          ->color('warning')
          ->sortable()
          ->label(__('Count')),
          ImageColumn::make('image2')
              ->label('')
              ->tooltip(function ($record){
                  if ($record->image2 !=null) return __('Click here to view larger images') ;
                  else return null;})
              ->action(
                  Action::make('show_images')
                      ->visible(function ($record){return $record->image2 !=null;})
                      ->label(' ')
                      ->modalSubmitAction(false)
                      ->modalCancelActionLabel(__('back'))
                      ->schema([
                          ImageEntry::make('image2')
                              ->label('')
                              ->height(500)
                              ->stacked()
                      ])
              )
              ->height(100)
              ->limit(1)
              ->circular()

      ]);
  }
}
