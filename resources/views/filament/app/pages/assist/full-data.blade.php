
  <div class="flex ">





      @if($record->hisFather) <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>@endif
      @if($record->male=='ذكر')
          @if($record->is_great_grandfather)
              <label   class="text-red-950"> جد الأب : </label>
          @else
              @if($record->is_grandfather)
                  <label   class="text-red-950">الجد :&nbsp;&nbsp; </label>
              @else
                  @if($record->is_father)
                      <label  class="text-yellow-700">الأب :&nbsp;&nbsp; </label>
                  @endif
              @endif
          @endif
          @if($record->is_father==0 && $record->wife_id!=null)
              <label   class="text-blue-700">الزوج :&nbsp;&nbsp; </label>
          @endif
      @endif
      @if($record->male=='أنثي')
          @if($record->is_great_grandmother)
              <p style="color: aqua; ">جدة الأب :&nbsp;&nbsp;</p>
          @else
              @if($record->is_grandmother)
                  <p style="color: aqua; ">الجدة : &nbsp;&nbsp;</p>
              @else
                  @if($record->is_mother)
                      <p style="color: aqua; ">الأم : &nbsp;&nbsp;</p>
                  @endif
              @endif
          @endif
          @if($record->is_mother==0 && $record->husband_id!=null)
              <label style="color: #6b21a8" >الزوجة :&nbsp;&nbsp; </label>
          @endif

      @endif



  @if($record->is_father)
     <label class="text-amber-700 font-bold">{{$record->FullName}}</label>
    @else
        @if($record->is_mother)
            <label class="text-green-700 font-bold">{{$record->FullName}}</label>
        @else
            <label  class="font-bold">{{$record->FullName}}</label>
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
          <label class="text-amber-700 font-bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
          <label >{{$record->husband->FullName}}</label>
         </div>
        @endif

        @if($record->wife)
          <div class="flex ">
            <label class="text-green-700 font-bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;زوجته :</label>
            <label >{{$record->wife->FullName}}</label>
          </div>
        @endif
        @if($record->wife2)
         <div class="flex ">
            <label style="color: #00bb00;font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;زوجته الثانية :</label>
            <label >{{$record->wife2->FullName}}</label>
         </div>
        @endif




    @if($record->hisSons->count()>0)
      <div class="flex">
         <label style="color: aqua;font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;أبناءه :</label>

         @php $i=0; @endphp
         @foreach($record->hisSons as $item)
          @if ($i != 0) <label>&nbsp;,&nbsp;</label>  @endif
          @if($item->is_father)
              <label class="text-amber-700 font-bold">{{$item->Name1}}</label>
          @else
            @if($item->is_mother)
              <label class="text-green-700 font-bold">{{$item->Name1}}</label>
            @else
              <label>{{$item->Name1}}</label>
            @endif
          @endif

          @php $i++ @endphp

        @endforeach

        </div>
    @endif
    @if($record->herSons->count()>0)
      <div class="flex">
                <label style="color: aqua;font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;أبناءها :</label>
            @php
                if ($record->has_more !=1) {
                    $i=0;
                    foreach($record->herSons as $item){
                         if ($i != 0) echo "<label style=\"color: aqua;font-weight: bold\">&nbsp;,&nbsp;</label>" ;
                         if ($item->is_father)
                             echo "<label class=\"text-amber-700 font-bold\">{$item->Name1}</label>";
                         else
                             if ($item->is_mother)
                                 echo "<label class=\"text-green-700 font-bold\">{$item->Name1}</label>";
                             else
                             echo "<label>{$item->Name1}</label>";
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

                         if ($i != 0) echo "<label style=\"color: aqua;font-weight: bold\">&nbsp;,&nbsp;</label>" ;
                         if ($item->is_father)
                             echo "<label class=\"text-amber-700 font-bold\">{$item->Name1}</label>";
                         else
                             if ($item->is_mother)
                                 echo "<label class=\"text-green-700 font-bold\">{$item->Name1}</label>";
                             echo "<label>{$item->Name1}</label>";

                             $i++;
                        }
                            echo "<label>&nbsp&nbsp;(من :  {$name2}&nbsp;{$name3}&nbsp;{$name4})</label>";
                    }

            @endphp
        </div>
    @endif

