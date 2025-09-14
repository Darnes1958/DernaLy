<?php

namespace App\Filament\Pages;

use App\Livewire\Visitors\VisitorsCityWidget;
use App\Livewire\Visitors\VisitorsCountryWidget;
use App\Models\Visitor;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ShowVisitor extends Page implements HasTable,HasForms
{
    use InteractsWithTable,InteractsWithForms;
    protected string $view = 'filament.pages.show-visitor';
    protected static string | BackedEnum | null $navigationIcon=Heroicon::User;
    protected static ?string $navigationLabel='Visitors';
    protected ?string $heading='';

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
           ->live()
           ->afterStateUpdated(function ($state) {
               $this->date1=$state;
               $this->dispatch('take_dates',date1:$this->date1,date2:$this->date2);
           }),
           DatePicker::make('date2')
               ->live()
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
                    ->wrap()
                    ->width(500),


                TextColumn::make('browser'),
                TextColumn::make('platform'),
                TextColumn::make('device'),
                TextColumn::make('countryName')->searchable()->sortable(),
                TextColumn::make('cityName')->searchable()->sortable(),
                TextColumn::make('created_at'),
            ])
            ->filters([
              SelectFilter::make('cityName')
               ->options(Visitor::query()
                   ->distinct('cityName')
                   ->where('cityName','!=',null)
                   ->pluck('cityName','cityName')

               )
               ->searchable()
               ->attribute('cityName')
               ->preload(),
              SelectFilter::make('countryName')
                    ->options(Visitor::query()->distinct('countryName')
                        ->where('countryName','!=',null)
                        ->pluck('countryName','countryName'))
                    ->searchable()
                    ->preload(),


            ]);

    }
}


