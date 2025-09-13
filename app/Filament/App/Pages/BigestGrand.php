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

public static function getNavigationSort(): ?int
{
    return 10;
}

    public static function getNavigationLabel(): string
    {
        return __('The largest families');
    }
    public function mount(): void
    {
        if (session()->has('lang_code')) app()->setLocale(session()->get('lang_code'));
        else app()->setLocale('ar');
    }


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
