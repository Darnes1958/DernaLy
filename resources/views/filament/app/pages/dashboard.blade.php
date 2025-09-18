<x-filament-panels::page>
    @php
        $agent = new \Jenssegers\Agent\Agent();
                    if ($agent->isMobile() || $agent->isTablet())

    @endphp
    @if($agent->isMobile() || $agent->isTablet())
        <div class="grid grid-cols-8 gap-4 w-full ">
           <div class="col-span-4  " >
                {{$this->form}}
           </div>
           <div class="col-span-4 " >
               <div >
                   <x-filament-actions::group @class('w-full')
                                              :actions="[
                        $this->charts,
                        $this->bigest,
                        $this->tree,
                    ]"
                                              label="{{__('Statistics,Charts')}}"
                                              icon="heroicon-m-ellipsis-vertical"
                                              button="true"
                   />

               </div>
               <div class="mt-6">
                   <x-filament-actions::group
                       :actions="[
                        $this->guest,
                        $this->saver,
                        $this->work,
                    ]"
                       label="{{__('Guests, Rescuers..')}}"
                       icon="heroicon-m-ellipsis-vertical"
                       button="true"
                   />

               </div>
               <div class="mt-6">
                   <x-filament-actions::group @class('w-full')
                                              :actions="[
                        $this->madny,
                        $this->job,

                    ]"
                                              label="{{__('Jobs and Talents')}}"
                                              icon="heroicon-m-ellipsis-vertical"
                                              button="true"

                   />

               </div>
           </div>
        </div>
        <div >
            <img src="{{ asset('images/dashnew.jpg') }}">
        </div>
    @else
        <x-filament::section>
            <img src=" {{ asset('images/dashnew.jpg') }}"  class="w-full" />
        </x-filament::section>
    @endif



</x-filament-panels::page>
