<div class="grid grid-cols-12 gap-4">
    <div class="col-span-4 ">
        <h1 class="text-4xl font-extrabold ">{{$heading}}</h1>
        <p class="text-lg text-green-700">{{$subheading}}</p>
    </div>
    <div class="col-span-4 ">
            {{\Filament\Forms\Components\RichEditor\RichContentRenderer::make($details)}}
    </div>

    <div class="col-span-4 ">
        <img  src="{{ asset('images/'.$image) }}"  style="width: 96px; height: 96px;" />
    </div>


</div>
