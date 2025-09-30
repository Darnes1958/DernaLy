<div>
    <div class="flex w-full gap-4">
        <div class="w-10/12">
            <div class="fi-prose">
                {!! \Filament\Forms\Components\RichEditor\RichContentRenderer::make($theText)->customBlocks([
                        \App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock::class,
                        \App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\OneImage::class,
                        \App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\MarwaBlock::class,
                        \App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\LongAndImage::class,
                    ])->toHtml() !!}
            </div>
          
        </div>
        <div class="w-2/12">
            <figure class="w-full">
                <img class="h-auto max-w-full rounded-lg" src="{{ asset('images/'.$theImage) }}" >
                <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">{{$theLabel}}</figcaption>
            </figure>
        </div>
    </div>

</div>
