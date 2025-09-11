<?php

namespace App\Filament\App\Clusters\Statistics;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;

class StatisticsCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    /**
     * @return string|null
     */
    public static function getNavigationLabel(): string
    {

        return __('Statistics');

    }

}
