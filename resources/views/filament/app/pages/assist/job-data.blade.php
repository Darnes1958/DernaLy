<div class="justify-center text-center">
    @if($record->Job)

        @if($record->Job->image)

            <img  src="{{ asset('images/'.$record->Job->image) }}"  style="width: 26px; height: 26px;" />
        @endif
            <p >{{$record->Job->name}}&nbsp;</p>
    @endif


</div>
