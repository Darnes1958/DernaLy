<?php

namespace App\Filament\App\Pages;

use App\Livewire\TalentTypeWidget;
use App\Livewire\TalentVictimWidget;
use App\Livewire\TalentWidget;
use App\Models\Talent;
use App\Models\VicTalent;
use App\Models\Victim;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Madany extends Page
{




    protected  string $view = 'filament.app.pages.madany';
    protected static ?string $navigationLabel='مجتمع مدني ومواهب';
    protected static ?int $navigationSort=9;
    protected ?string $heading='';
    public function getFooterWidgetsColumns(): int |  array
    {
        return 8;
    }

    protected function getFooterWidgets(): array
    {
        return [
            TalentTypeWidget::class,
            TalentWidget::class,
            TalentVictimWidget::class,
        ];

    }
}
