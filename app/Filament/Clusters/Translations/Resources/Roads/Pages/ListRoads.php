<?php

namespace App\Filament\Clusters\Translations\Resources\Roads\Pages;

use App\Filament\Clusters\Translations\Resources\Roads\RoadResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRoads extends ListRecords
{
    protected static string $resource = RoadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
