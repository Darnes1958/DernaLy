<?php

namespace App\Filament\App\Pages;




use App\Livewire\GuestsWidget;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Guests extends Page
{

    protected static string | BackedEnum | null $navigationIcon=Heroicon::UserGroup;

    protected  string $view = 'filament.app.pages.guests';

    protected ?string $heading='';
    public static function getNavigationLabel(): string
    {
        return __('Guests');
    }
    public function mount(): void
    {
        if (session()->has('lang_code')) app()->setLocale(session()->get('lang_code'));
        else app()->setLocale('ar');
    }


    protected function getFooterWidgets(): array
    {
        return [
            GuestsWidget::class,
        ];
    }

}
