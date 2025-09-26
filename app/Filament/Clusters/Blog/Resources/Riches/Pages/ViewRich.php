<?php

namespace App\Filament\Clusters\Blog\Resources\Riches\Pages;

use App\Filament\Clusters\Blog\Resources\Riches\RichResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRich extends ViewRecord
{
    protected static string $resource = RichResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
