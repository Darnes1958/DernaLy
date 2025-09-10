<?php

namespace App\Filament\App\Pages;

use Illuminate\Support\Facades\Log;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected ?string $heading='';
    public function mount(): void
    {
        app()->setLocale(session()->get('lang_code'));

    }
    public function getColumns(): int|array
    {
        return 4;
    }
}
