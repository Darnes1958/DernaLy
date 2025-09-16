<?php

namespace App\Filament\Clusters\Aljabel\Pages;

use App\Filament\Clusters\Aljabel\AljabelCluster;
use App\Filament\Clusters\Translations\TranslationsCluster;
use App\Models\Aljabel;
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

class ModifyAljabelsNames extends Page implements HasForms,HasTable
{
    use InteractsWithForms,InteractsWithTable;
    protected string $view = 'filament.clusters.aljabel.pages.modify-aljabels-names';
    protected static string | BackedEnum | null $navigationIcon=Heroicon::UserGroup;

    protected static ?string $cluster = AljabelCluster::class;
    protected static ?int $navigationSort=2;
    protected static ?string $navigationLabel='الترجمة وتصحيح الاسماء';

    public function Do($oldName,$rec,$data)
    {
        $vics=Aljabel::where('Name1->ar',$oldName)->orWhere('Name2->ar',$oldName)->
        orWhere('Name3->ar',$oldName)->orWhere('Name4->ar',$oldName)->get();
        foreach ($vics  as $vic){
            if ($vic->Name1==$oldName){
                $vic->Name1=$rec;
            }
            if ($vic->Name2==$oldName){
                $vic->Name2=$rec;
            }
            if ($vic->Name3==$oldName){
                $vic->Name3=$rec;
            }
            if ($vic->Name4==$oldName){
                $vic->Name4=$rec;

            }
            $fullNameAr=$vic->Name1.' '.$vic->Name2.' '.$vic->Name3.' '.$vic->Name4;
            $fullNameEn=$vic->getTranslation('Name1','en').' '.$vic->getTranslation('Name2','en').' '.
                $vic->getTranslation('Name3','en').' '.$vic->getTranslation('Name4','en');

            $fullName = [
                'ar' => $fullNameAr,
                'en' => $fullNameEn
            ];
            $vic->FullName=$fullName;

            $vic->save();
        }

    }



    public function table(Table $table): Table
    {
        return $table
            ->query(function (){
                return Aljabel::query();
            })
            ->columns([
                TextColumn::make('Name1')
                    ->description(function (Model $record){
                        return $record->getTranslation('Name1','en');
                    })
                    ->action(
                        Action::make('Updname1')
                            ->fillForm(fn(Model $record): array=>[
                                'nameAr'=>$record->Name1,'nameEn'=>$record->getTranslation('Name1','en'),
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
                                'nameAr'=>$record->Name2,'nameEn'=>$record->getTranslation('Name2','en'),
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
                        return $record->getTranslation('Name2','en');
                    }),
                TextColumn::make('Name3')
                    ->searchable()
                    ->action(
                        Action::make('Updname3')
                            ->fillForm(fn(Model $record): array=>[
                                'nameAr'=>$record->Name3,'nameEn'=>$record->getTranslation('Name3','en'),
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
                        return $record->getTranslation('Name3','en');
                    }),
                TextColumn::make('Name4')
                    ->searchable()
                    ->action(
                        Action::make('Updname4')
                            ->fillForm(fn(Model $record): array=>[
                                'nameAr'=>$record->Name4,'nameEn'=>$record->getTranslation('Name4','en'),
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
                        return $record->getTranslation('Name4','en');
                    }),
                TextColumn::make('FullName')
                    ->description(function (Model $record){
                        return $record->getTranslation('FullName','en');
                    }),


            ]);
    }
}
