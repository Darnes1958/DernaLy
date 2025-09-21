<?php

namespace App\Filament\Clusters\Blog\Resources\Authors\Pages;

use App\Filament\Clusters\Blog\Resources\Authors\AuthorResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAuthor extends CreateRecord
{
    protected static string $resource = AuthorResource::class;
}
