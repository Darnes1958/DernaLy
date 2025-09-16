<?php

namespace App\Filament\Clusters\Aljabel\Resources\Aljabels\Pages;

use App\Filament\Clusters\Aljabel\Resources\Aljabels\AljabelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAljabel extends ViewRecord
{
    protected static string $resource = AljabelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
