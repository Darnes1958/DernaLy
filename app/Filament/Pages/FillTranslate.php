<?php

namespace App\Filament\Pages;

use App\Models\Area;
use App\Models\Country;
use App\Models\Familyshow;
use App\Models\Job;
use App\Models\Road;
use App\Models\Street;
use App\Models\Talent;
use App\Models\Victim;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Transliterator;

class FillTranslate extends Page implements HasForms
{
    use InteractsWithForms;
    protected string $view = 'filament.pages.fill-translate';

  //  protected static bool $shouldRegisterNavigation=false;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Action::make('trans')
                    ->action(function (){
                        $trans = Transliterator::create('Arabic-Latin; NFD; [:Nonspacing Mark:] Remove; NFC');
                        $victims= Victim::query()->get() ;

                        foreach ($victims as $victim){

                            $Name1 = [
                                'ar' => $victim->Name1,
                                'en' => Str::ascii($victim->Name1, 'ar')
                            ];
                            $Name2 = [
                                'ar' => $victim->Name2,
                                'en' => Str::ascii($victim->Name2, 'ar')
                            ];

                            $Name3 = [
                                'ar' => $victim->Name3,
                                'en' => Str::ascii($victim->Name3, 'ar')
                            ];

                            $Name4 = [
                                'ar' => $victim->Name4,
                                'en' => Str::ascii($victim->Name4, 'ar')
                            ];

                            $FullName = [
                                'ar' => $victim->FullName,
                                'en' => Str::ascii($victim->FullName, 'ar')
                            ];


                    if ($victim->otherName)
                        $otherName = [
                                'ar' => $victim->otherName,
                                'en' => Str::ascii($victim->otherName, 'ar')
                            ];

                            $victim->FullNameJs = $FullName;
                            $victim->Name1Js = $Name1;
                            $victim->Name2Js = $Name2;
                            $victim->Name3Js = $Name3;
                            $victim->Name4Js = $Name4;
                            if ($victim->otherName)      $victim->otherNameJs = $otherName;
                            $victim->save();
                            //   $victim->FullNameJs->setTranslations('name', $translations);
                            //     $victim->FullNameEn=$trans->transliterate($victim->FullName);
                            //   $victim->FullNameEn=$trans->transliterate($victim->FullName);
                            //     $victim->FullNameEn = Str::ascii($victim->FullName, 'ar');
                            //        $victim->FullNameEn = Str::slug($victim->FullName,' ', 'ar');
                            //   $victim->save();
                        }



                        //       $victims=Victim::query()->where('FullNameEn',null)->limit(100)->get();
                        //       foreach ($victims as $victim){
                        //           $victim->FullNameEn=Str::apiTranslate($victim->FullName,'en');
                        //           $victim->save();
                        //       }
                        //   $victims= Victim::query()->where('FullNameEn', 'like', '%' . 'Howa' . '%')->get();
                        //     foreach ($victims as $victim){
                        //         $victim->FullNameEn=str_replace('Howa','Howa ',$victim->FullNameEn);
                        //         $victim->save();
                        //     }


                    }),


                Action::make('countries')
                    ->action(function (){
                        $trans = Transliterator::create('Arabic-Latin; NFD; [:Nonspacing Mark:] Remove; NFC');
                        $countries= Country::query()->get() ;



                        foreach ($countries as $country){
                            $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
                            $tr->setSource('ar');
                            $tr->setTarget('en');
                            $name = [
                                'ar' => $country->name,
                                'en' =>  $tr->translate($country->name)
                            ];

                            $country->nameJs=$name;
                            $country->save();
                            //   $victim->FullNameJs->setTranslations('name', $translations);
                            //     $victim->FullNameEn=$trans->transliterate($victim->FullName);
                            //   $victim->FullNameEn=$trans->transliterate($victim->FullName);
                            //     $victim->FullNameEn = Str::ascii($victim->FullName, 'ar');
                            //        $victim->FullNameEn = Str::slug($victim->FullName,' ', 'ar');
                            //   $victim->save();
                        }



                        //       $victims=Victim::query()->where('FullNameEn',null)->limit(100)->get();
                        //       foreach ($victims as $victim){
                        //           $victim->FullNameEn=Str::apiTranslate($victim->FullName,'en');
                        //           $victim->save();
                        //       }
                        //   $victims= Victim::query()->where('FullNameEn', 'like', '%' . 'Howa' . '%')->get();
                        //     foreach ($victims as $victim){
                        //         $victim->FullNameEn=str_replace('Howa','Howa ',$victim->FullNameEn);
                        //         $victim->save();
                        //     }


                    }),
                Action::make('notes')
                    ->action(function (){

                        $jobs= Victim::query()->where('notes','!=',null)
                            ->where('notesJs',null)
                            ->limit(50)
                            ->get() ;



                        foreach ($jobs as $job) {
                            $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
                            $tr->setSource('ar');
                            $tr->setTarget('en');
                            $name = [
                                'ar' => $job->notes,
                                'en' => $tr->translate($job->notes)
                            ];
                            $job->notesJs = $name;
                            $job->save();
                        }
                    }),

                Action::make('jobs')
                    ->action(function (){

                        $jobs= Job::query()->get() ;



                        foreach ($jobs as $job) {
                            $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
                            $tr->setSource('ar');
                            $tr->setTarget('en');
                            $name = [
                                'ar' => $job->name,
                                'en' => $tr->translate($job->name)
                            ];
                            $job->nameJs = $name;
                            $job->save();
                        }
                    }),

                Action::make('talents')
                    ->action(function (){

                        $jobs= Talent::query()->get() ;



                        foreach ($jobs as $job) {
                            $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
                            $tr->setSource('ar');
                            $tr->setTarget('en');
                            $name = [
                                'ar' => $job->name,
                                'en' => $tr->translate($job->name)
                            ];
                            $job->nameJs = $name;
                            $job->save();
                        }
                    }),
                Action::make('roads')
                    ->action(function (){

                        $jobs= Road::query()->get() ;



                        foreach ($jobs as $job) {

                            $name = [
                                'ar' => $job->name,
                                'en' =>ucfirst(Str::ascii($job->name, 'ar'))

                            ];
                            $job->nameJs = $name;
                            $job->save();
                        }
                    }),
                Action::make('area')
                    ->action(function (){

                        $jobs= Area::query()->get() ;



                        foreach ($jobs as $job) {

                            $name = [
                                'ar' => $job->AreaName,
                                'en' =>ucfirst(Str::ascii($job->AreaName, 'ar'))
                            ];
                            $job->AreaNameJs = $name;
                            $job->save();
                        }
                    }),

                Action::make('family_address')
                    ->action(function (){
                        $families= Familyshow::query()->get() ;
                        foreach ($families as $family){
                            $name = [
                                'ar' => $family->name,
                                'en' =>ucfirst(Str::ascii($family->name, 'ar'))
                            ];
                            $family->nameJs = $name;
                            $family->save();
                        }
                        $streets= Street::query()->get() ;
                        foreach ($streets as $street){
                            $name = [
                                'ar' => $street->StrName,
                                'en' => ucfirst(Str::ascii($street->StrName, 'ar'))
                            ];
                            $street->StrNameJs = $name;
                            $street->save();
                        }


                    })


            ])->columns(12);
    }

}
