
  <div class="flex ">

      @if($record->hisFather) <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>@endif
      @if($record->male=='ذكر')
          @if($record->is_great_grandfather)
              <label   class="text-red-950"> {{__('The great grand father')}} : </label>
          @else
              @if($record->is_grandfather)
                  <label   class="text-red-950">{{__('The grand father')}} :&nbsp;&nbsp; </label>
              @else
                  @if($record->is_father)
                      <label  class="text-yellow-700">{{__('The father')}} :&nbsp;&nbsp; </label>
                  @endif
              @endif
          @endif
          @if($record->is_father==0 && $record->wife_id!=null)
              <label   class="text-blue-700">{{__('The husband')}} :&nbsp;&nbsp; </label>
          @endif
      @endif
      @if($record->male=='أنثي')
          @if($record->is_great_grandmother)
              <p style="color: aqua; ">{{__('The great gran mother')}} :&nbsp;&nbsp;</p>
          @else
              @if($record->is_grandmother)
                  <p style="color: aqua; ">{{__('The grand mother')}} : &nbsp;&nbsp;</p>
              @else
                  @if($record->is_mother)
                      <p style="color: aqua; ">{{__('The mother')}} : &nbsp;&nbsp;</p>
                  @endif
              @endif
          @endif
          @if($record->is_mother==0 && $record->husband_id!=null)
              <label style="color: #6b21a8" >{{__('The wife')}} :&nbsp;&nbsp; </label>
          @endif

      @endif



  @if($record->is_father)
     <label class="text-amber-700 font-bold">{{ucfirst($record->FullNameJs)}}</label>
    @else
        @if($record->is_mother)
            <label class="text-green-700 font-bold">{{ucfirst($record->FullNameJs)}}</label>
        @else
            <label  class="font-bold">{{ucfirst($record->FullNameJs)}}</label>
        @endif
    @endif
    @if ($record->otherName) <label style="color: #9f1239;font-weight: bold"> &nbsp; [{{$record->otherNameJs}}]&nbsp; </label> @endif

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
          <label >{{ucfirst($record->husband->FullNameJs)}}</label>
         </div>
        @endif

        @if($record->wife)
          <div class="flex ">
            <label class="text-green-700 font-bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{__('his wife')}} :</label>
            <label >{{ucfirst($record->wife->FullNameJs)}}</label>
          </div>
        @endif
        @if($record->wife2)
         <div class="flex ">
            <label style="color: #00bb00;font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{__('his second wife')}} :</label>
            <label >{{ucfirst($record->wife2->FullNameJs)}}</label>
         </div>
        @endif




    @if($record->hisSons->count()>0)
      <div class="flex">
         <label style="color: aqua;font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{__('his sons')}} :</label>

         @php $i=0; @endphp
         @foreach($record->hisSons as $item)
          @if ($i != 0) <label>&nbsp;,&nbsp;</label>  @endif
          @if($item->is_father)
              <label class="text-amber-700 font-bold">{{ucfirst($item->Name1Js)}}</label>
          @else
            @if($item->is_mother)
              <label class="text-green-700 font-bold">{{ucfirst($item->Name1Js)}}</label>
            @else
              <label>{{ucfirst($item->Name1Js)}}</label>
            @endif
          @endif

          @php $i++ @endphp

        @endforeach

        </div>
    @endif
    @if($record->herSons->count()>0)
      <div class="flex">
                <label style="color: aqua;font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{__('her sons')}} :</label>
            @php
                if ($record->has_more !=1) {
                    $i=0;
                    foreach($record->herSons as $item){
                         if ($i != 0) echo "<label style=\"color: aqua;font-weight: bold\">&nbsp;,&nbsp;</label>" ;
                         if ($item->is_father)
                             echo "<label class=\"text-amber-700 font-bold\">".ucfirst($item->Name1Js)."</label>";
                         else
                             if ($item->is_mother)
                                 echo "<label class=\"text-green-700 font-bold\">".ucfirst($item->Name1Js)."</label>";
                             else
                             echo "<label>".ucfirst($item->Name1Js)."</label>";
                         $i++;
                    }
                    if (!$record->husband) echo "<label>&nbsp&nbsp;(".__('from')." : &nbsp ".ucfirst($item->Name2Js)."&nbsp;".ucfirst($item->Name3Js)."&nbsp;".ucfirst($item->Name4Js).")</label>";
                }
                else {

                        $rec=\App\Models\Victim::where('mother_id',$record->id)->orderby('Name2')->get();
                        $i=0;

                        $name2=$rec[0]->Name2Js;
                        $name3=$rec[0]->Name3Js;
                        $name4=$rec[0]->Name4Js;
                        foreach($rec as $item){
                          if ($name2 != $item->Name2Js){
                              echo "<label>&nbsp&nbsp;(".__('from')." :  ".ucfirst($name2)."&nbsp;".ucfirst($name3)."&nbsp;".ucfirst($name4).")</label>";

                              echo "</div>";
                              echo "<div class=\"flex\">";
                              echo "<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>";

                              $name2=$item->Name2Js;
                              $name3=$item->Name3Js;
                              $name4=$item->Name4Js;
                              $i=0;
                          }

                         if ($i != 0) echo "<label style=\"color: aqua;font-weight: bold\">&nbsp;,&nbsp;</label>" ;
                         if ($item->is_father)
                             echo "<label class=\"text-amber-700 font-bold\">".ucfirst($item->Name1Js)."</label>";
                         else
                             if ($item->is_mother)
                                 echo "<label class=\"text-green-700 font-bold\">".ucfirst($item->Name1Js)."</label>";
                             echo "<label>".ucfirst($item->Name1Js)."</label>";

                             $i++;
                        }
                            echo "<label>&nbsp&nbsp;(".__('from')." :  ".ucfirst($name2)."&nbsp;".ucfirst($name3)."&nbsp;".ucfirst($name4).")</label>";
                    }

            @endphp
        </div>
    @endif

