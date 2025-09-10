<?php

namespace App\Filament\App\Pages;

use App\Models\Country;
use App\Models\Victim;
use Filament\Pages\Page;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;

class CountryPage extends Page implements HasTable
{
    use InteractsWithTable;
    protected static string | \BackedEnum | null $navigationIcon = Heroicon::GlobeAlt;

    protected  string $view = 'filament.app.pages.country-page';
    protected ?string $heading='';
    protected static ?int $navigationSort=9;


    public static function getNavigationLabel(): string
    {
        return __('The Countries');
    }
    public function getTitle(): string|Htmlable
    {
        return __('The Countries');
    }
    public function mount(): void
    {

        if (session()->has('lang_code')) {

            app()->setLocale(session()->get('lang_code'));
        }

    }

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return Country::where('name','!=',null);
            })

            ->paginated(false)
            ->queryStringIdentifier('countries')
            ->defaultSort('victim_count','desc')
            ->striped()

            ->columns([
                Stack::make([
                    TextColumn::make('nameJs')
                        ->size(TextSize::Large)
                        ->alignment(Alignment::Center)
                        ->color('blue')
                        ,
                    TextColumn::make('short')

                        ->formatStateUsing(fn (Country $record): View => view(
                            'filament.app.pages.assist.country-flag',
                            ['record' => $record],
                        )),
                    TextColumn::make('victim_count')
                        ->color('warning')
                        ->alignment(Alignment::Center)
                        ->size(TextSize::Large)
                        ->weight(FontWeight::ExtraBold)
                       // ->prefix(__('Number of victims : '))
                        ->counts('Victim'),


                ]),
            ])
            ->contentGrid([
                'md' => 4,
                'xl' => 7,
            ]);
    }
}
