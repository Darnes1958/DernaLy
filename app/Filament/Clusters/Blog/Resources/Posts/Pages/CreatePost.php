<?php

namespace App\Filament\Clusters\Blog\Resources\Posts\Pages;

use App\Filament\Clusters\Blog\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;
}
