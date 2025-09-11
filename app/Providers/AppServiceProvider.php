<?php

namespace App\Providers;

use App\Models\Setting;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Facades\FilamentView;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\View\PanelsRenderHook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Nette\Utils\Image;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Pdf::default()

            ->withBrowsershot(function (Browsershot $shot) {
                $shot->noSandbox()
                    ->timeout(240)
                    ->setChromePath(Setting::first()->exePath);
            })
            ->margins(10, 10, 20, 10, );
        Model::unguard();
        Table::configureUsing(fn(Table $table) => $table->defaultNumberLocale('nl'));
        CreateAction::configureUsing(fn(CreateAction $createAction) => $createAction->label('إضافة'));

        Radio::configureUsing(function (Radio $radio): void {
            $radio->inline()->inlineLabel()->translateLabel();
        });
        TextInput::configureUsing(function (TextInput $input): void {
            $input->translateLabel();
        });
        TextColumn::configureUsing(function (TextColumn $column): void {
            $column->translateLabel();
        });
        Textarea::configureUsing(function (Textarea $entry): void {$entry->translateLabel();});
        IconColumn::configureUsing(function (IconColumn $column): void {
            $column->translateLabel();
        });
        Select::configureUsing(function (Select $column): void {
            $column->translateLabel();
        });
        TextEntry::configureUsing(function (TextEntry $entry): void {$entry->translateLabel();});

        ImageEntry::configureUsing(function (ImageEntry $entry): void {$entry->translateLabel();});

        FilamentView::registerRenderHook(
            PanelsRenderHook::GLOBAL_SEARCH_BEFORE,
            fn (): string => Blade::render('@livewire(\'top-bar\')'),
        );
        FilamentColor::register([
            'Fuchsia' =>  Color::Fuchsia,
            'green' =>  Color::Green,
            'blue' =>  Color::Blue,
            'gray' =>  Color::Gray,
            'yellow' =>  Color::Yellow,
            'rose' => Color::Rose,
        ]);

    }
}
