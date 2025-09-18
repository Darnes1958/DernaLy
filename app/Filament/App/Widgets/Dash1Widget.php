<?php

namespace App\Filament\App\Widgets;

use App\Models\Contact;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\Widget;

class Dash1Widget extends Widget implements HasActions
{
    use InteractsWithActions;
    protected string $view = 'filament.app.widgets.dash1-widget';
    protected int | string | array $columnSpan='full';


}
