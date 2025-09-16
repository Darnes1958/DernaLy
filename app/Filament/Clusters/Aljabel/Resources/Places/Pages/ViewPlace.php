<?php

namespace App\Filament\Clusters\Aljabel\Resources\Places\Pages;

use App\Filament\Clusters\Aljabel\Resources\Places\PlaceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPlace extends ViewRecord
{
    protected static string $resource = PlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
