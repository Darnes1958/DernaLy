<div class="grid grid-cols-12 py-12">
    <div class="col-span-4 ">
        <img  src="{{ asset('images/'.$image) }}"  style="width: 72px; height: 96px;" />
    </div>
    <div class="col-span-4 ">
        <img  src="{{ asset('images/'.$image2) }}"  style="width: 72px; height: 96px;" />
    </div>
    <div class="col-span-2">
        <h2 class="text-4xl font-extrabold mb-2">{{$name}}</h2>
        <p class="text-lg text-green-700">{{$link}}</p>
    </div>
    <div class="col-span-2 ">
        <img  src="{{ asset('images/'.$image3) }}"  style="width: 48px; height: 48px;" />
    </div>

</div>
