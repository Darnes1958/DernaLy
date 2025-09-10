<?php

namespace App\Livewire;

use App\Models\Family;
use App\Models\Road;
use App\Models\Street;
use App\Models\Victim;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\On;

class Count1 extends StatsOverviewWidget
{
    public $west;
    public $east;



    protected function getStats(): array
    {
        return [
            Stat::make('','')
                ->label(new HtmlString('<label class="text-indigo-600 text-4xl">'.__('All Victims').'</label>'))
                ->value(new HtmlString('<label class="text-danger-600 text-4xl ">'.Victim::count().'</label>'))
                ->extraAttributes(['class' => 'w-1/4 justify-center'])
                ->description(__('Libyans and foreigners'))->columnSpan('full'),

        ];
    }
}
