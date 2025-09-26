<?php

namespace App\Filament\Clusters\Blog\Resources\Riches\Pages;

use App\Filament\Clusters\Blog\Resources\Riches\RichResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRiches extends ListRecords
{
    protected static string $resource = RichResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
