<?php

namespace App\Filament\Pages;

use App\Models\Family;
use App\Models\Familyshow;
use App\Models\Street;
use App\Models\Victim;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;
use Filament\Schemas\View\Components\TextComponent;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use GPBMetadata\Google\Api\Log;
use Illuminate\Database\Eloquent\Builder;

class FamilyStatistic extends Page implements HasTable,HasForms
{
    use InteractsWithTable,InteractsWithForms;
    protected string $view = 'filament.pages.family-statistic';

    protected static ?int $navigationSort=10;

    public $family;
    public  $mothers,$grands,$sonOfmothers,$sonOfgrands,$wives,$victims,$husband;


    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('family')
                 ->options(Familyshow::all()->pluck('name', 'id'))
                 ->searchable()
                 ->preload()
                 ->live()
                 ->afterStateUpdated(function ($state){
                     if ($state) {$this->family=$state;}
                 }),

                Text::make(function (){
                    $this->mothers=Victim::where('familyshow_id',$this->family)->where('is_mother',1)->select('id')->get();
                    $this->victims=Victim::where('family_id','=',$this->family)->select('id')->get();
                    $this->mothers=Victim::where('familyshow_id',$this->family)->where('is_mother',1)->select('id')->get();
                    $this->husband=Victim::where('familyshow_id',$this->family)->where('wife_id','!=',null)->select('id')->get();
                    $this->sonOfmothers=Victim::whereIn('mother_id',$this->mothers)->where('familyshow_id','!=',$this->family)->select('id')->get();
                    $this->grands=Victim::query()
                        ->where('familyshow_id',$this->family)
                        ->where('is_grandmother',1)->orWhere('is_grandfather')->select('id')->get();
                    $this->sonOfgrands=Victim::query()
                        ->where('familyshow_id',$this->family)
                        ->wherein('grandmother_id',$this->grands)
                        ->orWhereIn('grandfather_id',$this->grands)
                        ->whereNotIn('id',$this->sonOfmothers)
                        ->select('id')
                        ->get();


                    $this->wives=Victim::query()
                        ->where('familyshow_id','!=',$this->family)
                        ->where(function ($q) {
                            $q->where(function ($query) {return $query->where('is_mother',1)->whereIn('id',$this->victims);})
                                ->orWhereIn('husband_id',$this->husband);
                        })
                        ->select('id')
                        ->get();


                    $v1=Victim::where('familyshow_id',$this->family)->count();
                       $v2=Victim::whereIn('mother_id',$this->mothers)->where('familyshow_id','!=',$this->family)->count();
                           $v3=Victim::query()
                                ->where('familyshow_id',$this->family)
                                ->wherein('grandmother_id',$this->grands)
                                ->orWhereIn('grandfather_id',$this->grands)
                                ->whereNotIn('id',$this->sonOfmothers)->count();
                               $v4=Victim::query()
                                ->where('familyshow_id','!=',$this->family)
                                ->where(function ($q) {
                                    $q->where(function ($query) {return $query->where('is_mother',1)->whereIn('id',$this->victims);})
                                        ->orWhereIn('husband_id',$this->husband);
                                })->count();

                       return $v1+$v2+$v3+$v4;

                }),

            ])
            ->columns(4);
    }

    public function table(Table $table): Table
    {


        return $table
            ->query(function (){
                $this->victims=Victim::where('family_id','=',$this->family)->select('id')->get();
                $this->mothers=Victim::where('familyshow_id',$this->family)->where('is_mother',1)->select('id')->get();
                $this->husband=Victim::where('familyshow_id',$this->family)->where('wife_id','!=',null)->select('id')->get();
                $this->sonOfmothers=Victim::whereIn('mother_id',$this->mothers)->where('familyshow_id','!=',$this->family)->select('id')->get();
                $this->grands=Victim::query()
                    ->where('familyshow_id',$this->family)
                    ->where('is_grandmother',1)->orWhere('is_grandfather')->select('id')->get();
                $this->sonOfgrands=Victim::query()
                    ->where('familyshow_id',$this->family)
                    ->wherein('grandmother_id',$this->grands)
                    ->orWhereIn('grandfather_id',$this->grands)
                    ->whereNotIn('id',$this->sonOfmothers)
                    ->select('id')
                    ->get();


                $this->wives=Victim::query()
                    ->where('familyshow_id','!=',$this->family)
                    ->where(function ($q) {
                        $q->where(function ($query) {return $query->where('is_mother',1)->whereIn('id',$this->victims);})
                          ->orWhereIn('husband_id',$this->husband);
                    })
                    ->select('id')
                    ->get();

                return Street:: query()
                ->whereIn('id',Victim::where('familyshow_id', $this->family)->select('street_id')->distinct())  ;
            } )
            ->columns([
                TextColumn::make('StrNameJs')
                    ->color('blue')
                    ->searchable()
                    ->label(''),
                TextColumn::make('victim_count')
                    ->color('warning')
                    ->summarize(Sum::make())
                    ->label('')
                    ->counts(['Victim' => fn (Builder $query) => $query->where('familyshow_id', $this->family),]),
                TextColumn::make('wives')
                    ->label('الزوجات')
                    ->state(function (Street $record){

                        return Victim::whereIn('id', $this->wives)->where('street_id',$record->id)->count();
                    })
                    ->summarize(Summarizer::make()

                        ->using(function () {
                            return Victim::whereIn('id', $this->wives)->count();
                        })
                    )
                    ->color('warning'),

                TextColumn::make('sonOfmothers')
                    ->label('ابناء الأمهات')
                    ->state(function (Street $record){

                        return Victim::whereIn('id', $this->sonOfmothers)->where('street_id',$record->id)->count();
                    })
                    ->summarize(Summarizer::make()

                        ->using(function () {
                            return Victim::whereIn('id', $this->sonOfmothers)->count();
                        })
                    )
                    ->color('warning'),
                TextColumn::make('sonOfgrands')
                    ->label('الأحفاد')
                    ->state(function (Street $record){

                        return Victim::whereIn('id', $this->sonOfgrands)->where('street_id',$record->id)->count();
                    })
                    ->summarize(Summarizer::make()

                        ->using(function () {
                            return Victim::whereIn('id', $this->sonOfgrands)->count();
                        })
                    )
                    ->color('warning'),




            ]);
    }
}
