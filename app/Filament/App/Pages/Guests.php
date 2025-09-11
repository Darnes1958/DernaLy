<?php

namespace App\Filament\App\Pages;




use App\Livewire\GuestsWidget;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Guests extends Page
{

    protected static string | BackedEnum | null $navigationIcon=Heroicon::UserGroup;

    protected  string $view = 'filament.app.pages.guests';

    protected ?string $heading='';
    protected static ?string $navigationLabel='ضيوف';
    protected static ?int $navigationSort=6;

    protected function getFooterWidgets(): array
    {
        return [
            GuestsWidget::class,
        ];
    }

}
