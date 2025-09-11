<?php

namespace App\Filament\App\Pages;

use App\Livewire\FamilyShowWidget;
use App\Livewire\FamWidget;
use App\Livewire\VictimSHow;
use App\Livewire\VictimWidget;
use App\Models\Victim;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Livewire\Attributes\On;

class FamilyPage extends Page
{

protected static string | BackedEnum | null $navigationIcon=Heroicon::UserGroup;
    protected  string $view = 'filament.app.pages.family-page';
    protected ?string $heading='';
    protected static ?string $navigationLabel='العائلات';
    protected static ?int $navigationSort=4;
    public $showFamilyWidget=false;


    public function getFooterWidgetsColumns(): int |  array
    {
        return 6;
    }

    protected function getFooterWidgets(): array
    {
            return [
                FamilyShowWidget::class,
                VictimSHow::class,
            ];

    }

}
