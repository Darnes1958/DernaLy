<?php

namespace App\Filament\Clusters\Blog\Resources\Riches\Pages;

use App\Filament\Clusters\Blog\Resources\Riches\RichResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRich extends EditRecord
{
    protected static string $resource = RichResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
