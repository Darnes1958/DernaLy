<?php

namespace App\Filament\Resources\Victims\Pages;

use App\Filament\Resources\Victims\VictimResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVictim extends ViewRecord
{
    protected static string $resource = VictimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
