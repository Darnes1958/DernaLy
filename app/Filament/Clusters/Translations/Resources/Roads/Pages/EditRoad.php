<?php

namespace App\Filament\Clusters\Translations\Resources\Roads\Pages;

use App\Filament\Clusters\Translations\Resources\Roads\RoadResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRoad extends EditRecord
{
    protected static string $resource = RoadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
