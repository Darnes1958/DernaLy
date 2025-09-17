<?php

namespace App\Filament\Clusters\Aljabel\Resources\Aljabels\Schemas;

use App\Models\Aljabel;
use App\Models\BigFamily;
use App\Models\Victim;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AljabelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('Name1')
                    ->required(),
                TextInput::make('Name2')
                    ->required(),
                TextInput::make('Name3'),
                TextInput::make('Name4') ,
                TextInput::make('otherName'),
                Hidden::make('FullName'),
                Select::make('familyshow_id')
                    ->label('العائلة')
                    ->relationship('Familyshow','name')
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required(),
                        Select::make('bigfamily_id')
                            ->searchable()
                            ->required()
                            ->options(BigFamily::all()->pluck('name','id'))
                            ->preload()
                            ->label('القبيلة'),
                        Hidden::make('nation')->default('ليبيا'),
                        Hidden::make('country_id')
                            ->default(1)
                    ])
                    ->live()
                    ->preload()
                    ->required(),
                Select::make('place_id')
                    ->label('مكان الوفاة')
                    ->relationship('Place','name')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->label('إسم المنطقة أو الحي'),
                        Select::make('city_id')
                            ->relationship('City','name')
                            ->label('المدينة')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->label('اسم المدينة')
                                    ,
                                FileUpload::make('image')
                                    ->multiple()
                                    ->imageEditor()
                                    ->directory('form-cities'),
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->label('اسم المدينة')
                                    ->maxLength(255),
                                FileUpload::make('image')
                                    ->multiple()
                                    ->imageEditor()
                                    ->directory('form-cities'),

                            ])
                            ->required(),
                        FileUpload::make('image')
                            ->multiple()
                            ->imageEditor()
                            ->directory('form-places'),

                    ])
                    ->editOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->label('مكان الوفاة ')
                            ->maxLength(255),
                        Select::make('city_id')
                            ->relationship('City','name')
                            ->label('المدينة')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->label('اسم المدينة')
                                    ->maxLength(255),
                                FileUpload::make('image')
                                    ->multiple()
                                    ->imageEditor()
                                    ->directory('form-cities'),
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->label('اسم المدينة')
                                    ->maxLength(255),
                                FileUpload::make('image')
                                    ->multiple()
                                    ->imageEditor()
                                    ->directory('form-cities'),

                            ])
                            ->live()
                            ->required(),
                        FileUpload::make('image')
                            ->multiple()
                            ->imageEditor()
                            ->directory('form-places'),

                    ])
                    ->required(),

                Radio::make('sex')
                    ->label('الجنس')
                    ->inline()
                    ->default(0)
                    ->columnSpan(2)
                    ->live()

                    ->options([
                        0 => 'ذكر',
                        1 => 'أنثى',
                    ]),

                TextInput::make('year')
                    ->numeric(),


                Select::make('wife_id')
                    ->label('زوج')
                    ->relationship('wife','FullName', fn (Builder $query) => $query
                        ->where('sex',0))
                    ->searchable()
                    ->reactive()
                    ->preload()
                    ->visible(fn (Get $get) => $get('sex') == 0),


                Select::make('father_id')
                    ->label('والده')
                    ->relationship('hisFather','FullName', fn (Builder $query) => $query
                        ->where('sex',0))
                    ->searchable()
                    ->reactive()
                    ->preload(),

                Select::make('mother_id')
                    ->label('والدته')
                    ->relationship('hisMother','FullName', fn (Builder $query) => $query
                        ->where('sex',1))
                    ->searchable()
                    ->reactive()
                    ->preload(),


                Select::make('grandfather_id')
                    ->label('جده')
                    ->options( Aljabel::query()

                        ->pluck('FullName', 'id'))
                    ->searchable()
                    ->live()

                    ->preload(),
                Select::make('grandmother_id')
                    ->label('جدته')
                    ->options( Aljabel::query()
                        ->pluck('FullName', 'id'))
                    ->searchable()
                    ->live()

                    ->preload(),



                TextInput::make('notes')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->multiple()
                    ->imageEditor()
                    ->directory('form-aljabel'),

                Hidden::make('user_id')
                    ->default(Auth::id()),
                Hidden::make('masterKey')
                    ->default(function (){
                        return Aljabel::max('masterKey')+1;
                    }),
            ])
            ->columns(4);
    }
}
