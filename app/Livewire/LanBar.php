<?php

namespace App\Livewire;

use App\Filament\App\Pages\Dashboard;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use Livewire\Component;
use function Laravel\Prompts\form;

class LanBar extends Component implements HasForms
{


    use InteractsWithForms;
    public $status='ar';
    public $name;

    public function mount()
    {
        $this->form->fill(['status'=>app()->getLocale()]);
    }
    public function optionSelected()
    {
        \session()->put('lang_code',$this->status);


      \session(['lang_code',$this->status]);


      app()->setLocale($this->status);
        App::setLocale(session()->get('lang_code'));



    }


    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                ToggleButtons::make('status')
                    ->options(function () {
                        if ($this->status=='ar') return
                            [
                                'ar' => 'Arabic',
                                'en' => 'English',
                            ];
                        else return
                            [
                                'ar' => 'العربية',
                                'en' => 'English',
                            ];
                    }

                        )
                    ->colors( function () {
                            if ($this->status=='ar')
                                return [
                                    'ar' => 'success',
                                    'en' => 'white',
                                ];
                             else
                                return [
                                    'ar' => 'white',
                                    'en' => 'success',
                                ];

                            })
                    ->icons(function () {
                        if ($this->status=='ar')
                            return [
                                'ar' => Heroicon::Check,
                                'en' => null,
                            ];
                        else   return [
                            'en' => Heroicon::Check,
                            'ar' => null,
                        ];

                    }
                        )

                    ->inline()
                    ->hiddenLabel()
                    ->live()
                    ->afterStateUpdated(function ($state) {
                        $this->status=$state;
                        \session()->put('lang_code',$state);
                        app()->setLocale($state);
                        $this->redirect(url(Dashboard::getUrl()));
                    })
                ]);
    }

    public function render()
    {

        return view('livewire.lan-bar');
    }
}
