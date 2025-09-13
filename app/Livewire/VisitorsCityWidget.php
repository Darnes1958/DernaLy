<?php

namespace App\Livewire;

use App\Models\Visitor;
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

    #[On('take_date1')]
    public function take_date1($date1)
    {
        info('yes');
        $this->date1=$date1;

    }
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Visitor::query()
            ->selectRaw('cityName,count(*) as count')
            ->groupby('cityName')
            ->where('countryName','Libya')
            ->where('created_at', today())
            )
            ->columns([
                TextColumn::make('cityName'),
                TextColumn::make('count')
                ->summarize(Sum::make())
            ])
            ->heading(function (){
                if ($this->date1==$this->date2 && $this->date1==today()) return today();
                return 'between '.$this->date1.' - '.$this->date2;
            })
            ->defaultSort('cityName')
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
