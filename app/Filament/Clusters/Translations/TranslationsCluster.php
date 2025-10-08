<?php

namespace App\Filament\Clusters\Translations;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class TranslationsCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;
    protected static ?int $navigationSort=4;
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->is_admin;
    }
}
