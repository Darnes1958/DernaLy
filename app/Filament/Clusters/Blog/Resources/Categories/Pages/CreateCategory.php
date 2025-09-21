<?php

namespace App\Filament\Clusters\Blog\Resources\Categories\Pages;

use App\Filament\Clusters\Blog\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
