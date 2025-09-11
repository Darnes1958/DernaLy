<?php

namespace App\Filament\App\Pages;

use App\Filament\App\Clusters\Statistics\StatisticsCluster;
use App\Filament\Widgets\MaleFemale;
use App\Livewire\CusCountWidget;
use App\Livewire\CusSexWidget;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class Sexs extends Page
{


    protected  string $view = 'filament.app.pages.counts';
    protected static string | \BackedEnum | null $navigationIcon = Heroicon::NumberedList;

    protected ?string $heading='';
    protected static ?string $cluster =StatisticsCluster::class;

    protected static ?int $navigationSort=3;
    public static function getNavigationLabel(): string
    {
        return __('By gender');
    }
    public function getTitle(): string|Htmlable
    {
        return __('By gender');
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
           CusSexWidget::class,

        ];
    }
}
