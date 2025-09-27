<div>
    @if($ImageHeight=='auto')
        <img  src="{{ asset('images/'.$image) }}" style="width: {{$ImageWidth}}pt; height: auto; "  />
    @else
        <img  src="{{ asset('images/'.$image) }}" style="width: {{$ImageWidth}}pt; height: {{$ImageHeight}}pt; "  />
    @endif

</div>
