<?php

namespace App\Filament\App\Pages;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use UnitEnum;


class Fazha extends Page implements HasSchemas
{
    use InteractsWithSchemas;
    protected string $view = 'filament.app.pages.fazha';

    protected ?string $heading='شهداء الفزعة - شباب بنغازي';
    protected static ?string $navigationLabel='شباب بنغازي';
    protected static string | UnitEnum | null $navigationGroup='شهداء الفزعة';


    public $Fazha= [];
    public function mount()
    {
       $this->Fazha= [
            1 => [
                'name' => 'محمد المجبري',
                'image' => asset('images/fazha/magbry.jpg'),
            ],
            2 => [
                'name' => 'ناجي بن سعود',
                'image' => asset('images/fazha/najy.jpg'),
            ],
            3 => [
                'name' => 'بالعيد التاورغي',
                'image' => asset('images/fazha/belead.jpg'),
            ],
            4 => [
                'name' => 'يوسف الدينالي',
                'image' => asset('images/fazha/yosif.jpg'),
            ],
            5 => [
                'name' => 'هاشم الشريف',
                'image' => asset('images/fazha/hashem.jpg'),
            ],
            6 => [
                'name' => 'مهند المبسوط',
                'image' => asset('images/fazha/mohanad.jpg'),
            ],

        ];
    }
    public function fazhaInfolist(Schema $schema): Schema
    {
        return $schema

            ->components([

                ImageEntry::make('magbry')
                 ->label(new HtmlString('<div class="text-primary-900 text-4xl">محمد المجبري</div>'))
                 ->imageSize(300)
                 ->state(function (){
                     return asset('images/fazha/magbry.jpg');
                 }),
                ImageEntry::make('hashem')
                    ->label(new HtmlString('<div class="text-primary-900 text-4xl">هاشم الشريف</div>'))
                    ->imageSize(300)
                    ->state(function (){
                        return asset('images/fazha/hashem.jpg');
                    }),
                ImageEntry::make('belead')
                    ->label(new HtmlString('<div class="text-primary-900 text-4xl">بالعيد التاورغي</div>'))
                    ->imageSize(300)
                    ->state(function (){
                        return asset('images/fazha/belead.jpg');
                    }),
                ImageEntry::make('najy')
                    ->label(new HtmlString('<div class="text-primary-900 text-4xl">ناجي بن سعود</div>'))
                    ->imageSize(300)
                    ->state(function (){
                        return asset('images/fazha/najy.jpg');
                    }),

                ImageEntry::make('mohanad')
                    ->label(new HtmlString('<div class="text-primary-900 text-4xl">مهند المبسوط</div>'))
                    ->imageSize(300)
                    ->state(function (){
                        return asset('images/fazha/mohanad.jpg');
                    }),
                ImageEntry::make('yosif')
                    ->label(new HtmlString('<div class="text-primary-900 text-4xl">يوسف الدينالي</div>'))
                    ->imageSize(300)
                    ->state(function (){
                        return asset('images/fazha/yosif.jpg');
                    }),

            ])->columns(2);
    }



}
