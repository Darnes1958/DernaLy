<?php

namespace App\Livewire;

use App\Filament\App\Pages\Dashboard;
use App\Models\Customers;
use App\Models\OurCompany;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TopBar extends Component implements  HasForms
{


    use InteractsWithForms;
    public $status;


    public function optionSelected()
    {
        session()->put('lang_code',$this->status);
        app()->setLocale($this->status);
      //  $this->redirect(url(Dashboard::getUrl()));
        redirect(request()->header('Referer'));

    }
    public function mount()
    {
        $this->form->fill(['status'=>app()->getLocale()]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('status')

                    ->options(
                            [ 'ar' => '<span class="morehoneyyellow">العربية</span><span class="morehoneyyellow">&nbsp;&nbsp;ar</span>',
                              'en' => '<span class="text-green-500">English</span><span>&nbsp;&nbsp;en</span>',
                            ])
                    ->hiddenLabel()
                    ->allowHtml()
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
        $current=app()->getLocale();
        if($current=="en"){$name="English";}
        else {$name="Arabic";}

        return view('livewire.top-bar',['current'=>$current,'name'=>$name]);


    }
}
