<?php

namespace App\Filament\App\Pages;


use App\Livewire\GrandFather;
use App\Livewire\Sons;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class BigestGrand extends Page
{
    protected static string | BackedEnum | null $navigationIcon=Heroicon::UserCircle;

    protected  string $view = 'filament.app.pages.bigest-grand';
    protected ?string $heading='';
    protected static ?string $navigationLabel='أكبر الأسر';
    protected static ?int $navigationSort=6;
    public function getFooterWidgetsColumns(): int |  array
    {
        return 5;
    }

    protected function getFooterWidgets(): array
    {
        return [

            GrandFather::class,
            Sons::class,
        ];
    }
}
