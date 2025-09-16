<?php

namespace App\Filament\Clusters\Aljabel\Resources\Places\Pages;

use App\Filament\Clusters\Aljabel\Resources\Places\PlaceResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPlace extends EditRecord
{
    protected static string $resource = PlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
