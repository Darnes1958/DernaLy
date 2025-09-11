<?php

namespace App\Livewire;

use App\Models\Road;
use App\Models\Street;
use App\Models\Victim;
use Filament\Widgets\Widget;

class CusAddCountWidget extends Widget
{
    protected string $view = 'livewire.cus-add-count-widget';
    protected int | string | array $columnSpan='full';

    public $west,$east,$derna,$naga;

    public function mount() {
        $west=Street::whereIn('road_id',Road::where('east_west','غرب الوادي')->pluck('id'))->pluck('id');
        $east=Street::whereIn('road_id',Road::where('east_west','شرق الوادي')->pluck('id'))->pluck('id');

        $this->east= Victim::whereIn('street_id',$east)->count();
        $this->west= Victim::whereIn('street_id',$west)->count();
        $this->derna= Victim::whereIn('street_id',Street::where('road_id',15)->pluck('id'))->count();
        $this->naga= Victim::whereIn('street_id',Street::where('road_id',16)->pluck('id'))->count();
    }
}
