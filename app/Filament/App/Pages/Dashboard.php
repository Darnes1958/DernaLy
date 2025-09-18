<?php

namespace App\Filament\App\Pages;

use App\Models\Contact;
use Filament\Actions\Action;
use Filament\Actions\Concerns\HasAction;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Log;

class Dashboard extends Page implements HasForms,HasActions
{
    use InteractsWithActions,InteractsWithForms;
    protected string $view = 'filament.app.pages.dashboard';

    public static function getNavigationLabel(): string
    {
        return __('Dashboard');
    }

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

    protected function getActions(): array
    { return [
      Action::make('info')->label(__('Inquiry and research'))->url(VictimAll::getUrl())
    ];
    }


}
