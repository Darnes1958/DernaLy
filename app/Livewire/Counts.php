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

class Counts extends StatsOverviewWidget
{
    public $west;
    public $east;



    public function mount(){
        $this->west=Street::whereIn('road_id',Road::where('east_west','غرب الوادي')->pluck('id'))->pluck('id');
        $this->east=Street::whereIn('road_id',Road::where('east_west','شرق الوادي')->pluck('id'))->pluck('id');
    }
    protected function getStats(): array
    {
        return [
            Stat::make('','')
                ->label(new HtmlString('<label class="text-indigo-600 text-4xl">'.__('All Victims').'</label>'))
                ->value(new HtmlString('<label class="text-danger-600 text-4xl">'.Victim::count().'</label>'))
                ->description(__('Libyans and foreigners')),
            Stat::make('','')
                ->label(new HtmlString('<span class="text-indigo-600 text-4xl">'.__('Libyans').'</span>'))
                ->value(new HtmlString('<span class="text-danger-600 text-4xl">'.Victim::wherein('family_id',Family::where('country_id',1)->pluck('id'))->count().'</span>'))
                ->description(__('Does not include foreign wives')),
            Stat::make('','')
                ->label(new HtmlString('<span class="text-indigo-600 text-4xl">'.__('Foreigners').'</span>'))
                ->value(new HtmlString('<span class="text-danger-600 text-4xl">'.Victim::wherein('family_id',Family::where('country_id','!=',1)->pluck('id'))->count().'</span>'))
                ->description(__('From 13 nationalities')),
            Stat::make('','')
                ->label(new HtmlString('<span class="text-indigo-600">'.__('Male').'</span>'))
                ->value(new HtmlString('<span class="text-danger-600">'.Victim::where('male','ذكر')->count().'</span>')),
            Stat::make('','')
                ->label(new HtmlString('<span class="text-indigo-600">'.__('Female').'</span>'))
                ->value(new HtmlString('<span class="text-danger-600">'.Victim::where('male','أنثي')->count().'</span>')),
            Stat::make('','')
                ->label(new HtmlString('<span class="text-indigo-600">'.__('Grand Fathers').'</span>'))
                ->value(new HtmlString('<span class="text-danger-600">'.Victim::where('is_grandfather',1)->count().'</span>')),
            Stat::make('','')
                ->label(new HtmlString('<span class="text-indigo-600">'.__('Grand Mothers').'</span>'))
                ->value(new HtmlString('<span class="text-danger-600">'.Victim::where('is_grandmother',1)->count().'</span>')),

            Stat::make('','')
                ->label(new HtmlString('<span class="text-indigo-600">'.__('Fathers').'</span>'))
                ->value(new HtmlString('<span class="text-danger-600">'.Victim::where('is_father',1)->count().'</span>')),
            Stat::make('','')
                ->label(new HtmlString('<span class="text-indigo-600">'.__('Mothers').'</span>'))
                ->value(new HtmlString('<span class="text-danger-600">'.Victim::where('is_mother',1)->count().'</span>')),

        ];
    }
}
