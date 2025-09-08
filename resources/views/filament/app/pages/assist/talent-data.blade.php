<div class="flex">
    @if($record->VicTalent)
        @php $i=0; @endphp
        @foreach($record->VicTalent as $talent)
            @if($i>0)
                <p>&nbsp;&nbsp; , &nbsp;&nbsp;</p>
            @endif
            <x-filament::avatar
                src="{{  asset('images/'.$talent->Talent->image) }} "
                size="sm"
            />
            @php $i++ @endphp
        @endforeach
    @endif

</div>
