<?php

namespace App\Filament\App\Pages;

use App\Models\Contact;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\Concerns\HasAction;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Log;

class Dashboard extends Page   implements HasActions, HasForms
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


    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                ActionGroup::make([
                    Action::make('libyan')
                       ->color('gray')
                        ->icon(Heroicon::MagnifyingGlassCircle)
                        ->extraAttributes(['class'=> 'ml-2 text-green-700',])
                        ->label(__('Libyans'))
                        ->url(VictimAll::getUrl()),
                    Action::make('forein')
                        ->color('gray')
                        ->extraAttributes(['class'=> ' text-amber-700',])
                        ->icon(Heroicon::MagnifyingGlassCircle)
                        ->label(__('Foreigners'))
                        ->url(VictimAllForeign::getUrl()),
                ])
                    ->buttonGroup(),
                ActionGroup::make([
                    Action::make('sustics')
                        ->color('gray')
                        ->icon(Heroicon::NumberedList)
                        ->extraAttributes(['class'=> 'ml-2 text-green-700',])
                        ->label(__('Statistics'))
                        ->url(Counts::getUrl()),
                    Action::make('country')
                        ->color('gray')
                        ->extraAttributes(['class'=> ' text-amber-700',])
                        ->icon(Heroicon::GlobeAlt)
                        ->label(__('Countries'))
                        ->url(CountryPage::getUrl()),
                ])
                    ->buttonGroup(),
                ActionGroup::make([
                    Action::make('families')
                        ->color('gray')
                        ->icon(Heroicon::UserGroup)
                        ->extraAttributes(['class'=> 'ml-2 text-green-700',])
                        ->label(__('Families'))
                        ->url(FamilyPage::getUrl()),
                    Action::make('addresses')
                        ->color('gray')
                        ->extraAttributes(['class'=> ' text-amber-700',])
                        ->icon(Heroicon::BuildingOffice2)
                        ->label(__('Addresses'))
                        ->url(Places::getUrl()),
                ])
                    ->buttonGroup(),

            ]);
    }

    protected function getActions(): array
    {
     return [
         Action::make('charts')
             ->label(__('Charts'))
             ->icon(Heroicon::ChartPie)
             ->url(ChartPage::getUrl()),
         Action::make('bigest')
             ->label(__('The largest families'))
             ->icon(Heroicon::UserCircle)
             ->url(BigestGrand::getUrl()),
         Action::make('tree')
             ->icon(Heroicon::UserCircle)
             ->label(__('Paternal and Maternal Grandparents'))
             ->url(GrandTree::getUrl()),

         Action::make('guest')
             ->label(__('Guests'))
             ->icon(Heroicon::UserGroup)
             ->url(Guests::getUrl()),
         Action::make('saver')
             ->label(__('Rescuers'))
             ->icon(Heroicon::Megaphone)
             ->url(AtSave::getUrl()),
         Action::make('work')
             ->icon(Heroicon::WrenchScrewdriver)
             ->label(__('During work'))
             ->url(AtWork::getUrl()),

         Action::make('madny')
             ->label(__('Civil Society and Talents'))
             ->icon(Heroicon::PaintBrush)
             ->url(Madany::getUrl()),
         Action::make('job')
             ->icon(Heroicon::AcademicCap)
             ->label(__('Jobs and careers'))
             ->url(JobPage::getUrl()),

     ]   ;

    }

}
