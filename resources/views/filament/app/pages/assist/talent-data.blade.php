<div class="flex">
    @if($record->VicTalent)
        @foreach($record->VicTalent as $talent)
            <x-filament::avatar
                src="{{  asset('images/'.$talent->Talent->image) }} "
                size="sm"
            />
        @endforeach
    @endif

</div>
