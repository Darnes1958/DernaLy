<?php

namespace App\Filament\Resources\Familyshows\Pages;

use App\Filament\Resources\Familyshows\FamilyshowResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFamilyshows extends ListRecords
{
    protected static string $resource = FamilyshowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
