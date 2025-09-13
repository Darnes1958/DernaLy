<?php

namespace App\Filament\Pages;

use App\Livewire\VisitorsCityWidget;
use App\Livewire\VisitorsCountryWidget;
use App\Models\Visitor;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class ShowVisitor extends Page implements HasTable
{
    use InteractsWithTable;
    protected string $view = 'filament.pages.show-visitor';

    protected function getHeaderWidgets(): array
    {
        return [
            VisitorsCountryWidget::class,
            VisitorsCityWidget::class,
        ];
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


