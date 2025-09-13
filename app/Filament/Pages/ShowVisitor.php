<?php

namespace App\Filament\Pages;

use App\Livewire\VisitorsCityWidget;
use App\Livewire\VisitorsCountryWidget;
use App\Models\Visitor;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class ShowVisitor extends Page implements HasTable,HasForms
{
    use InteractsWithTable,InteractsWithForms;
    protected string $view = 'filament.pages.show-visitor';

    public  $date1;
    public $date2;
    public function mount()
    {
        $this->date1=today();
        $this->date2=today();
        $this->form->fill(['date1'=>$this->date1,'date2'=>$this->date2]);
    }

    protected function getHeaderWidgets(): array
    {
        return [
            VisitorsCountryWidget::class,
            VisitorsCityWidget::class,
        ];
    }

public function form(Schema $schema): Schema
{
    return $schema
        ->components([
           DatePicker::make('date1')
           ->afterStateUpdated(function ($state) {
               $this->date1=$state;
               $this->dispatch('take_date1',date1:$this->date1);
           }),
           DatePicker::make('date2')
               ->afterStateUpdated(function ($state) {
                   $this->date2=$state;
                   $this->dispatch('take_dates',date1:$this->date1,date2:$this->date2);
               })

        ])->columns(2);
}

    public function table(Table $table): Table
    {
        return $table
            ->query(function (){
                return Visitor::query()->orderByDesc('created_at');
            })
            ->columns([
                TextColumn::make('ip'),
                TextColumn::make('user_agent')
                    ->limit(50, end: ' (more)'),

                TextColumn::make('browser'),
                TextColumn::make('platform'),
                TextColumn::make('device'),
                TextColumn::make('countryName')->searchable()->sortable(),
                TextColumn::make('cityName')->searchable()->sortable(),
                TextColumn::make('created_at'),
            ]);
    }
}


