<?php

namespace App\Livewire\Charts;

use App\Models\Road;
use App\Models\Street;
use App\Models\Victim;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class ChartEastWest extends ChartWidget
{

    public function getHeading(): string|Htmlable|null
    {
        return __('Comparison between the west and east of the valley');
    }
    protected int | string | array $columnSpan=2;
    protected static ?int $sort=17;
    protected function getData(): array
    {
      $data=$this->getInfo();
      return [
        'datasets' => [
          [
            'label' => 'Blog posts created',
            'data' => $data['theData'],
            'backgroundColor' => [
              "#483D8B",
              "#FFB6C1",
            ],
          ],
        ],
        'labels' => $data['theLabels'],
      ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
  private function getInfo(): array {
    $west=Street::whereIn('road_id',Road::where('east_west','غرب الوادي')->pluck('id'))->pluck('id');
    $east=Street::whereIn('road_id',Road::where('east_west','شرق الوادي')->pluck('id'))->pluck('id');

    $theLabels=['شرق الوادي','غرب الوادي'];
    $theData=[
      Victim::whereIn('street_id',$east)->count(),
      Victim::whereIn('street_id',$west)->count(),
    ];

    return [
      'theLabels'=> $theLabels,
      'theData' => $theData,
    ];
  }
}
