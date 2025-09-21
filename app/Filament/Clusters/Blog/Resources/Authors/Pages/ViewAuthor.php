<?php

namespace App\Filament\Clusters\Blog\Resources\Authors\Pages;

use App\Filament\Clusters\Blog\Resources\Authors\AuthorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAuthor extends ViewRecord
{
    protected static string $resource = AuthorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
