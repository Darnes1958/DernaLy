<?php

namespace App\Livewire;

use App\Filament\App\Pages\Dashboard;


use App\Models\Contact;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

use Livewire\Component;

class TopBar extends Component implements  HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;


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

    public function contactus(): Action
    {
        return Action::make('ContactUs')
            ->label(__('Contact us'))
            ->action(function (array $data)
            {
                Contact::create($data);
            })

            ->modalIcon('heroicon-o-exclamation-triangle')
            ->modalHeading('أهلا وسهلا بكم')
            ->modalDescription('الرجاء كتابة فحوي رسالتكم , وتعبئة رقم الهاتف والبريد الالكتروني إذا رغبتم')

            ->schema([
                Grid::make()
                 ->schema([
                     Textarea::make('message')
                         ->rows(3)
                         ->required()->columnSpan(2),
                     TextInput::make('tel')
                         ->suffixIcon(Heroicon::Phone)
                         ->tel(),
                     TextInput::make('email')
                         ->suffixIcon(Heroicon::AtSymbol)
                         ->email()

                 ])->columns(2)
            ])
            ->link();
    }

    public function form2(Schema $schema): Schema
    {
        return $schema
            ->components([
                Action::make('any')
            ])
            ;
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
