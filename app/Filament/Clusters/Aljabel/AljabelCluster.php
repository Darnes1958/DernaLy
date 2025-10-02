<?php

namespace App\Filament\Clusters\Aljabel;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;

class AljabelCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;
    protected static ?string $navigationLabel='بيانات ضحايا مدن وقري الجيل الأخضر';
    protected static ?int $navigationSort=3;

}
