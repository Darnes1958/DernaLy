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

    protected static ?int $navigationSort=9;
    protected ?string $heading='';
    public static function getNavigationLabel(): string
    {
        return __('Jobs and careers');
    }
    public function mount(): void
    {
        if (session()->has('lang_code')) app()->setLocale(session()->get('lang_code'));
        else app()->setLocale('ar');
    }

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
