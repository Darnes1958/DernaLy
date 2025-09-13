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
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\On;

class GrandSons extends BaseWidget
{
  protected int | string | array $columnSpan = 3;
  protected static ?int $sort=1;

    public $grand=-1;
    public $fathers=[];
    #[On('take_grand')]
    public function take_grand($grand){
        $this->grand=$grand;
        $this->fathers=Victim::query()

            ->where(function ($query) {
                $query->where('father_id',$this->grand)
                    ->orwhere('mother_id',$this->grand);
            })
            ->where(function ($query) {
                $query->where('is_father',1)
                    ->orwhere('is_mother',1);
            })->pluck('id');
    }
  public function table(Table $table): Table
  {
    return $table
      ->query(function () {
          $data=Victim::where(function ($query) {
              $query-> whereIn('father_id',$this->fathers)->orwhereIn('mother_id',$this->fathers);
          })->where(function ($query) {
              $query->where('is_father',1)
                  ->orwhere('is_mother',1);
          })  ;
        return $data;
      }
      )
      ->queryStringIdentifier('grand')

      ->striped()
      ->columns([
        TextColumn::make('FullNameJs')

            ->formatStateUsing(fn (Victim $record): View => view(
                'filament.app.pages.assist.full-data',
                ['record' => $record],
            ))
          ->searchable(),

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
                              ->stacked()
                              ->label('')
                              ->height(500)
                      ])
              )
              ->height(100)
              ->limit(1)
              ->circular()


      ]);
  }
}
