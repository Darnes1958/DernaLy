<div class="flex space-x-2">

        @if($current=='ar')
            <x-flag-country-ly class="w-8 h-8 "/>

        @else
            <x-flag-country-us class="w-8 h-8"/>
        @endif

    {{$this->form}}

           <div>
               {{$this->contactus}}
               <x-filament-actions::modals />
           </div>



</div>
