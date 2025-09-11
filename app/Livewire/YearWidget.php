<?php

namespace App\Livewire;

use App\Models\Year;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class YearWidget extends BaseWidget
{

  protected static ?int $sort=13;
  public function getTableRecordKey( $record): string
  {
    return uniqid();
  }
  public function table(Table $table): Table
  {
    return $table
      ->query(
        function () {
          return Year::query();

        }
      )

      ->heading(new HtmlString('<div class="text-primary-400 text-lg">'.__('By gender').'</div>'))
      ->defaultPaginationPageOption(5)
      ->queryStringIdentifier('Years')
      ->defaultSort('name',)
      ->striped()
        ->defaultKeySort(false)
      ->columns([
        TextColumn::make('name')
          ->sortable()
          ->color('blue')
          ->searchable()
          ->label('الفترة'),
        TextColumn::make('count')
          ->color('warning')
          ->sortable()
          ->label('العدد')
        ,
      ]);
  }
}
