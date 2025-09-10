<?php

namespace  App\Livewire;

use App\Models\Area;
use App\Models\Family;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class AreaWidget extends BaseWidget
{
  protected int | string | array $columnSpan=1;
  protected static ?int $sort=1;


  public function table(Table $table): Table
    {
        return $table
          ->query(function () {
         return   Area::where('id','!=',null);

          }
          )
            ->extraAttributes(['class' => 'table_head_top_amber'])
          ->queryStringIdentifier('area')
          ->heading(new HtmlString('<div class="text-primary-900 text-lg">'.__('Number of victims by Locality').'</div>'))
          ->paginated(false)


            ->defaultSort('victim_count','desc')
          ->striped()
          ->columns([
            TextColumn::make('AreaNameJs')
              ->action(function (Area $record){
                $this->dispatch('take_area',area_id: $record->id,areaName: $record->AreaNameJs);
              })
              ->color('blue')
              ->label(''),
            TextColumn::make('victim_count')
              ->color('warning')
              ->label('')
              ->counts('Victim'),


          ]);
    }
}
