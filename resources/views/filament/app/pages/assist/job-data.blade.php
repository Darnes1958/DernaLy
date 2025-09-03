<div class="flex">
    @if($record->Job)
        <p >{{$record->Job->name}}&nbsp;</p>
        @if($record->Job->image)
            <label>&nbsp;</label>
            <img src="{{ storage_path('app/private/'.$record->Job->image) }}"  style="width: 26px; height: 26px;" />
        @endif
    @endif


</div>
