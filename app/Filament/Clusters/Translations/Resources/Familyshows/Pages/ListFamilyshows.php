<?php

namespace App\Filament\Clusters\Translations\Resources\Familyshows\Pages;

use App\Filament\Clusters\Translations\Resources\Familyshows\FamilyshowResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFamilyshows extends ListRecords
{
    protected static string $resource = FamilyshowResource::class;
protected ?string $heading='العائلات';
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
