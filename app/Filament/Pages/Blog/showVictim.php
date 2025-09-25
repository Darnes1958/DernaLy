<?php

namespace App\Filament\Pages\Blog;

use App\Models\Victim;
use Filament\Pages\Page;

use Filament\Panel;
use Illuminate\Support\Facades\Route;

class showVictim extends Page
{

    protected string $view = 'filament.pages.blog.show-victim';
    protected static bool $shouldRegisterNavigation=false;
    public Victim $record;

    public function showMyModal()
    {
        $this->dispatch('open-modal', id: 'show-me');
    }
    public static function routes(Panel $panel): void
    {
        Route::get('/show-victim/{victim_id}', static::class)
            ->name('filament.pages.blog/show-victim');
    }

    public function mount($victim_id): void{

        $this->record=(new Victim)->FindOrFail(3);


    }
}
