<?php

namespace App\Filament\Resources\Familyshows\Pages;

use App\Filament\Resources\Familyshows\FamilyshowResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFamilyshow extends EditRecord
{
    protected static string $resource = FamilyshowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
