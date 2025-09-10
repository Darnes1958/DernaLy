<?php

namespace App\Livewire;

use Filament\Widgets\Widget;

class CusCountWidget extends Widget
{
    protected string $view = 'livewire.cus-count-widget';
    protected int | string | array $columnSpan='full';
}
