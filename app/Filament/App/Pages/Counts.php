<?php

namespace App\Filament\App\Pages;

use App\Filament\Widgets\MaleFemale;
use Filament\Pages\Page;

class Counts extends Page
{


    protected  string $view = 'filament.app.pages.counts';

    protected ?string $heading='';
    protected static ?string $navigationLabel='الأعداد';
    protected static ?int $navigationSort=4;

    protected function getFooterWidgets(): array
    {
       return [
           \App\Livewire\Counts::class,
        ];
    }
}
