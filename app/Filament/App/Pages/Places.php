<?php

namespace App\Filament\App\Pages;

use App\Livewire\AreaWidget;

use App\Livewire\Roadwidget;
use App\Livewire\StreetWidget;
use BackedEnum;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Radio;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

use Filament\Pages\Page;

use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use function Livewire\on;

class Places extends Page implements HasForms
{
    use InteractsWithForms;


    protected  string $view = 'filament.app.pages.places';
    protected ?string $heading='';

    public static function getNavigationLabel(): string
    {
        return __('Addresses');
    }

    protected static string | BackedEnum | null $navigationIcon=Heroicon::BuildingOffice2;
    protected static ?int $navigationSort=5;
    public function getFooterWidgetsColumns(): int |  array
    {
        return 2;
    }
    public $show='area';
    public $onlyLibyan=false;

    public function mount(): void{
        if (session()->has('lang_code')) {
            app()->setLocale(session()->get('lang_code'));
        }

        $this->form->fill();
    }
public function form(Schema $schema): Schema
{
    return $schema
        ->components([
            Radio::make('show')
                ->inline()
                ->hiddenLabel()
                ->inlineLabel(false)
                ->live()
                ->columnSpan(3)
                ->default('area')
                ->extraAttributes(['class'=>'radio_text'])
                ->afterStateUpdated(function ($state){
                    $this->show=$state;
                    $this->dispatch('take_road',road_id: null,areaName: null);
                    $this->dispatch('take_area',area_id: null,areaName: null);

                })
                ->options([
                    'area'=>__('By Localities'),
                    'road'=> __('By Roads'),
                ]),

        ]);
}

    protected function getFooterWidgets(): array
    {
        if ($this->show=='area')
        return [
            AreaWidget::make(),
            StreetWidget::make(),



        ];
        if ($this->show=='road')
            return [
                Roadwidget::make(),
                StreetWidget::make(),

            ];


    }
}
