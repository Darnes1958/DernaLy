<?php

namespace App\Filament\Pages;

use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\MarwaBlock;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\OneImage;
use App\Models\Post;
use App\Models\Rich;
use App\Models\Street;
use App\Models\Victim;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Schemas\Schema;
use GPBMetadata\Google\Api\Log;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\On;


class customShowPost extends Page implements HasForms
{
    use InteractsWithForms;
    use InteractsWithActions;
    public $record;
    public $id;

protected ?string $heading='';

    public function openModal($text)
    {
        $rish=Rich::where('name',$text)->first();
        $this->id=$rish->richable->id;

        if ($rish->richable_type=='App\Models\Victim')
         $this->mountAction('viewVictim',['id'=>$this->id]);

        if ($rish->richable_type=='App\Models\Street')
            if (Street::find($this->id)->image)
            $this->mountAction('viewStreet',['id'=>$this->id]);

    }
    protected function getActions(): array
    {

        return [

                    Action::make('viewVictim')
                        ->label('')
                        ->color('white')
                        ->modalHeading(false)
                        ->modalCancelAction(false)
                        ->modalSubmitActionLabel('عودة')
                        ->modalContent(
                            function (array $arguments) {
                                return view('filament.pages.blog.full-data',['record'=>Victim::find($arguments['id'])]);
                            }
                        ),
            Action::make('viewStreet')
                ->label('')
                ->color('white')
                ->modalHeading(false)
                ->modalCancelAction(false)
                ->modalSubmitActionLabel('عودة')
                ->modalContent(
                    function (array $arguments) {

                        return view('filament.pages.blog.street-data',['record'=>Street::find($arguments['id'])]);

                    }
                ),

            ];

    }

    protected string $view = 'filament.pages.custom-show-post';

    protected static bool $shouldRegisterNavigation=false;

     public static function getSlug(?Panel $panel = null): string
     {
         return 'custom-show-post/{record}'; // {record} can be any name
     }


    public function mount($record) :void{

        $this->record = Post::find($record);

    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->model(Post::find($this->record->id))
            ->components([
                TextEntry::make('body')
                    ->hiddenLabel()
                    ->state(fn ($record): string =>
                    RichContentRenderer::make($record->body)
                        ->fileAttachmentsVisibility('private')
                        ->customBlocks([
                            HeroBlock::class,
                            MarwaBlock::class,
                            OneImage::class,
                        ],
                        )
                        ->mergeTags(['title'=> new  HtmlString('<span class="text-4xl">'.$this->record->title.'</span>')])
                        ->toHtml()
                    )
                    ->prose(),
            ]);
    }


}
