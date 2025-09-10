<?php

namespace App\Filament\Resources\Roads\Pages;

use App\Filament\Resources\Roads\RoadResource;
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
