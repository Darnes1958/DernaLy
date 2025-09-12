<?php

namespace App\Filament\App\Pages;

use Illuminate\Support\Facades\Log;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected ?string $heading='';
    public function mount(): void
    {
        if (session()->has('lang_code')) app()->setLocale(session()->get('lang_code'));
        else app()->setLocale('ar');


    }
    public function getColumns(): int|array
    {
        return 4;
    }
}
