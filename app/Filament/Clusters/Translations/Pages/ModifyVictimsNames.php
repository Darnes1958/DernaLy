<?php

namespace App\Filament\Clusters\Translations\Pages;

use App\Filament\Clusters\Translations\TranslationsCluster;
use App\Models\Victim;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use function Pest\Laravel\get;

class ModifyVictimsNames extends Page implements HasForms,HasTable
{
    use InteractsWithForms,InteractsWithTable;
    protected string $view = 'filament.clusters.translations.pages.modify-victims-names';
    protected static string | BackedEnum | null $navigationIcon=Heroicon::UserGroup;

    protected static ?string $cluster = TranslationsCluster::class;

    public function Do($oldName,$rec,$data)
    {
        $vics=Victim::where('Name1',$oldName)->orWhere('Name2',$oldName)->
        orWhere('Name3',$oldName)->orWhere('Name4',$oldName)->get();
        foreach ($vics  as $vic){
            if ($vic->Name1==$oldName){
                $vic->Name1=$data['nameAr'];
                $vic->Name1Js=$rec;
            }
            if ($vic->Name2==$oldName){
                $vic->Name2=$data['nameAr'];
                $vic->Name2Js=$rec;
            }
            if ($vic->Name3==$oldName){
                $vic->Name3=$data['nameAr'];
                $vic->Name3Js=$rec;
            }
            if ($vic->Name4==$oldName){
                $vic->Name4=$data['nameAr'];
                $vic->Name4Js=$rec;

            }
            $fullNameAr=$vic->Name1.' '.$vic->Name2.' '.$vic->Name3.' '.$vic->Name4;
            $fullNameEn=$vic->getTranslation('Name1Js','en').' '.$vic->getTranslation('Name2Js','en').' '.
                $vic->getTranslation('Name3Js','en').' '.$vic->getTranslation('Name4Js','en');

            $fullNameJs = [
                'ar' => $fullNameAr,
                'en' => $fullNameEn
            ];
            $vic->FullName=$fullNameAr;
            $vic->FullNameJs=$fullNameJs;

            $vic->save();
        }

    }



    public function table(Table $table): Table
    {
        return $table
            ->query(function (){
                return Victim::query();
            })
            ->columns([
                TextColumn::make('Name1')
                    ->description(function (Model $record){
                        return $record->getTranslation('Name1Js','en');
                    })
                    ->action(
                        Action::make('Updname1')
                            ->fillForm(fn(Model $record): array=>[
                                'nameAr'=>$record->Name1,'nameEn'=>$record->getTranslation('Name1Js','en'),
                                'oldName'=>$record->Name1,
                            ])
                            ->schema([
                                TextInput::make('nameAr')->required(),
                                TextInput::make('nameEn')->required(),
                                Hidden::make('oldName')
                            ])
                            ->action(function (Model $record,array $data) {
                                $rec=['ar'=>$data['nameAr'],'en'=>$data['nameEn']];
                                $oldName=$data['oldName'];
                                $this->Do($oldName,$rec,$data);
                            })
                    )
                    ->searchable(),
                TextColumn::make('Name2')
                    ->action(
                        Action::make('Updname2')
                            ->fillForm(fn(Model $record): array=>[
                                'nameAr'=>$record->Name2,'nameEn'=>$record->getTranslation('Name2Js','en'),
                                'oldName'=>$record->Name2,
                            ])
                            ->schema([
                                TextInput::make('nameAr')->required(),
                                TextInput::make('nameEn')->required(),
                                Hidden::make('oldName')
                            ])
                            ->action(function (Model $record,array $data) {
                                $rec=['ar'=>$data['nameAr'],'en'=>$data['nameEn']];
                                $oldName=$data['oldName'];
                                $this->Do($oldName,$rec,$data);
                            })
                    )
                    ->searchable()
                    ->description(function (Model $record){
                        return $record->getTranslation('Name2Js','en');
                    }),
                TextColumn::make('Name3')
                    ->searchable()
                    ->action(
                        Action::make('Updname3')
                            ->fillForm(fn(Model $record): array=>[
                                'nameAr'=>$record->Name3,'nameEn'=>$record->getTranslation('Name3Js','en'),
                                'oldName'=>$record->Name3,
                            ])
                            ->schema([
                                TextInput::make('nameAr')->required(),
                                TextInput::make('nameEn')->required(),
                                Hidden::make('oldName')
                            ])
                            ->action(function (Model $record,array $data) {
                                $rec=['ar'=>$data['nameAr'],'en'=>$data['nameEn']];
                                $oldName=$data['oldName'];
                                $this->Do($oldName,$rec,$data);
                            })
                    )
                    ->description(function (Model $record){
                        return $record->getTranslation('Name3Js','en');
                    }),
                TextColumn::make('Name4')
                    ->searchable()
                    ->action(
                        Action::make('Updname4')
                            ->fillForm(fn(Model $record): array=>[
                                'nameAr'=>$record->Name4,'nameEn'=>$record->getTranslation('Name4Js','en'),
                                'oldName'=>$record->Name4,
                            ])
                            ->schema([
                                TextInput::make('nameAr')->required(),
                                TextInput::make('nameEn')->required(),
                                Hidden::make('oldName')
                            ])
                            ->action(function (Model $record,array $data) {
                                $rec=['ar'=>$data['nameAr'],'en'=>$data['nameEn']];
                                $oldName=$data['oldName'];
                                $this->Do($oldName,$rec,$data);
                            })
                    )
                    ->description(function (Model $record){
                        return $record->getTranslation('Name4Js','en');
                    }),
                TextColumn::make('FullName')
                    ->description(function (Model $record){
                        return $record->getTranslation('FullNameJs','en');
                    }),


            ]);
    }
}
