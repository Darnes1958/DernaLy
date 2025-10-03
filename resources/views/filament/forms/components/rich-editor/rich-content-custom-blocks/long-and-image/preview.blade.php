<div>
    <div class="flex w-full gap-4">
        <div class="w-8/12">
            {{$theText}}
        </div>
        <div class="w-4/12">
            <figure class="w-full">
                <img class="h-{{$imgHeight}} w-auto rounded-lg" src="{{ asset('images/'.$theImage) }}" >
                <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">{{$theLabel}}</figcaption>
            </figure>
        </div>

    </div>

</div>
