<?php

namespace App\Filament\App\Pages;

use App\Enums\Tslsl;


use App\Livewire\SaveWidget;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class AtSave extends Page
{

    protected static string | BackedEnum | null $navigationIcon=Heroicon::Megaphone;
    protected  string $view = 'filament.app.pages.at-save';
    protected ?string $heading='';
    protected static ?string $navigationLabel='منقذين';
    protected static ?int $navigationSort=7;

    protected function getFooterWidgets(): array
    {
        return [
            SaveWidget::class,
        ];
    }
}
