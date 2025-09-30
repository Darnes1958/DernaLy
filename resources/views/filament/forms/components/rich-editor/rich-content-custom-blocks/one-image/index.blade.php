<div>
    @if($ImageWidth!='auto')  @php $ImageWidth=$ImageWidth.'pt'   @endphp @endif
    @if($ImageHeight!='auto') @php $ImageHeight=$ImageHeight.'pt' @endphp @endif
    <img  src="{{ asset('images/'.$image) }}" style="width: {{$ImageWidth}}; height: {{$ImageHeight}}; "  />





</div>
