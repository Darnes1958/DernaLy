<?php

namespace App\Filament\App\Pages;

use App\Livewire\JobTypeWidget;
use App\Livewire\JobVictimWidget;
use App\Livewire\JobWidget;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class JobPage extends Page
{
    protected static string | BackedEnum | null $navigationIcon=Heroicon::AcademicCap;

    protected  string $view = 'filament.app.pages.job-page';
    protected static ?string $navigationLabel='وظائف ومهن';
    protected static ?int $navigationSort=9;
    protected ?string $heading='';
    public function getFooterWidgetsColumns(): int |  array
    {
        return 8;
    }

    protected function getFooterWidgets(): array
    {
        return [
            JobTypeWidget::make(),
            JobWidget::class,
            JobVictimWidget::class,
        ];

    }
}
