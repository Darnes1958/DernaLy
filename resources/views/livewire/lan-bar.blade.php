<div class="flex">

        @if($status=='ar')
            <x-flag-country-ly class="w-6 h-6 "/>

        @else
            <x-flag-country-us class="w-6 h-6"/>
        @endif



        {{ $this->form }}


</div>

