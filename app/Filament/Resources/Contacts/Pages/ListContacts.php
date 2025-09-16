<?php

namespace App\Filament\Resources\Contacts\Pages;

use App\Filament\Resources\Contacts\ContactResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

   public function getTabs(): array
   {
       return [
         Tab::make('all'),
         Tab::make('wait')->modifyQueryUsing(fn (Builder $query) => $query->where('status',0)),
         Tab::make('had seen')->modifyQueryUsing(fn (Builder $query) => $query->where('status',1)),
       ];
   }
}
