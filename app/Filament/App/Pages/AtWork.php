<?php

namespace App\Filament\App\Pages;


use App\Livewire\WorkWidget;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class AtWork extends Page
{

    protected static string | BackedEnum | null $navigationIcon=Heroicon::WrenchScrewdriver;
    protected  string $view = 'filament.app.pages.at-work';
    protected ?string $heading='';
    protected static ?string $navigationLabel='في العمل';
    protected static ?int $navigationSort=8;

    protected function getFooterWidgets(): array
    {
        return [
            WorkWidget::class,
        ];
    }
}
