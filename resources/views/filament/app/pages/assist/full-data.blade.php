
  <div class="flex ">

    @if($record->is_father)
     <label style="color: #fbbf24; ">{{$record->FullName}}</label>
    @else
        @if($record->is_mother)
            <label style="color: #00bb00;">{{$record->FullName}}</label>
        @else
            <label  >{{$record->FullName}}</label>
        @endif
    @endif
    @if ($record->otherName) <label style="color: #9f1239;font-weight: bold"> &nbsp; [{{$record->otherName}}]&nbsp; </label> @endif

        @if($record->VicTalent)

            @foreach($record->VicTalent as $talent)
                <label>&nbsp;</label>
                @if($talent->Talent->image)

                        <x-filament::avatar src="{{  asset('images/'.$talent->Talent->image) }} " size="sm"   />


                @endif
            @endforeach
        @endif
        @if($record->Job)
            @if($record->Job->image)
                <label>&nbsp;</label>
                <img src="{{ asset('images/'.$record->Job->image) }}"  style="width: 20px; height: 20px;" />
            @endif
        @endif
  </div>



        @if($record->husband)
         <div class="flex ">
          <label style="color: #fbbf24;font-weight: bold">زوجها :&nbsp;</label>
          <label >{{$record->husband->FullName}}</label>
         </div>
        @endif

        @if($record->wife)
          <div class="flex ">
            <label style="color: #00bb00;font-weight: bold">&nbsp;&nbsp;&nbsp;زوجته :</label>
            <label >{{$record->wife->FullName}}</label>
          </div>
        @endif
        @if($record->wife2)
         <div class="flex ">
            <label style="color: #00bb00;font-weight: bold">&nbsp;&nbsp;&nbsp;زوجته الثانية :</label>
            <label >{{$record->wife2->FullName}}</label>
         </div>
        @endif

        @if($record->hisFather)
         <div class="flex ">
            @if($record->male=='ذكر')
            <label style="color: dodgerblue;font-weight: bold">&nbsp;&nbsp;&nbsp;والده :</label>
            @else
            <label style="color: dodgerblue;font-weight: bold">&nbsp;&nbsp;&nbsp;والدها :</label>
            @endif
            <label >{{$record->hisFather->FullName}}</label>
         </div>
        @endif
        @if($record->hisMother)
          <div class="flex ">
            @if($record->male=='ذكر')
                <label style="color: #c084fc;font-weight: bold">&nbsp;&nbsp;&nbsp;والدته :</label>
            @else
                <label style="color: #c084fc;font-weight: bold">&nbsp;&nbsp;&nbsp;والدتها :</label>
            @endif

            <label >{{$record->hisMother->FullName}}</label>
          </div>
        @endif

    @if($record->hisSons->count()>0)
      <div class="flex">
         <label style="color: aqua;font-weight: bold">&nbsp;&nbsp;&nbsp;أبناءه :</label>

         @php $i=0; @endphp
         @foreach($record->hisSons as $item)
          @if ($i == 0) <label>{{$item->Name1}}</label>
          @else  <label>&nbsp;,&nbsp;</label>
                 <label>{{$item->Name1}}</label>
          @endif
          @php $i++ @endphp

        @endforeach

        </div>
    @endif
    @if($record->herSons->count()>0)
      <div class="flex">
                <label style="color: aqua;font-weight: bold">&nbsp;&nbsp;&nbsp;أبناءها :</label>
            @php
                if ($record->has_more !=1) {
                    $i=0;
                    foreach($record->herSons as $item){
                         if ($i == 0) echo "<label>{$item->Name1}</label>"; else echo "<label style=\"color: aqua;font-weight: bold\">&nbsp;,&nbsp;</label><label>{$item->Name1}</label>";
                         $i++;
                    }
                    if (!$record->husband) echo "<label>&nbsp&nbsp;(من : &nbsp {$item->Name2}&nbsp;{$item->Name3}&nbsp;{$item->Name4})</label>";
                }
                else {

                        $rec=\App\Models\Victim::where('mother_id',$record->id)->orderby('Name2')->get();
                        $i=0;

                        $name2=$rec[0]->Name2;
                        $name3=$rec[0]->Name3;
                        $name4=$rec[0]->Name4;
                        foreach($rec as $item){
                          if ($name2 != $item->Name2){
                              echo "<label>&nbsp&nbsp;(من :  {$name2}&nbsp;{$name3}&nbsp;{$name4})</label>";
                              $name2=$item->Name2;
                              $name3=$item->Name3;
                              $name4=$item->Name4;
                              $i=0;
                          }

                             if ($i == 0) echo "<label>&nbsp;{$item->Name1}</label>"; else echo "<label style=\"color: aqua;font-weight: bold\">&nbsp;,&nbsp;</label><label>{$item->Name1}</label>";
                             $i++;
                        }
                            echo "<label>&nbsp&nbsp;(من :  {$name2}&nbsp;{$name3}&nbsp;{$name4})</label>";
                    }

            @endphp
        </div>
    @endif

