<?php

namespace App\Filament\Clusters\Translations\Resources\Areas\Pages;

use App\Filament\Clusters\Translations\Resources\Areas\AreaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewArea extends ViewRecord
{
    protected static string $resource = AreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
