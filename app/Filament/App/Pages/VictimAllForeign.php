<?php

namespace App\Filament\App\Pages;

use App\Enums\jobType;
use App\Enums\qualyType;

use App\Livewire\Traits\PublicTrait;
use App\Models\Country;
use App\Models\Family;
use App\Models\Familyshow;
use App\Models\Job;

use App\Models\Qualification;
use App\Models\Street;
use App\Models\Talent;
use App\Models\VicTalent;
use App\Models\Victim;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\MaxWidth;

use Filament\Support\Enums\TextSize;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

use Stichoza\GoogleTranslate\GoogleTranslate;
use Transliterator;


class VictimAllForeign extends Page implements HasForms,HasTable
{
    use PublicTrait;

    use InteractsWithForms,InteractsWithTable;
    protected string $view = 'filament.app.pages.victim-all-foreign';


    public static function getNavigationLabel(): string
    {
        return __('Inquiry and research (foreign)');
    }

    protected static string | \BackedEnum | null $navigationIcon = Heroicon::MagnifyingGlass;
    protected ?string $heading='';
    public function getTitle(): string|Htmlable
    {
        return __('Inquiry and research (foreign)');
    }
    protected static ?string $title='استفسار وبحث (أجانب)';
    #[On('take_lang')]
    public function take_lang($lang)
    {
        app()->setLocale($lang);
    }


    public $familyList;
    public $familyshow_id;
    public $street_id=null;
    static $ser=0;

    public function mount(): void
    {
       $this->familyList=Familyshow::where('country_id','!=',1)->pluck('id');
        if (session()->has('lang_code')) {
            app()->setLocale(session()->get('lang_code'));
        }

    }
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('familyshow_id')
                    ->hiddenLabel()
                    ->prefix(__('Family'))
                    ->options(function () {
                        return Familyshow::query()->whereIn('id',$this->familyList)
                            ->orderBy('name')->pluck('nameJs', 'id');
                    })
                    ->preload()
                    ->live()
                    ->searchable()
                    ->columnSpan(2)
                    ->afterStateUpdated(function ($state){
                        $this->familyshow_id=$state;
                    }),
                Select::make('street_id')
                    ->hiddenLabel()
                    ->prefix(__('Address'))
                    ->options(Street::all()->pluck('StrNameJs','id'))
                    ->preload()
                    ->live()
                    ->searchable()
                    ->columnSpan(2)
                    ->afterStateUpdated(function ($state){


                        $this->street_id=$state;
                    }),
                Action::make('printBigFamily')
                    ->label('pdf للعائلة')
                   ->visible(fn(): bool => $this->familyshow_id!=NULL)

                    ->color('success')
                    ->icon('heroicon-m-printer')
                    ->action(function (){

                        \Spatie\LaravelPdf\Facades\Pdf::view('PDF.PdfAllVictims_5',
                            [
                                'familyshow_id' => $this->familyshow_id,'street_id' => $this->street_id,'str_fam'=>'fam'])
                            ->footerView('PDF.footer')

                            ->save(public_path().'/bigFamily.pdf');

                        return Response::download(public_path().'/bigFamily.pdf',
                            'filename.pdf', self::ret_spatie_header());

                    }),




            ])->columns(8);
    }

    public function table(Table $table): Table
    {
        return $table
        ->extraAttributes(['class'=>'table_head_amber'])
        ->query(function (){
        return
            Victim::query()
                ->whereIn('familyshow_id',$this->familyList)
                ->when($this->familyshow_id ,function($q){
                    $q->where('familyshow_id',$this->familyshow_id);
                })
                ->when($this->street_id,function($q){
                    $q->where('street_id',$this->street_id);
                })
                ->orderBy('familyshow_id')
                ->orderBy('family_id')
                ->orderBy('masterKey');
    })
        ->paginationPageOptions([5,10,25,50,100])
        ->searchPlaceholder(__('search by name , address or family'))
        ->searchDebounce('750ms')
         ->striped()
            ->columns([

                TextColumn::make('FullNameJs')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn (Victim $record): View => view(
                        'filament.app.pages.assist.full-data',
                        ['record' => $record],
                    ))
                    ->searchable(),
                TextColumn::make('year')
                    ->label('Birth Date'),
                TextColumn::make('Familyshow.nameJs')
                    ->label('Family')
                    ->sortable()
                    ->toggleable()
                    ->hidden(function (){return $this->familyshow_id !=null;})
                    ->searchable(),


                TextColumn::make('Street.StrNameJs')
                    ->label('Address')

                    ->toggleable()
                    ->sortable(),

                TextColumn::make('Job.name')
                    ->formatStateUsing(fn (Victim $record): View => view(
                        'filament.app.pages.assist.job-data',
                        ['record' => $record],
                    ))
                    ->toggleable(),
                TextColumn::make('VicTalent.Talent.nameJs')
                    ->description(fn (Victim $record): View => view(
                        'filament.app.pages.assist.talent-data',
                        ['record' => $record],
                    ))
                    ->label('Talent')


                    ->toggleable(),
                ImageColumn::make('image2')
                    ->toggleable()
                    ->imageSize(80)
                    ->stacked()
                    ->limit(3)

                    ->label('')
                    ->circular(),
            ])
            ->recordActions([
                Action::make('View Information')
                    ->label(__('View Card'))
                    ->modalHeading('')
                    ->modalWidth(Width::SevenExtraLarge)
                    ->icon('heroicon-s-eye')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel(__('back'))
                    ->schema([
                        Section::make()
                            ->schema([
                                Section::make()
                                    ->schema([
                                        TextEntry::make('FullNameJs')
                                            ->color(function (Victim $record){
                                                if ($record->male=='ذكر') return 'primary';  else return 'Fuchsia';})
                                            ->columnSpan(3)
                                            ->weight(FontWeight::ExtraBold)
                                            ->size(TextSize::Large)
                                            ->label(''),
                                        TextEntry::make('year')
                                            ->visible(function (Victim $record){return $record->year!=null;})
                                            ->inlineLabel()
                                            ->color('rose')
                                            ->label(__('year')),
                                        TextEntry::make('hisFather.FullName')
                                            ->visible(function (Victim $record){
                                                return $record->father_id;
                                            })
                                            ->color('info')
                                            ->label(__('his father'))
                                            ->size( TextSize::Large)

                                            ->columnSpanFull(),
                                        TextEntry::make('hisMother.FullName')
                                            ->visible(function (Victim $record){
                                                return $record->mother_id;
                                            })
                                            ->color('Fuchsia')
                                            ->label(__('his mother'))
                                            ->size(TextSize::Large)

                                            ->columnSpanFull(),

                                        TextEntry::make('wife.FullNameJs')
                                            ->visible(function (Victim $record){
                                                return $record->wife_id;
                                            })
                                            ->color('Fuchsia')
                                            ->label(__('his wife'))
                                            ->size(TextSize::Large)
                                            ->separator(',')
                                            ->columnSpanFull(),
                                        TextEntry::make('wife2.FullNameJs')
                                            ->visible(function (Victim $record){
                                                return $record->wife2_id;
                                            })
                                            ->color('Fuchsia')
                                            ->label(__('his second wife'))
                                            ->size(TextSize::Large)
                                            ->columnSpanFull(),
                                        TextEntry::make('husband.FullNameJs')
                                            ->visible(function (Victim $record){
                                                return $record->husband_id;
                                            })
                                            ->label(__('her husband'))
                                            ->badge()
                                            ->separator(',')
                                            ->columnSpanFull(),

                                        TextEntry::make('hisSons.Name1Js')
                                            ->state(function (Victim $record){
                                                $wname='';$i=0;
                                                if ($record->hisSons())
                                                    foreach ($record->hisSons as $son ) if (++$i==1) $wname=$son->Name1Js ;
                                                    else $wname =$wname.' , '.$son->Name1Js;
                                                return $wname;
                                            })

                                            ->visible(function (Victim $record){
                                                return $record->is_father;
                                            })
                                            ->badge()
                                            ->separator(',')
                                            ->label(__('his sons'))
                                            ->color(function( )  {
                                                self::$ser++;

                                                switch (self::$ser){
                                                    case 1: $c='success';break;
                                                    case 2: $c='info';break;
                                                    case 3: $c='yellow';break;
                                                    case 4: $c='rose';break;
                                                    case 5: $c='blue';break;
                                                    case 6: $c='Fuchsia';break;
                                                    default: $c='primary';break;
                                                }
                                                return $c;

                                            })
                                            ->columnSpanFull(),
                                        TextEntry::make('herSons.Name1Js')
                                            ->state(function (Victim $record){
                                                $wname='';$i=0;
                                                if ($record->herSons())
                                                    foreach ($record->herSons as $son ) if (++$i==1) $wname=$son->Name1Js ;
                                                    else $wname =$wname.' , '.$son->Name1Js;
                                                return $wname;
                                            })
                                            ->visible(function (Victim $record){
                                                return $record->is_mother;
                                            })
                                            ->color(function( )  {
                                                self::$ser++;

                                                switch (self::$ser){
                                                    case 1: $c='success';break;
                                                    case 2: $c='info';break;
                                                    case 3: $c='yellow';break;
                                                    case 4: $c='rose';break;
                                                    case 5: $c='blue';break;
                                                    case 6: $c='Fuchsia';break;
                                                    default: $c='primary';break;
                                                }
                                                return $c;

                                            })
                                            ->label(__('her sons'))
                                            ->badge()
                                            ->separator(',')
                                            ->columnSpanFull(),
                                        TextEntry::make('Familyshow.nameJs')
                                            ->color('info')
                                            ->label(__('Family')),
                                        TextEntry::make('Family.Tribe.TriNameJs')
                                            ->color('info')
                                            ->label('القبيلة'),
                                        TextEntry::make('Street.StrNameJs')
                                            ->color('info')
                                            ->label(__('Address')),
                                        TextEntry::make('Street.Area.AreaNameJs')
                                            ->color('info')
                                            ->label(__('Locality')),

                                        TextEntry::make('Job.nameJs')
                                            ->visible(function (Model $record){
                                                return $record->job_id;
                                            })
                                            ->color('info')
                                            ->label('الوظيفة'),
                                        TextEntry::make('VicTalent.Talent.nameJs')
                                            ->columnSpanFull()
                                            ->visible(function (Model $record){
                                                return VicTalent::where('victim_id',$record->id)->exists() ;
                                            })
                                            ->badge()
                                            ->separator(',')
                                            ->state(function (Victim $record){
                                                $wname='';$i=0;
                                                if ($record->VicTalent())
                                                    foreach ($record->Victalent as $talent ) if (++$i==1) $wname=$talent->Talent->nameJs ;
                                                    else $wname =$wname.' , '.$talent->Talent->nameJs;
                                                return $wname;
                                            })
                                            ->color('info')
                                            ->label('المواهب'),
                                        TextEntry::make('notesJs')
                                            ->visible(function (Model $record){
                                                return $record->notesJs;
                                            })
                                            ->label('')

                                    ])
                                    ->columns(4)
                                    ->columnSpan(2),

                                ImageEntry::make('image2')
                                    ->hiddenLabel()
                                    ->stacked()
                                    ->height(500)
                                    ->columnSpan(2)


                            ])->columns(4)
                    ])
                    ->slideOver(),

            ]);

    }
}
