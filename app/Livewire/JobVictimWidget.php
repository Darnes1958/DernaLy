<?php

namespace App\Livewire;

use App\Livewire\Traits\PublicTrait;
use App\Models\Job;



use App\Models\Victim;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Response;
use Livewire\Attributes\On;
use Spatie\LaravelPdf\Enums\Format;

class JobVictimWidget extends BaseWidget
{
    use PublicTrait;
    protected int | string | array $columnSpan=4;
    protected static ?string $heading='';
    public $job_id = null;
    public $jobType=null ;
    public $title=null ;
    #[On('TakeJobType')]
    public function TakeJobType($jobType){
        $this->jobType=$jobType;
        $this->job_id=null;
        $this->title=Job::where('jobType',$jobType)->first()->jobType->name;
    }
    #[On('TakeJobId')]
    public function TakeJobId($job_id){
        $this->job_id=$job_id;
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $query=Victim::
                when($this->job_id,function ($q){
                    $q->where('job_id',$this->job_id);
                })
                    ->whereIn('job_id',Job::where('jobType',$this->jobType)->pluck('id'));
                return $query;
            })

            ->defaultPaginationPageOption(8)
            ->paginationPageOptions([5,8,20,50])
            ->emptyStateHeading('')
            ->columns([
                TextColumn::make('FullNameJs')
                    ->searchable()
                    ->label(''),
                ImageColumn::make('image2')
                    ->label('')
                    ->circular()
                    ->limit(1)
                    ->height(80),
            ])
            ;

    }
}
