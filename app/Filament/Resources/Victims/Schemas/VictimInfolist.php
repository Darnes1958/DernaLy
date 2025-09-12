<?php

namespace App\Filament\Resources\Victims\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VictimInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('Name1'),
                TextEntry::make('Name2'),
                TextEntry::make('Name3'),
                TextEntry::make('Name4'),
                TextEntry::make('otherName'),
                TextEntry::make('FullName'),
                TextEntry::make('family_id')
                    ->numeric(),
                TextEntry::make('familyshow_id')
                    ->numeric(),
                TextEntry::make('bait_id')
                    ->numeric(),
                TextEntry::make('street_id')
                    ->numeric(),
                TextEntry::make('male'),
                TextEntry::make('year')
                    ->numeric(),
                TextEntry::make('husband_id')
                    ->numeric(),
                TextEntry::make('wife_id')
                    ->numeric(),
                TextEntry::make('wife2_id')
                    ->numeric(),
                TextEntry::make('son_id')
                    ->numeric(),
                TextEntry::make('girl_id')
                    ->numeric(),
                TextEntry::make('mother_id')
                    ->numeric(),
                IconEntry::make('has_more')
                    ->boolean(),
                TextEntry::make('father_id')
                    ->numeric(),
                TextEntry::make('grandmother_id')
                    ->numeric(),
                TextEntry::make('grandfather_id')
                    ->numeric(),
                IconEntry::make('is_father')
                    ->boolean(),
                IconEntry::make('is_mother')
                    ->boolean(),
                IconEntry::make('is_grandfather')
                    ->boolean(),
                IconEntry::make('is_grandmother')
                    ->boolean(),
                IconEntry::make('is_great_grandfather')
                    ->boolean(),
                TextEntry::make('qualification_id')
                    ->numeric(),
                TextEntry::make('job_id')
                    ->numeric(),
                TextEntry::make('talent_id')
                    ->numeric(),
                TextEntry::make('mafkoden')
                    ->numeric(),
                TextEntry::make('tasreeh')
                    ->numeric(),
                TextEntry::make('bedon')
                    ->numeric(),
                TextEntry::make('dead')
                    ->numeric(),
                TextEntry::make('balag')
                    ->numeric(),
                TextEntry::make('fromwho'),
                IconEntry::make('inWork')
                    ->boolean(),
                IconEntry::make('inSave')
                    ->boolean(),
                IconEntry::make('guests')
                    ->boolean(),
                ImageEntry::make('image'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('masterKey')
                    ->numeric(),
                TextEntry::make('details'),
            ]);
    }
}
