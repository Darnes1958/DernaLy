<?php

namespace App\Filament\App\Pages;

use App\Livewire\GraetGrandFather;
use App\Livewire\GrandSons;
use App\Livewire\Sons;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class GrandTree extends Page
{

    protected static string | BackedEnum | null $navigationIcon=Heroicon::UserCircle;
    protected string $view = 'filament.app.pages.grand-tree';
    protected ?string $heading='';

    public static function getNavigationLabel(): string
    {
        return __('Paternal and Maternal Grandparents');
    }
    public function mount(): void
    {
        if (session()->has('lang_code')) app()->setLocale(session()->get('lang_code'));
        else app()->setLocale('ar');
    }


    protected static ?int $navigationSort=4;
    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return __('Statistics and Charts');
    }

    public function getFooterWidgetsColumns(): int | array
    {
        return 8;
    }

    protected function getFooterWidgets(): array
    {
        return [
            GraetGrandFather::class,
            Sons::class,
            GrandSons::class,

        ];
    }
}
