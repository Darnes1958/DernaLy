<?php

namespace App\Filament\Clusters\Aljabel\Resources\Places\Pages;

use App\Filament\Clusters\Aljabel\Resources\Places\PlaceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPlaces extends ListRecords
{
    protected static string $resource = PlaceResource::class;
    protected ?string $heading="بيانات الضحايا";

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
