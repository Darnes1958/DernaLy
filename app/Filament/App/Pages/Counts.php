<?php

namespace App\Filament\App\Pages;

use App\Filament\Widgets\MaleFemale;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class Counts extends Page
{


    protected  string $view = 'filament.app.pages.counts';
    protected static string | \BackedEnum | null $navigationIcon = Heroicon::NumberedList;

    protected ?string $heading='';
    protected static ?string $navigationLabel='الأعداد';
    protected static ?int $navigationSort=4;
    public static function getNavigationLabel(): string
    {
        return __('Counts');
    }
    public function getTitle(): string|Htmlable
    {
        return __('Counts');
    }

    #[On('take_lang')]
    public function take_lang($lang)
    {

        app()->setLocale(session()->get('lang_code'));
    }

    public function mount(): void
    {
        if (session()->has('lang_code')) {

            app()->setLocale(session()->get('lang_code'));
        }

    }
    protected function getFooterWidgets(): array
    {
       return [
           \App\Livewire\Counts::class,
        ];
    }
}
