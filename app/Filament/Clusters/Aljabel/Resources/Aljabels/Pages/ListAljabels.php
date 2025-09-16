<?php

namespace App\Filament\Clusters\Aljabel\Resources\Aljabels\Pages;

use App\Filament\Clusters\Aljabel\Resources\Aljabels\AljabelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAljabels extends ListRecords
{
    protected static string $resource = AljabelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
