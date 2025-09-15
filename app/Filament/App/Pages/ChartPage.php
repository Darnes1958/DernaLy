<?php

namespace App\Filament\App\Pages;

use App\Livewire\Charts\ChartCategorie;
use App\Livewire\Charts\ChartEastWest;
use App\Livewire\Charts\ChartNation;
use App\Livewire\Charts\ChartParent;
use App\Livewire\Charts\MaleFemale;
use App\Livewire\Charts\ChartYear;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

class ChartPage extends Page
{
    protected string $view = 'filament.app.pages.chart-page';
    protected static string | BackedEnum | null $navigationIcon=Heroicon::ChartPie;
    protected static ?int $navigationSort=1;
    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return __('Statistics and Charts');
    }

    protected ?string $heading='';

    /**
     * @return string|null
     */
    public static function getNavigationLabel(): string
    {
        return __('Charts');
    }
    public function getFooterWidgetsColumns(): int|array
    {
        return 6;
    }

    protected function getFooterWidgets(): array
    {
        return [
            ChartCategorie::class,
            ChartYear::class,
            ChartEastWest::class,
            MaleFemale::class,
            ChartParent::class,

        ];
    }
}
