


    <div class="grid grid-cols-3  gap-4">
        @foreach($record->image as $img)
              <div>
                  <img src="{{asset('images/'.$img)}}" class="h-100  rounded-lg "  alt="">
              </div>


        @endforeach

    </div>


