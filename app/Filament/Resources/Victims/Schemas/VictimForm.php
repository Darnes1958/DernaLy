<?php

namespace App\Filament\Resources\Victims\Schemas;

use App\Enums\jobType;
use App\Enums\qualyType;
use App\Models\BigFamily;
use App\Models\Country;
use App\Models\Job;
use App\Models\Qualification;
use App\Models\Victim;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VictimForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Toggle::make('is_father')->label('اب'),
                Toggle::make('is_mother')->label('ام'),
                Toggle::make('is_grandfather')->label('جد'),
                Toggle::make('is_grandmother')->label('جدة'),
                TextInput::make('Name1')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set,$state){
                        $name = [
                            'ar' => $state,
                            'en' => Str::ascii($state, 'ar')
                        ];
                        $set('Name1Js',$name);
                    })
                    ->required(),
                TextInput::make('Name2')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set,$state){
                        $name = [
                            'ar' => $state,
                            'en' => Str::ascii($state, 'ar')
                        ];
                        $set('Name2Js',$name);
                    })

                    ->required(),
                TextInput::make('Name3')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set,$state){
                        if ($state) {
                            $name = [
                                'ar' => $state,
                                'en' => Str::ascii($state, 'ar')
                            ];
                            $set('Name3Js',$name);} else $set('Name3Js','');
                    })  ,
                TextInput::make('Name4')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set,$state){
                        if ($state) {
                        $name = [
                            'ar' => $state,
                            'en' => Str::ascii($state, 'ar')
                        ];
                        $set('Name4Js',$name);} else $set('Name4Js','');
                    })  ,
                TextInput::make('otherName')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set,$state){
                        $name = [
                            'ar' => $state,
                            'en' => Str::ascii($state, 'ar')
                        ];
                        $set('otherNameJs',$name);
                    })   ,
                Hidden::make('FullName'),

                Hidden::make('Name1Js'),

                Hidden::make('Name2Js'),

                Hidden::make('Name3Js'),

                Hidden::make('Name4Js'),

                Hidden::make('otherNameJs'),

                Hidden::make('FullNameJs'),

                Select::make('family_id')
                    ->label('العائلة')
                    ->relationship('Family','FamName')
                    ->searchable()
                    ->reactive()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('FamName')
                            ->required()
                            ->label('اسم العائلة')
                            ->maxLength(255),
                        Select::make('familyshow_id')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->label('اسم ')
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set  $set,$state){
                                        $name = [
                                            'ar' => $state,
                                            'en' => Str::ascii($state, 'ar')
                                        ];
                                        $set('nameJs',$name);
                                    })

                                    ->required(),
                                Select::make('bigfamily_id')
                                    ->searchable()
                                    ->required()
                                    ->options(BigFamily::all()->pluck('name','id'))
                                    ->preload()
                                    ->label('القبيلة'),
                                Hidden::make('nameJs'),
                                Select::make('country_id')
                                    ->searchable()
                                    ->required()
                                    ->options(Country::all()->pluck('name','id'))
                                    ->live()
                                    ->afterStateUpdated(function (Set $set,$state){
                                        $set('nation',Country::find($state)->name);
                                    })
                                    ->preload()
                                    ->live()
                                    ->afterStateUpdated(function (Set  $set,$state){
                                        $name = [
                                            'ar' => $state,
                                            'en' => Str::ascii($state, 'ar')
                                        ];
                                        $set('nameJs',$name);
                                    })
                                    ->label('الدولة'),

                                Hidden::make('nation')


                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->label('اسم ')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set  $set,$state){
                                        $name = [
                                            'ar' => $state,
                                            'en' => Str::ascii($state, 'ar')
                                        ];
                                        $set('nameJs',$name);
                                    })

                                    ->maxLength(255)
                                    ->required(),
                                Select::make('bigfamily_id')
                                    ->searchable()
                                    ->options(BigFamily::all()->pluck('name','id'))
                                    ->required()
                                    ->preload()
                                    ->label('القبيلة'),
                                Select::make('country_id')
                                    ->searchable()
                                    ->required()
                                    ->options(Country::all()->pluck('name','id'))
                                    ->live()
                                    ->afterStateUpdated(function (Set $set,$state){
                                        $set('nation',Country::find($state)->name);
                                    })
                                    ->preload()
                                    ->label('الدولة'),
                                Hidden::make('nameJs'),
                                Hidden::make('nation'),
                            ])
                            ->relationship('Familyshow','name')
                            ->label('العائلة الكبري FamilyShow'),
                        Select::make('tribe_id')
                            ->relationship('Tribe','TriName')
                            ->label('القبيلة')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('TriName')
                                    ->required()
                                    ->label('اسم القبيلة')
                                    ->maxLength(255)
                                    ->required(),
                            ])
                            ->reactive()
                            ->required(),

                    ])
                    ->editOptionForm([
                        TextInput::make('FamName')
                            ->required()
                            ->label('اسم العائلة')
                            ->maxLength(255),
                        Select::make('tribe_id')
                            ->relationship('Tribe','TriName')
                            ->label('القبيلة')
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->required(),
                    ])
                    ->required(),
                Select::make('familyshow_id')
                    ->label('العائلة الكبري')
                    ->relationship('Familyshow','name')
                    ->searchable()
                    ->reactive()
                    ->preload()
                    ->required(),

                Select::make('street_id')
                    ->label('الشارع')
                    ->relationship('Street','StrName')
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->createOptionForm([
                        TextInput::make('StrName')
                            ->required()
                            ->label('اسم الشارع')
                            ->maxLength(255),
                        Select::make('area_id')
                            ->relationship('Area','AreaName')
                            ->label('المحلة')
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->required(),
                    ])
                    ->editOptionForm([
                        TextInput::make('StrName')
                            ->required()
                            ->label('اسم الشارع')
                            ->maxLength(255),
                        Select::make('area_id')
                            ->relationship('Area','AreaName')
                            ->label('المحلة')
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->required(),
                    ])
                    ->required(),

                Radio::make('male')
                    ->label('الجنس')
                    ->inline()
                    ->default('ذكر')
                    ->columnSpan(2)
                    ->reactive()
                    ->afterStateUpdated(function(Set $set,$state) {
                        if ($state=='ذكر')  $set('is_mother',0);
                        else $set('is_father',0);})
                    ->options([
                        'ذكر' => 'ذكر',
                        'أنثي' => 'أنثى',
                    ]),
                TextInput::make('year')
                    ->numeric(),
                Select::make('husband_id')
                    ->label('زوجة')
                    ->relationship('husband', 'FullName', fn (Builder $query) => $query
                        ->where('male','ذكر'))
                    ->searchable()
                    ->reactive()
                    ->preload()
                    ->visible(fn (Get $get) => $get('male') == 'أنثي'),

                Select::make('wife_id')
                    ->label('زوج')
                    ->relationship('wife','FullName', fn (Builder $query) => $query
                        ->where('male','أنثي'))
                    ->searchable()
                    ->reactive()
                    ->preload()
                    ->visible(fn (Get $get) => $get('male') == 'ذكر'),
                Select::make('wife2_id')
                    ->label('زوجة ثانية')
                    ->relationship('wife2','FullName', fn (Builder $query) => $query
                        ->where('male','أنثي'))
                    ->searchable()
                    ->reactive()
                    ->preload()
                    ->visible(fn (Get $get) => $get('male') == 'ذكر'),

                Select::make('father_id')
                    ->label('والده')
                    ->relationship('hisFather','FullName', fn (Builder $query) => $query
                        ->where('male','ذكر'))
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $rec=Victim::where('id',$state)->first();
                        if ($rec) {
                            $set('Name2', $rec->Name1);
                            $set('Name3', $rec->Name2);
                            $set('Name4', $rec->Name4);
                            $set('family_id', $rec->family_id);
                            $set('street_id', $rec->street_id);
                            if ($rec->wife_id) $set('mother_id', $rec->wife_id);
                        }
                    })
                    ->preload(),

                Select::make('mother_id')
                    ->label('والدته')
                    ->relationship('hisMother','FullName', fn (Builder $query) => $query
                        ->where('male','أنثي'))
                    ->searchable()
                    ->reactive()
                    ->preload(),
                Toggle::make('has_more')
                    ->label('لديها اخوة غير أشقاء')
                    ->visible(fn(Get $get)=>$get('is_mother')==1),

                Select::make('grandfather_id')
                    ->label('جده')
                    ->options( Victim::query()
                        ->where('is_grandfather',1)
                        ->pluck('FullName', 'id'))
                    ->searchable()
                    ->live()

                    ->preload(),
                Select::make('grandmother_id')
                    ->label('جدته')
                    ->options( Victim::query()
                        ->where('is_grandmother',1)
                        ->pluck('FullName', 'id'))
                    ->searchable()
                    ->live()

                    ->preload(),



                Select::make('qualification_id')
                    ->options(Qualification::all()->pluck('name','id'))
                    ->label('المؤهل')
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->label('المؤهل')
                            ->maxLength(255),
                        Select::make('qualyType')
                            ->label('التصنيف')
                            ->searchable()
                            ->options(qualyType::class)
                    ])
                    ->createOptionUsing(function (array $data): int {
                        return Qualification::create($data)->getKey();
                    })
                    ->fillEditOptionActionFormUsing(function (Victim $record){
                        $q=Qualification::find($record->id);
                        if ($q)
                            return Qualification::find($record->id)->toArray();  else return [];
                    })
                    ->editOptionForm([
                        TextInput::make('name')
                            ->label('المؤهل')
                            ->maxLength(255),
                        Select::make('qualyType')
                            ->label('التصنيف')
                            ->searchable()
                            ->options(qualyType::class)
                    ])
                    ->searchable()
                    ->preload(),
                Select::make('job_id')
                    ->options(Job::all()->pluck('name','id'))
                    ->label('المهنة')
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->label('الوظيفة')
                            ->maxLength(255),
                        Select::make('jobType')
                            ->label('التصنيف')
                            ->searchable()
                            ->options(jobType::class)
                    ])
                    ->createOptionUsing(function (array $data): int {
                        return Job::create($data)->getKey();
                    })
                    ->fillEditOptionActionFormUsing(function (Victim $record){
                        $job=Job::find($record->id);
                        if ($job)
                            return $job->toArray(); else return [];
                    })
                    ->editOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->label('الوظيفة')
                            ->maxLength(255),
                        Select::make('jobType')
                            ->label('التصنيف')
                            ->searchable()
                            ->options(jobType::class)
                    ])
                    ->searchable()
                    ->preload(),

                Textarea::make('notes'),

                TextInput::make('fromwho')->default('المنظومة'),
                Toggle::make('inWork'),
                Toggle::make('inSave'),
                Toggle::make('guests'),
                Textarea::make('image2'),

                Hidden::make('user_id')
                    ->default(Auth::id()),
                Hidden::make('masterKey')
                    ->default(function (){
                        return Victim::max('masterKey')+1;
                    }),

            ])->columns(4);
    }
}
