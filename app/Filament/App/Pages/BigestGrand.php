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

    protected static ?int $navigationSort=3;
    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return __('Statistics and Charts');
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
