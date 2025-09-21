<?php

namespace App\Filament\Clusters\Blog\Resources\Authors;

use App\Filament\Clusters\Blog\BlogCluster;
use App\Filament\Clusters\Blog\Resources\Authors\Pages\CreateAuthor;
use App\Filament\Clusters\Blog\Resources\Authors\Pages\EditAuthor;
use App\Filament\Clusters\Blog\Resources\Authors\Pages\ListAuthors;
use App\Filament\Clusters\Blog\Resources\Authors\Pages\ViewAuthor;
use App\Filament\Clusters\Blog\Resources\Authors\Schemas\AuthorForm;
use App\Filament\Clusters\Blog\Resources\Authors\Schemas\AuthorInfolist;
use App\Filament\Clusters\Blog\Resources\Authors\Tables\AuthorsTable;
use App\Models\Author;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = BlogCluster::class;

    public static function form(Schema $schema): Schema
    {
        return AuthorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AuthorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AuthorsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAuthors::route('/'),
            'create' => CreateAuthor::route('/create'),
            'view' => ViewAuthor::route('/{record}'),
            'edit' => EditAuthor::route('/{record}/edit'),
        ];
    }
}
