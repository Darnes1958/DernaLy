<div class="grid grid-cols-12 py-12 gap-4">
    <div class="col-span-4 ">
        <img  src="{{ asset('images/'.$image) }}" style="width: auto; height: 300pt; "  />
    </div>
    <div class="col-span-4 ">
        <img  src="{{ asset('images/'.$image2) }}" style="width: auto; height: 300pt; "  />
    </div>
    <div class="col-span-4">

        <div class="flex  gap-4">
            <div>
                <h2 class="text-2xl font-extrabold mb-2"> للكاتبة </h2>
                <h2 class="text-2xl font-extrabold mb-2">{{$name}}</h2>
            </div>
            <img
                src="{{  asset('images/'.$image3)}} "
                style="width:  96pt; height: 96pt"
            />

        </div>

        <a href="{{$link}}" class="text-lg text-green-700">{{$link}}</a>


    </div>

</div>
