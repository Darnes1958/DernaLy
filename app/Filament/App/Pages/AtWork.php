<?php

namespace App\Filament\App\Pages;


use App\Livewire\WorkWidget;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class AtWork extends Page
{

    protected static string | BackedEnum | null $navigationIcon=Heroicon::WrenchScrewdriver;
    protected  string $view = 'filament.app.pages.at-work';
    protected ?string $heading='';

    protected static ?int $navigationSort=2;
   public static function getNavigationGroup(): string|UnitEnum|null
   {
       return __('Guests, Rescuers and on the Job');
   }

    public static function getNavigationLabel(): string
    {
        return __('During work');
    }
    public function mount(): void
    {
        if (session()->has('lang_code')) app()->setLocale(session()->get('lang_code'));
        else app()->setLocale('ar');
    }

    protected function getFooterWidgets(): array
    {
        return [
            WorkWidget::class,
        ];
    }
}
