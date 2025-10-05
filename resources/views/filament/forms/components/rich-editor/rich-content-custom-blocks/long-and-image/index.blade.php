<div>
    <div class="flex w-full gap-4">
        <div class="w-{{$w1}}/12">
            <div class="fi-prose">
                {!! \Filament\Forms\Components\RichEditor\RichContentRenderer::make($theText)->customBlocks([
                        \App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock::class,
                        \App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\OneImage::class,
                        \App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\MarwaBlock::class,
                        \App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\LongAndImage::class,
                    ])->toHtml() !!}
            </div>

        </div>
        <div class="w-{{$w2}}/12">
            @php if ($imgHeight!='auto') $imgHeight=$imgHeight.'pt' @endphp
            @php if ($imgWidth!='auto') $imgWidth=$imgWidth.'pt' @endphp
            <figure class="w-full">
                <img class=" rounded-lg" src="{{ asset('images/'.$theImage) }}" style="height: {{$imgHeight}}; width: {{$imgWidth}}">
                <figcaption class="mt-2 text-sm  text-gray-500 dark:text-gray-400">{{$theLabel}}</figcaption>
            </figure>
        </div>
    </div>

</div>
