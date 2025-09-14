<?php

namespace App\Livewire\Visitors;

use App\Models\Visitor;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;


class VisitorsCityWidget extends TableWidget
{
    public $date1,$date2;
    public function mount()
    {
        $this->date1=today();
        $this->date2=today();
    }

    public function getTableRecordKey(Model|array $record): string
    {
        return uniqid();
    }

    #[On('take_dates')]
    public function take_date($date1,$date2)
    {

        $this->date1=$date1;
        $this->date2=$date2;

    }
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Visitor::query()
            ->selectRaw('cityName,count(*) as count')
            ->groupby('cityName')
            ->where('countryName','Libya')
                ->whereDate('created_at','>=',$this->date1)
                ->whereDate('created_at','<=',$this->date2)
            )
            ->columns([
                TextColumn::make('cityName'),
                TextColumn::make('count')
                ->summarize(Sum::make()->label(''))
            ])
            ->heading(function (){
                $d1=Carbon::parse($this->date1);
                $d2=Carbon::parse($this->date2);
                if ($this->date1==$this->date2 ) return $d1->format('Y-m-d');
                ;
                return 'between '.$d1->format('Y-m-d').' - '.$d2->format('Y-m-d');
            })
            ->defaultPaginationPageOption(5)
            ->defaultSort('count','desc')
            ->defaultKeySort(false)
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
