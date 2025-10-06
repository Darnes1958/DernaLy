<div>
    <div class="flex-none md:flex   gap-4">
        <div class="w-full md:w-{{$w1}}/12">
            @php if ($imgHeight!='auto') $imgHeight=$imgHeight.'pt' @endphp
            @php if ($imgWidth!='auto') $imgWidth=$imgWidth.'pt' @endphp
            <figure class="w-full">
                <img class=" rounded-lg" src="{{ asset('images/'.$theImage) }}" style="height: {{$imgHeight}}; width: {{$imgWidth}}">
                <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">{{$theLabel}}</figcaption>
            </figure>
        </div>

        <div class="w-full md:w-{{$w2}}/12">
            <div class="fi-prose">
                {!! \Filament\Forms\Components\RichEditor\RichContentRenderer::make($theText)->customBlocks([
                        \App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\OneImage::class,
                        \App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\LongAndImage::class,
                        \App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\ImageAndShort::class,
                    ])->toHtml() !!}
            </div>

        </div>
    </div>

</div>
