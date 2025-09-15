<?php

namespace App\Livewire\Charts;

use App\Models\Victim;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class ChartParent extends ChartWidget
{

    public function getHeading(): string|Htmlable|null
    {
        return __('Fathers and Mothers') ;
    }
    protected int | string | array $columnSpan=2;
    protected static ?int $sort=15;

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

    $theLabels=['أباء','أمهات'];
    $theData=[Victim::where('is_father',1)->count(),Victim::where('is_mother',1)->count()];

    return [
      'theLabels'=> $theLabels,
      'theData' => $theData,
    ];
  }
}
